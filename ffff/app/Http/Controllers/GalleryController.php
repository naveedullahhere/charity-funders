<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLocation;
use App\Models\EventRole;
use App\Models\Gallery;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
// use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Psy\Readline\Hoa\EventSource;
// use Pbmedia\LaravelFFMpeg\FFMpegFacade as FFMpeg;
// use FFMpeg\FFMpeg;
// use FFMpeg\Format\Video\WebM;
// use Workflow\Activity; 
// use FFMpeg;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
// use FFMpeg\FFMpeg;
// use Pbmedia\LaravelFFMpeg\FFMpeg;
// use ProtoneMedia\LaravelFFMpeg\FFMpeg;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use FFMpeg\FFProbe;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve roles and locations from the database
        $events = Event::where("status", 1)->get();

        return view('management.gallery.create', compact('events'));
    }

    public function update(Request $request, $id)
    {
        $slug = \Str::slug($request->name);

        // Check if the slug already exists
        $count = 0;
        while (Gallery::where('slug', $slug)->where('id', '<>', $id)->exists()) {
            $count++;
            $slug = \Str::slug($request->name) . '-' . $count;
        }

        $gallery = Gallery::findOrFail($id);
        $gallery->update([
            'name' => $request->name,
            'slug' => $slug, // Save the unique slug
            'event_id' => $request->event_id,
            'status' => $request->status,
            'updated_by' => auth()->id(), // Optional: track who updated
        ]);

        $fileIds = explode(',', $request->uploaded_file_ids);
        // return $fileIds;
        foreach ($fileIds as $fileId) {
            if ($fileId) {
                Media::where('id', $fileId)->update([
                    'gallery_id' => $gallery->id,
                    'event_id' => $request->event_id
                ]);
            }
        }

        return response()->json([
            'success' =>  'Gallery updated successfully!',
            'message' => 'Gallery updated successfully!',
            'gallery_id' => $gallery->id,
        ]);
    }

    public function uploadMedia(Request $request)
    {
        $response = [];
        $fileIds = [];
        $groupId = uniqid(); // Unique ID for grouping media files

        // Check if the request contains files
        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileType = $file->getMimeType();

                $filenameId = uniqid();
                $filenameExt = $file->getClientOriginalExtension();
                $filename = $filenameId . '.' . $filenameExt;
                $filePath = $file->storeAs('media', $filename, 'public'); // Save file in storage/app/public/media
                $relativeFilePath =   $filePath; // Relative path for FFmpeg
                $filePath = $file->move(public_path('media'), $filename); // Move file

                // Get file size in bytes
                $fileSize = filesize($filePath);

                if (strstr($fileType, 'image/')) {
                    // Get image dimensions
                    list($width, $height) = getimagesize($filePath);
                    $dimensions = $width . 'x' . $height;

                    $filenameForThumb = $filenameId . uniqid() . '.' . $filenameExt;
                    $filenameForMedium = $filenameId . uniqid() . '.' . $filenameExt;

                    // Resize images and get new dimensions for resized images
                    // $thumbnailDimensions = $this->resizeImage($filePath, storage_path('app/public/media/thumbnails'), $filenameForThumb, 30);
                    // $mediumDimensions = $this->resizeImage($filePath, storage_path('app/public/media/mediums'), $filenameForMedium, 60);
                    $thumbnailDimensions = $this->resizeImage($filePath, public_path('media/thumbnails'), $filenameForThumb, 30);
                    $mediumDimensions = $this->resizeImage($filePath, public_path('media/mediums'), $filenameForMedium, 60);

                    // Save original image
                    $media = Media::create([
                        // 'id' => $fileId = uniqid(),
                        'file_path' => 'media/' . $filename,
                        'file_type' => 'image',
                        'resolution' => $dimensions,
                        'resolution_type' => 'high',
                        'size' => $fileSize,
                        'group_id' => $groupId,
                        'is_thumbnail' => false,
                    ]);

                    $fileIds[] = $media->id;

                    // Save resized images
                    $media = Media::create([
                        // 'id' => $thumbnailId = uniqid(),
                        'file_path' => 'media/thumbnails/' . $filenameForThumb,
                        'file_type' => 'image',
                        'resolution' => $thumbnailDimensions,
                        'resolution_type' => 'low',
                        'size' => $fileSize,
                        'group_id' => $groupId,
                        'is_thumbnail' => true,
                    ]);

                    $fileIds[] = $media->id;

                    $media = Media::create([
                        // 'id' => $mediumId = uniqid(),
                        'file_path' => 'media/mediums/' . $filenameForMedium,
                        'file_type' => 'image',
                        'resolution' => $mediumDimensions,
                        'resolution_type' => 'standard',
                        'size' => $fileSize,
                        'group_id' => $groupId,
                        'is_thumbnail' => false,
                    ]);

                    $fileIds[] = $media->id;
                } else if (strstr($fileType, 'video/')) {
                    // Process videos
                    $thumbnailFilename = $filenameId . '.png'; // Thumbnail filename
                    $resizedFilename = $filenameId . '_50.' . $filenameExt; // 50% resized video filename

                    // Extract a thumbnail from the video
                    FFMpeg::fromDisk('public')
                        ->open($relativeFilePath)
                        ->getFrameFromSeconds(1)
                        ->export()
                        ->toDisk('public')
                        ->save('media/thumbnails/' . $thumbnailFilename);

                    // Step 2: Get dimensions of the extracted thumbnail
                    // $thumbnailPath = storage_path('app/public/media/thumbnails/' . $thumbnailFilename); // Use storage_path here

                    $thumbnailPath = public_path('media/thumbnails/' . $thumbnailFilename); // Use public_path here

                    $ffprobe = FFProbe::create();
                    $thumbnailInfo = $ffprobe->streams($thumbnailPath)->first();
                    $thumbnailWidth = $thumbnailInfo->get('width');
                    $thumbnailHeight = $thumbnailInfo->get('height');

                    $videoInfo = $ffprobe->streams($relativeFilePath)->first();
                    $originalWidth = $videoInfo->get('width');
                    $originalHeight = $videoInfo->get('height');

                    // Step 2: Calculate new dimensions (50%)
                    $newWidth = $originalWidth / 2;
                    $newHeight = $originalHeight / 2;

                    $dimensions = $originalWidth . "x" . $originalHeight;
                    $mediumDimensions = $newWidth . "x" . $newHeight;
                    $thumbnailDimensions = $thumbnailWidth . "x" . $thumbnailHeight;

                    // Step 3: Resize video to 50% of original dimensions
                    FFMpeg::fromDisk('public')
                        ->open($relativeFilePath)
                        ->addFilter(function ($filters) use ($newWidth, $newHeight) {
                            $filters->resize(new \FFMpeg\Coordinate\Dimension($newWidth, $newHeight)) // Resize to 50%
                                ->synchronize();
                        })
                        ->export()
                        ->toDisk('public')
                        ->inFormat(new X264()) // Specify video format
                        ->save('media/videos/' . $resizedFilename);

                    // Save original video
                    $media = Media::create([
                        'file_path' => 'media/' . $filename,
                        'file_type' => 'video',
                        'resolution' => $dimensions,
                        'resolution_type' => 'high',
                        'size' => $fileSize, // Ensure the original file size is used here
                        'group_id' => $groupId,
                        'is_thumbnail' => false,
                    ]);

                    $fileIds[] = $media->id;

                    // Calculate the size of the resized video
                    // $resizedVideoSize = filesize(public_path('media/videos/' . $resizedFilename));
                    // $resizedVideoSize = filesize(storage_path('app/public/media/videos/' . $resizedFilename));
                    $resizedVideoSize = filesize(public_path('media/videos/' . $resizedFilename));

                    // Save resized video
                    $media = Media::create([
                        'file_path' => 'media/videos/' . $resizedFilename,
                        'file_type' => 'video',
                        'resolution' => $mediumDimensions,
                        'resolution_type' => 'standard',
                        'size' => $resizedVideoSize,
                        'group_id' => $groupId,
                        'is_thumbnail' => false,
                    ]);

                    $fileIds[] = $media->id;

                    // Save thumbnail
                    // $thumbnailSize = filesize(public_path('media/thumbnails/' . $thumbnailFilename));
                    // $thumbnailSize = filesize(storage_path('app/public/media/thumbnails/' . $thumbnailFilename));
                    $thumbnailSize = filesize(public_path('media/thumbnails/' . $thumbnailFilename));

                    $media = Media::create([
                        'file_path' => 'media/thumbnails/' . $thumbnailFilename,
                        'file_type' => 'video',
                        'resolution' => $thumbnailDimensions,
                        'resolution_type' => 'low',
                        'size' => $thumbnailSize, // Use the thumbnail's actual size
                        'group_id' => $groupId,
                        'is_thumbnail' => true,
                    ]);

                    $fileIds[] = $media->id;
                } else {
                    // Non-image files
                    // $dimensions = 'N/A'; // Dimensions are not applicable for non-images

                    // // Save media details to the database for non-image files
                    // $media = Media::create([
                    //     'file_path' => 'media/' . $filename,
                    //     'file_type' => 'video', // Assume non-images are videos
                    //     'resolution' => 'original',
                    //     'resolution_type' => 'standard',
                    //     'file_size' => $fileSize,
                    //     'group_id' => $groupId,
                    //     'is_thumbnail' => false,
                    // ]);

                    // $fileIds[] = $media->id;
                }
            }
        } else {
            // Log or handle the case when no file is found in the request
            \Log::error('No file found in the request.');
        }

        return response()->json(['fileIds' => $fileIds]);
    }

    private function resizeVideo($videoPath, $outputPath, $percentage)
    {
        $ffmpeg = \FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($videoPath);

        // Get the original dimensions
        $videoStream = $video->getStreams()->first();
        $originalWidth = $videoStream->get('width');
        $originalHeight = $videoStream->get('height');

        // Calculate new dimensions
        $newWidth = $originalWidth * ($percentage / 100);
        $newHeight = $originalHeight * ($percentage / 100);

        // Resize the video
        $video->filters()->resize(new \FFMpeg\Coordinate\Dimension($newWidth, $newHeight));
        $video->save(new \FFMpeg\Format\Video\X264(), $outputPath);
    }

    private function extractThumbnail($videoPath, $thumbnailPath)
    {
        $ffmpeg = \FFMpeg\FFMpeg::create();
        $video = $ffmpeg->open($videoPath);

        // Extract a frame at the 1-second mark
        $video->frame(\FFMpeg\Coordinate\TimeCode::fromSeconds(1))->save($thumbnailPath);
    }

    private function resizeImage($filePath, $destinationPath, $filename, $percentage)
    {

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true); // Create the directory with appropriate permissions
        }

        // Get image size
        list($width, $height, $type) = getimagesize($filePath);

        // Calculate new size
        $newWidth = $width * ($percentage / 100);
        $newHeight = $height * ($percentage / 100);

        // Create a new image resource with the new size
        $imageResized = imagecreatetruecolor($newWidth, $newHeight);

        switch ($type) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($filePath);
                $outputFunction = 'imagejpeg';
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($filePath);
                $outputFunction = 'imagepng';
                break;
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($filePath);
                $outputFunction = 'imagegif';
                break;
            default:
                throw new \Exception('Unsupported image type.');
        }

        // Resize the original image and copy to new image resource
        imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Add watermark if destination is 'thumbnails'
        if (strpos($destinationPath, 'thumbnails') !== false) {
            $this->addWatermark($imageResized);
        }

        // Save the resized image
        $outputFunction($imageResized, $destinationPath . '/' . $filename);

        $newDimensions = $newWidth . 'x' . $newHeight;

        // Free memory
        imagedestroy($image);
        imagedestroy($imageResized);

        return $newDimensions;
    }

    private function addWatermark(&$image)
    {
        $watermarkPath = public_path('management/images/ajp-logo.png');
        $watermark = imagecreatefrompng($watermarkPath);

        $watermarkWidth = imagesx($watermark);
        $watermarkHeight = imagesy($watermark);

        $imageWidth = imagesx($image);
        $imageHeight = imagesy($image);

        // Check if watermark needs scaling
        if ($watermarkWidth > $imageWidth || $watermarkHeight > $imageHeight) {
            // Calculate scaling factor
            $widthScale = $imageWidth / $watermarkWidth;
            $heightScale = $imageHeight / $watermarkHeight;
            $scale = min($widthScale, $heightScale);

            // New dimensions
            $newWatermarkWidth = intval(($watermarkWidth - 30) * $scale);
            $newWatermarkHeight = intval(($watermarkHeight - 30) * $scale);

            // Create a new scaled watermark image with transparency
            $scaledWatermark = imagecreatetruecolor($newWatermarkWidth, $newWatermarkHeight);
            imagealphablending($scaledWatermark, false); // Disable alpha blending
            imagesavealpha($scaledWatermark, true); // Save alpha channel
            $transparent = imagecolorallocatealpha($scaledWatermark, 0, 0, 0, 127); // Fully transparent
            imagefill($scaledWatermark, 0, 0, $transparent);

            // Copy and resize the watermark with transparency
            imagecopyresampled($scaledWatermark, $watermark, 0, 0, 0, 0, $newWatermarkWidth, $newWatermarkHeight, $watermarkWidth, $watermarkHeight);

            // Update watermark reference
            imagedestroy($watermark);
            $watermark = $scaledWatermark;
            $watermarkWidth = $newWatermarkWidth;
            $watermarkHeight = $newWatermarkHeight;
        }

        // Calculate the position to center the watermark
        $x = ($imageWidth - $watermarkWidth) / 2;
        $y = ($imageHeight - $watermarkHeight) / 2;

        // Preserve transparency of the original image
        imagealphablending($image, true);
        imagesavealpha($image, true);

        // Merge the watermark onto the image with transparency
        imagecopy($image, $watermark, $x, $y, 0, 0, $watermarkWidth, $watermarkHeight);

        // Free memory
        imagedestroy($watermark);
    }


    public function revertMedia(Request $request)
    {
        $mediaIds = $request->media_ids; // assuming 'media_ids' is the key in your request payload

        if (is_array($mediaIds)) {
            // Loop through each media ID and perform deletion
            foreach ($mediaIds as $mediaId) {
                // Example: Delete from database or file system
                $this->deleteMedia($mediaId);
            }

            return response()->json(['status' => 'success', 'message' => 'Media deleted successfully', 'media_ids' => $mediaIds]);
        }

        return response()->json(['status' => 'error', 'message' => 'Invalid media IDs', 'media_ids' => []]);
    }

    // Helper function to handle media deletion
    private function deleteMedia($mediaId)
    {
        $media = Media::find($mediaId); // Find the media by ID

        // if ($media) {
        //     // Build the file path based on the public/media directory
        //     $filePath = public_path($media->file_path); // Assuming 'file_name' is the name of the file in the database

        //     // Check if the file exists
        //     if (file_exists($filePath)) {
        //         // Delete the file from public/media directory
        //         unlink($filePath);
        //     }

        //     // Delete the media entry from the database
        //     $media->delete();
        // }

        $mediaItems = Media::where('group_id', $media->group_id)->get();

        foreach ($mediaItems as $media) {
            // Build the file path based on the public/media directory
            $filePath = public_path($media->file_path);

            // Check if the file exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the media entry from the database
            $media->delete();
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'event_id' => 'required|integer|exists:events,id', // Assuming `events` is the name of the table and `id` is the primary key
            'uploaded_file_ids' => 'required|string', // Adjust the rules for `status` if needed
            'status' => 'nullable|string|max:255', // Adjust the rules for `status` if needed
        ], [
            'uploaded_file_ids.required' => 'The field is required (Atlease one media file is required).',
            'event_id.required' => 'The event field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $slug = \Str::slug($request->name);

        // Check if the slug already exists
        $count = 0;
        while (Gallery::where('slug', $slug)->exists()) {
            $count++;
            $slug = \Str::slug($request->name) . '-' . $count;
        }

        $gallery = Gallery::create([
            'name' => $request->name,
            'slug' => $slug, // Save the unique slug
            'event_id' => $request->event_id,
            'status' => $request->status,
            'created_by' => auth()->id(),
        ]);

        $fileIds = explode(',', $request->uploaded_file_ids);
        foreach ($fileIds as $fileId) {
            if ($fileId) {
                Media::where('id', $fileId)->update([
                    'gallery_id' => $gallery->id,
                    'event_id' => $request->event_id
                ]);
            }
        }

        return response()->json([
            'success' =>  'Gallery created successfully!',
            'message' => 'Gallery created successfully!',
            'gallery_id' => $gallery->id,
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);
        return view('frontend.pages.gallery.show', ['media' => $media]);
    }

    public function eventShow($id)
    {
        $media = Media::findOrFail($id);
        return view('frontend.pages.gallery.show', ['media' => $media]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        $events = Event::where("status", 1)->get();

        // Prepare media for FilePond
        $existingMedia = $gallery->media()
            ->where('resolution_type', 'standard') // Filter by resolution_type
            ->get()
            ->map(function ($media) {
                return [
                    'source' => $media->id,  // Unique identifier
                    'options' => [
                        'type' => 'limbo', // Limbo type for server files
                        'file' => [
                            'name' => basename($media->file_path), // File name
                            'size' => $media->size, // File size in bytes
                            'type' => $media->file_type, // MIME type
                        ],
                        'metadata' => [
                            'poster' => asset($media->file_path), // Image URL for preview
                        ]
                    ]
                ];
            });

        // dd($existingMedia);

        return view('management.gallery.edit', compact('gallery', 'events', 'existingMedia'));
        // return view('management.gallery.edit', compact('events', 'gallery'));
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        DB::beginTransaction();
        try {
            $gallery = $gallery->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['success' => 'Successfully Deleted.', 'data' => $gallery]);
    }


    public function getTable(Request $request)
    {
        $galleries = Gallery::with(['media', 'event'])
            ->when($request->filled('search'), function ($q) use ($request) {
                $searchTerm = '%' . $request->search . '%';
                return $q->where(function ($sq) use ($searchTerm) {
                    $sq->where('name', 'like', $searchTerm);
                });
            })
            ->latest()
            ->paginate(10);

        return view('management.gallery.getList', compact('galleries'));
    }

    public function exportToExcel()
    {
        $discounts = Event::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'title');
        $sheet->setCellValue('B1', 'phone');
        $sheet->setCellValue('C1', 'email');
        $sheet->setCellValue('D1', 'address');
        $sheet->setCellValue('E1', 'description');
        $sheet->setCellValue('F1', 'created at');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->title);
            $sheet->setCellValue('B' . $row, $discount->phone);
            $sheet->setCellValue('C' . $row, $discount->email);
            $sheet->setCellValue('D' . $row, $discount->address);
            $sheet->setCellValue('E' . $row, $discount->description);
            $sheet->setCellValue('F' . $row, date('D d M Y', strtotime($discount->created_at)));

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'gallery.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
