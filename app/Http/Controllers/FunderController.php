<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Funder;
use Illuminate\Http\{Request, JsonResponse};
use App\Http\Requests\Funder\FunderRequest;
use App\Models\Category;
use App\Models\Type;
use App\Models\WorkArea;
use Illuminate\Support\Facades\Validator;

class FunderController extends Controller
{
    public function index()
    {
          $categories = Category::all();
        $types = Type::all();
          $workAreas = WorkArea::all();
        return view('management.funder.index', compact('categories', 'types', 'workAreas'));
    }


    public function getList(Request $request)
    {
        $funders = Funder::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('phone', 'like', $searchTerm)
                    ->orWhere('charity_no', 'like', $searchTerm);
            });
        })
         ->when($request->filled('type'), function ($q) use ($request) {
                return $q->where('type_id', $request->type); // Filter by 'type'
            })
         ->when($request->filled('category'), function ($q) use ($request) {
                return $q->where('category_id', $request->category)->orWhere('sub_category_id',$request->category); 
            })
            ->latest()
            ->paginate(request('per_page', 25));

        return view('management.funder.getList', compact('funders'));
    }


    public function create()
    {
        $categories = Category::all();
        $types = Type::all();
        $workAreas = WorkArea::all();

        return view('management.funder.create', compact('categories', 'types', 'workAreas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'company_name' => 'required|string|max:255',
            'charity_no' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:Publish,Draft',
        ]);

        $funder = Funder::create($request->all());

        // if ($request->has('financials')) {
        //     foreach ($request->financials as $financial) {
        //         $funder->financialDetails()->create($financial);
        //     }
        // }

        // if ($request->has('donation_applications')) {
        //     foreach ($request->donation_applications as $application) {
        //         $funder->donationApplications()->create($application);
        //     }
        // }

        // if ($request->has('trustee_boards')) {
        //     foreach ($request->trustee_boards as $trustee) {
        //         $funder->trusteeBoards()->create($trustee);
        //     }
        // }

        // if ($request->has('work_areas')) {
        //     $funder->areasOfWork()->sync($request->work_areas);
        // }

        return response()->json(['success' => true, 'message' => 'Funder created successfully']);
    }

    public function update(Request $request, Funder $funder)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'type_id' => 'required',
            'company_name' => 'required',
            'charity_no' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'status' => 'required',
        ]);

        $funder->update($request->all());

        $funder->financialDetails()->delete();
        if ($request->has('financials')) {
            foreach ($request->financials as $financial) {
                $funder->financialDetails()->create($financial);
            }
        }

        $funder->donationApplications()->delete();
        if ($request->has('donation_applications')) {
            foreach ($request->donation_applications as $application) {
                $funder->donationApplications()->create($application);
            }
        }

        $funder->trusteeBoards()->delete();
        if ($request->has('trustee_boards')) {
            foreach ($request->trustee_boards as $trustee) {
                $funder->trusteeBoards()->create($trustee);
            }
        }

        if ($request->has('work_areas')) {
            $funder->areasOfWork()->sync($request->work_areas);
        }

        return response()->json(['success' => true, 'message' => 'Funder updated successfully']);
    }


    public function storeGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'name' => 'required|string|max:255',
            'charity_no' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:Publish,Draft',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder = Funder::create($validator->validated());

        return response()->json(['success' => 'General information saved successfully', 'funder_id' => $funder->id, 'redirect_url' => route('funder.edit', ['funder' => $funder->id])]);
    }

    public function updateGeneral(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:categories,id',
            'type_id' => 'required|exists:types,id',
            'name' => 'required|string|max:255',
            'charity_no' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'status' => 'required|in:Publish,Draft',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->update($validator->validated());

        return response()->json(['message' => 'General information saved successfully']);
    }


    public function storeCompany(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'address_line1' => 'nullable|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postcode' => 'nullable|string|max:255',
            'web' => 'nullable|url',
            'location' => 'required|string',
            'contact_person_name' => 'nullable|string|max:255',
            'contact_person_designation' => 'nullable|string|max:255',
            'contact_person_phone' => 'nullable|string|max:255',
            'contact_person_email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'google_plus' => 'nullable|url',
            'company_description' => 'nullable|string',
            'application_procedure' => 'nullable|string',
            'charity_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->update($validator->validated());

        return response()->json(['message' => 'Company information saved successfully']);
    }

    public function storeFinancials(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'financials' => 'required|array',
            'financials.*.year' => 'required|integer',
            'financials.*.income' => 'required|numeric',
            'financials.*.spend' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->financialDetails()->delete();
        $funder->financialDetails()->createMany($request->financials);

        return response()->json(['message' => 'Financial information saved successfully']);
    }

    public function storeDonations(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'donation_applications' => 'required|array',
            'donation_applications.*.year' => 'required|integer',
            'donation_applications.*.received' => 'required|integer',
            'donation_applications.*.successful' => 'required|integer',
            'donation_applications.*.rate' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->donationApplications()->delete();
        $funder->donationApplications()->createMany($request->donation_applications);

        return response()->json(['message' => 'Donation applications saved successfully']);
    }

    public function storePeople(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'trustee_boards' => 'required|array',
            'trustee_boards.*.trustee' => 'required|string|max:255',
            'trustee_boards.*.position' => 'required|string|max:255',
            'trustee_boards.*.status' => 'required|in:up-to-date,recently,registered',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->trusteeBoards()->delete();
        $funder->trusteeBoards()->createMany($request->trustee_boards);

        return response()->json(['message' => 'Trustee board information saved successfully']);
    }

    public function storeAreas(Request $request, Funder $funder)
    {
        $validator = Validator::make($request->all(), [
            'work_areas' => 'required|array',
            'work_areas.*' => 'exists:work_areas,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $funder->areasOfWork()->sync($request->work_areas);

        return response()->json(['message' => 'Work areas saved successfully']);
    }



    public function edit($id)
    {
        $funder = Funder::findOrFail($id);

        $categories = Category::all();
        $types = Type::all();
        $workAreas = WorkArea::all();

        return view('management.funder.edit', compact('funder', 'categories', 'types', 'workAreas'));
    }


    public function destroy(Funder $funder): JsonResponse
    {
        $funder->delete();
        return response()->json(['success' => 'Funder deleted successfully.'], 200);
    }
}
