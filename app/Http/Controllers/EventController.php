<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLocation;
use App\Models\EventRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\EventSource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('management.events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve roles and locations from the database
        $roles = EventRole::where("status", 1)->get();
        $locations = EventLocation::where("status", 1)->get();

        return view('management.events.create', compact('roles', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'event_role_id' => 'required|integer|exists:event_roles,id',
            'event_location_id' => 'required|integer|exists:event_locations,id',
            'event_date' => 'required|date',
            'thumbnail' => 'required|image', // Optional image validation
            'whole_event_price' => 'required|numeric|min:0',
            'price_per_video' => 'required|numeric|min:0',
            'price_per_image' => 'required|numeric|min:0',
            'whole_high_event_price' => 'required|numeric|min:0',
            'price_per_high_video' => 'required|numeric|min:0',
            'price_per_high_image' => 'required|numeric|min:0',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        DB::beginTransaction();
        try {
            // Handle the thumbnail upload
            $thumbnailName = null;
            if ($request->hasFile('thumbnail')) {
                // Generate a random file name and store the file in public/thumbnails
                $thumbnail = $request->file('thumbnail');
                $thumbnailName =  'thumbnails/' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('thumbnails'), $thumbnailName);
            }

            // Create event data
            $eventData = $request->all();
            $eventData['thumbnail'] = $thumbnailName;
            $eventData['created_by'] = auth()->user()->id;

            // Create the event
            $event = Event::create($eventData);

            DB::commit();

            return response()->json(['success' => 'Successfully Saved.', 'data' => $event]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function update(Request $request, Event $event)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'event_role_id' => 'required|integer|exists:event_roles,id',
            'event_location_id' => 'required|integer|exists:event_locations,id',
            'event_date' => 'required|date',
            'thumbnail' => 'nullable|image|max:2048', // Optional image validation
            'whole_event_price' => 'required|numeric|min:0',
            'price_per_video' => 'required|numeric|min:0',
            'price_per_image' => 'required|numeric|min:0',
            'whole_high_event_price' => 'required|numeric|min:0',
            'price_per_high_video' => 'required|numeric|min:0',
            'price_per_high_image' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            // Handle the thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete the old thumbnail if it exists
                if ($event->thumbnail && file_exists(public_path($event->thumbnail))) {
                    unlink(public_path($event->thumbnail));
                }

                // Generate a random file name and store the new thumbnail in public/thumbnails
                $thumbnail = $request->file('thumbnail');
                $thumbnailName =  'thumbnails/' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnail->move(public_path('thumbnails'), $thumbnailName);
            }

            // Update the event data
            $event->update($request->except(['thumbnail']));

            DB::commit();

            return response()->json(['success' => 'Successfully Updated.', 'data' => $event]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        // Retrieve roles and locations from the database
        $roles = EventRole::where("status", 1)->get();
        $locations = EventLocation::where("status", 1)->get();

        return view('management.events.edit', compact('roles', 'locations', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        DB::beginTransaction();
        try {
            $event = $event->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }

        return response()->json(['success' => 'Successfully Deleted.', 'data' => $event]);
    }


    public function getTable(Request $request)
    {
        $events = Event::with(['event_location', 'event_role'])->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
            });
        })->latest()->paginate(10);

        return view('management.events.getList', compact('events'));
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
        $fileName = 'events.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
