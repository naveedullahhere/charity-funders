<?php
// File: app/Http/Controllers/CollectionController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\CollectionMediaMapping;
use App\Models\Event;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    public function index()
    {
        // $collections = Collection::with(['media' => function ($query) {
        //     $query->whereIn('file_type', ['video', 'image']);
        // }])
        //     ->where("status", 0)
        //     ->withCount([
        //         'media as video_count' => function ($query) {
        //             $query->where('file_type', 'video');
        //         },
        //         'media as image_count' => function ($query) {
        //             $query->where('file_type', 'image');
        //         }
        //     ])
        //     ->get();

        $collections = Collection::where("status", 0)->get();

        return view('frontend.pages.collections.list', ['collections' => $collections]);
    }



    public function storeCollection(Request $request)
    // Validate the incoming request
    {
        $request->validate(
            [
                'selected_collection' => 'required|string|max:255',
                'media' => 'required|array'
            ],
            [
                'selected_collection' => 'Collection field is required.'
            ]
        );

        // dd($request->all());

        DB::beginTransaction();
        try {
            $collection = Collection::findOrFail($request->input('selected_collection'));
            $eventId = $request->input('event_id');
            $mediaIds = explode(",", $request->input('media')[0]);

            $media = Media::whereIn('id', $mediaIds)->select('group_id', 'id', 'file_type')->get();

            foreach ($media as $mediaItem) {
                CollectionMediaMapping::create([
                    'collection_id' => $request->input('selected_collection'),
                    'media_id' => $mediaItem['id'],
                    'event_id' => $eventId,
                    'group_id' => $mediaItem['group_id'] ?? null,
                    'file_type' => $mediaItem['file_type'] ?? null,
                ]);
            }

            DB::commit();
            return redirect()->route("collections.index")->with('success', 'Collection media updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Error updating collection media: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'collection_name' => 'required|string|max:255',
        ]);

        try {
            $collection = Collection::create([
                'collection_name' => $request->input('collection_name'),
                'created_by' => auth()->user()->id,
            ]);

            return response()->json(['id' => $collection->id, 'name' => $collection->collection_name, 'media' => $collection->media], 201);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // SQLSTATE for Integrity constraint violation

                return response()->json(['error' => 'Collection name already exists. Please choose a different name.'], 400);
            }
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        } catch (\Exception $e) {
            // Catch any other general exceptions
            return response()->json(['error' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }
    public function getPrices(Request $request)
    {
        $mediaId = $request->input('media_id');
        $slug = $request->input('slug');
        $eventId = $slug == 0 ? $mediaId : $slug;

        $event = Event::select("price_per_video", "price_per_image", "price_per_high_image", "price_per_high_video", "whole_event_price")
            ->findOrFail($eventId);

        $eventAllWithMedia = Event::leftJoin('media', 'media.event_id', '=', 'events.id')
            ->where('events.id', $eventId)
            ->select('*')
            ->get();

        $videoCount = $eventAllWithMedia->where('file_type', 'video')->count();
        $imageCount = $eventAllWithMedia->where('file_type', 'image')->count();

        return response()->json([
            'status' => 'success',
            'data' => $event,
            // 'with_media' => $eventAllWithMedia,
            'image_count' => $imageCount,
            'video_count' => $videoCount,
            'is_event' => $slug == 0 ? 1 : 0,
        ]);
    }

    public function single($id)
    {
        $collection = Collection::with("media")->findOrFail($id);
        return view('frontend.pages.collections.show', ['collection' => $collection]);
    }

    public function removeMediaPrices(Request $request)
    {
        // $mediaId = $request->input('media_id');
        // $slug = $request->input('slug');

        // $selectedMedia = Session::get('selected_media', []);
        // Session::put('selected_media', array_diff($selectedMedia, [$mediaId]));

        return response()->json(['status' => 'success', 'message' => 'Media removed from session']);
    }

    public function getSelectedMedia()
    {
        $selectedMedia = Session::get('selected_media', []);

        return response()->json(['media' => $selectedMedia]);
    }
}
