<?php

namespace App\Http\Controllers;

use App\Models\{WorkArea, Type};

use App\Models\Funder;
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

        return view('frontend.pages.home');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function subscribe()
    {
        return view('frontend.pages.subscribe');
    }

    public function faq()
    {
        return view('frontend.pages.faq');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function search()
    {
        return view('frontend.pages.search');
    }

    public function searchFunders()
    {
        $types = Type::all();
        $workAreas = WorkArea::all();

        return view('frontend.pages.searchFunders', compact('types', 'workAreas'));
    }
    public function searchFundersList(Request $request)
    {
       
        $types = Type::all();
        $workAreas = WorkArea::all();
        $funders = Funder::where('status','Publish')
        ->when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
                $sq->orWhere('charity_no', 'like', $searchTerm);
            });
        })
        
        ->paginate(1);


        return view('frontend.funders.searchFundersList', compact('types', 'workAreas','funders'));
    }

    public function showFunder()
    {
        return view('frontend.pages.funderSingle');
    }

    public function handleAjaxRequest(Request $request)
    {
        $eventId = $request->input('event_id');
        $searchQuery = $request->input('search_query');
        $image = $request->file('image');

        $imageData = [
            // "670538edc7300670538edd4a91.png",
            '672f88b420de1672f88b425f29.JPG',
            '672f88a543f03672f88a54aeae.JPG',
            '672f889d06a41672f889dd2218.JPG',
        ];

        return response()->json([
            'success' => true,
            'event_id' => $eventId,
            'event_name' => $searchQuery,
            'image_data' => $imageData,
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
                    'hasMorePages' => $data['media']->hasMorePages(),
                ]);
            }
        } elseif ($request->isMethod('post')) {
            $eventId = $request->input('event_id');
            $eventName = $request->input('event_name');
            $imageDatas = json_decode($request->input('image_data'), true);

            if (is_array($imageDatas) && count($imageDatas)) {
                foreach ($imageDatas as $key => $value) {
                    $imageData[] = 'media/mediums/' . $value;
                }
                //dd($imageData);
                $group_ids = Media::whereIn('file_path', $imageData)->pluck('group_id')->toArray();
            }

            $query = Media::where('is_thumbnail', 1);

            if ($eventId) {
                $query->where('event_id', $eventId);
            }

            if (is_array($group_ids) && count($group_ids) != 0) {
                //                dd($imageData);
                $query->whereIn('group_id', $group_ids);
            }

            $data['media'] = $query->paginate(8);

            if ($request->ajax()) {
                return response()->json([
                    'output' => view('frontend.pages.gallery.load-more-gallery', $data)->render(),
                    'hasMorePages' => $data['media']->hasMorePages(),
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
            $gallery = Gallery::where('event_id', $eventdetail->id)
                ->where('status', 1)
                ->pluck('id')
                ->toArray(); // Initial load with pagination
            $data['media'] = Media::whereIn('gallery_id', $gallery)->where('is_thumbnail', 1)->paginate(8);

            return [
                'hasMorePages' => $data['media']->hasMorePages(),
                'output' => view('frontend.pages.gallery.load-more-gallery', $data)->render(),
            ];
        }

        $gallery = Gallery::where('event_id', $eventdetail->id)
            ->where('status', 1)
            ->pluck('id')
            ->toArray(); // Initial load with pagination
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
