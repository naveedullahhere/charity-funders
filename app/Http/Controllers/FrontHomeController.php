<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Collection;
use App\Models\cr;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Page;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:page-list', ['only' => ['PageSlugPreview']]);
    }

    public function index(Request $request)
    {
        $data['slug'] = 0;

        if ($request->ajax()) {
            $events = Event::where("status", 1)->orderBy('created_at', 'desc')->paginate(8); // Adjust the limit as needed
            // return view('frontend.pages.load-more-events', compact('events'))->render();
            $isAjax = 1;

            return [
                "hasMorePages" => $events->hasMorePages(),
                "output" => view('frontend.pages.load-more-events', compact('events', 'isAjax'))->render()
            ];
        }

        $data['allEvents'] = Event::where("status", 1)
            ->orderBy('created_at', 'desc')->get();

        $data['events'] = Event::where("status", 1)->orderBy('created_at', 'desc')->paginate(8); // Initial load with pagination
        return view('frontend.pages.home', $data);
    }



    public function handleAjaxRequest(Request $request)
    {
        $eventId = $request->input('event_id');
        $searchQuery = $request->input('search_query');
        $image = $request->file('image');

        $imageData = [
            // "670538edc7300670538edd4a91.png",
            "672f88b420de1672f88b425f29.JPG",
            "672f88a543f03672f88a54aeae.JPG",
            "672f889d06a41672f889dd2218.JPG"
        ];

        return response()->json([
            'success' => true,
            'event_id' => $eventId,
            'event_name' => $searchQuery,
            'image_data' => $imageData
        ]);
    }

    public function finalSubmit(Request $request)
    {
        $data['isAjax'] = 0;
        
        if ($request->isMethod('get')) {

            $data['media'] = Media::where('is_thumbnail', 1)->paginate(8);

            if ($request->ajax()) {
                $data['isAjax'] = 1;
                return response()->json([
                    'output' => view('frontend.pages.gallery.load-more-gallery', $data)->render(),
                    'hasMorePages' => $data['media']->hasMorePages()
                ]);
            }
        } elseif ($request->isMethod('post')) {
            $eventId = $request->input('event_id');
            $eventName = $request->input('event_name');
            $imageDatas = json_decode($request->input('image_data'), true);

            if (is_array($imageDatas) && count($imageDatas)) {
                foreach ($imageDatas as $key => $value) {
                    $imageData[] = "media/mediums/" . $value;

                }
//dd($imageData);
              $group_ids =  Media::whereIn('file_path', $imageData)->pluck('group_id')->toArray();
            }



            $query = Media::where('is_thumbnail', 1);

            if ($eventId) {
                $query->where('event_id', $eventId);
            }


            if (is_array($group_ids) && count($group_ids) != 0 ) {


//                dd($imageData);
                $query->whereIn('group_id', $group_ids);
            }

            $data['media'] = $query->paginate(8);

            if ($request->ajax()) {
                return response()->json([
                    'output' => view('frontend.pages.gallery.load-more-gallery', $data)->render(),
                    'hasMorePages' => $data['media']->hasMorePages()
                ]);
            }
        } else {
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        return view('frontend.pages.gallery', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(cr $cr)
    {
        //
    }

    public function singleEvent(Request $request, $slug)
    {

        $eventdetail = Event::where('slug', $slug)->firstOrFail();
        $data['slug'] = $eventdetail->id;
        $data['eventdetail'] = $eventdetail;
        $data['event_price'] = $eventdetail->whole_event_price;
        $data['high_event_price'] = $eventdetail->whole_high_event_price;

        if ($request->ajax()) {
            $gallery = Gallery::where("event_id", $eventdetail->id)->where("status", 1)->pluck('id')->toArray(); // Initial load with pagination
            $data['media'] = Media::whereIn('gallery_id', $gallery)->where('is_thumbnail', 1)->paginate(8);

            return [
                "hasMorePages" => $data['media']->hasMorePages(),
                "output" => view('frontend.pages.gallery.load-more-gallery', $data)->render()
            ];
        }

        $gallery = Gallery::where("event_id", $eventdetail->id)->where("status", 1)->pluck('id')->toArray(); // Initial load with pagination
        $data['media'] = Media::whereIn('gallery_id', $gallery)->where('is_thumbnail', 1)->paginate(8);

        return view('frontend.pages.gallery.gallery', $data);
    }

    public function loadMoreGalleries(Request $request)
    {
        $media = Gallery::paginate(12);
        return view('frontend.pages.gallery._media-list', compact('media'))->render();
    }

    public function loadMoreEvents(Request $request)
    {
        $events = Event::paginate(12);
        return view('frontend.pages.gallery._media-list', compact('media'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cr $cr)
    {
        //
    }

    public function PageSlug($slug)
    {
        $data['content'] = Page::whereSlug($slug)->first();
        return view('frontend.pages.pages', $data);
    }

    public function PageSlugPreview($slug)
    {
        $data['content'] = Page::whereSlug($slug)->first();
        return view('frontend.pages.draftpages', $data);
    }
    public function AirportSlug($slug)
    {
        try {
            $data['content'] = Airport::whereSlug($slug)->firstOrFail();
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            \Log::error('Error retrieving airport data: ' . $e->getMessage());

            // You can also optionally redirect the user to an error page or display a friendly message
            return redirect()->route('error')->with('error', 'Oops! Something went wrong. Please try again later.');
        }
        return view('frontend.pages.pages', $data);
    }
}
