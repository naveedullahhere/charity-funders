<?php

namespace App\Http\Controllers;

use App\Models\{WorkArea, Type};

use App\Models\{Funder, FinancialDetail};
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
        $funders = Funder::where('status', 'Publish')->with('workAreas')
            ->when($request->filled('search'), function ($q) use ($request) {
                $searchTerm = '%' . $request->search . '%';
                return $q->where(function ($sq) use ($searchTerm) {
                    $sq->where('name', 'like', $searchTerm)
                        ->orWhere('charity_no', 'like', $searchTerm);
                });
            })
            ->when($request->filled('type'), function ($q) use ($request) {
                return $q->where('type_id', $request->type); // Filter by 'type'
            })
            ->when($request->filled('workarea'), function ($q) use ($request) {
                return $q->whereHas('workAreas', function ($wq) use ($request) {
                    $wq->whereIn('work_areas.id', $request->workarea); // Filter by workarea IDs
                });
            })->paginate(request('per_page',25));



        return view('frontend.funders.searchFundersList', compact('types', 'workAreas', 'funders'));
    }

    public function showFunder($slug)
    {
        $funder = Funder::where('slug', $slug)->firstOrFail();
        $latestFinancialDetail = FinancialDetail::where('funder_id', $funder->id)
            ->orderBy('year', 'desc')
            ->first();
        return view('frontend.pages.funderSingle', compact('funder', 'latestFinancialDetail'));
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
}
