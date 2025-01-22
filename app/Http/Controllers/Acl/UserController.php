<?php

namespace App\Http\Controllers\Acl;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Support\Str;

use Illuminate\Http\RedirectResponse;
class UserController extends Controller
{
    function __construct()
    {
          $this->middleware('permission:user-list', ['only' => ['index']]);
          $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);

        return view('management.acl.users.index', compact('data'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('management.acl.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'error',
                'message' => 'error',
                'error' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        return response()->json(['success' => 'Successfully Saved.', 'data' => $user]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::find($id);
        return view('management.acl.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        return view('management.acl.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => 'error',
                'message' => 'error',
                'error' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        return response()->json(['success' => 'Successfully Saved.', 'data' => $user]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $contact = User::find($id)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $contact]);
    }

    public function profileSetting()
    {
        return view('management.acl.users.profileSetting');
    }

    //    public function profileSettingUpdate(Request $request,$id)
    //    {
    //
    //
    //        $validator = Validator::make($request->all(), [
    //            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //            'name' => 'required',
    //            'email' => 'required|email|unique:users,email,'.$id,
    ////            'contact_no' => 'required',
    ////            'nic' => 'required',
    //        ]);
    //
    //        if ($validator->fails()) {
    //            return response()->json(['errors' => $validator->errors()], 422);
    //        }
    //
    ////        dd($request);
    //        $user = User::findorfail($id);
    //        DB::beginTransaction();
    //        try {
    //            if($request->file('profile_image')){
    //                $imageName = time().'.'.$request->profile_image->extension();
    //                $request->profile_image->move(public_path('users'), $imageName);
    //            }
    //
    //
    //            $request = $request->all();
    //            if(isset($request['profile_image'])) {
    //                $request['profile_image'] = 'users/' . $imageName;
    //            }
    //            $user->update($request);
    //            DB::commit();
    //        } catch (Exception $e) {
    //            DB::rollBack();
    //            return response()->json(['error' => $e->getMessage()]);
    //        }
    //        return response()->json(['success' => 'Successfully Updated.','data' => $user]);
    //
    //
    //    }

    public function profileSettingUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json(['success' => 'User profile updated successfully', 'data' => $user]);
    }

    public function updatePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6|different:old_password',
            'confirm_password' => 'required|same:new_password',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);

            if (!Hash::check($request->old_password, $user->password)) {
                $customErrors['old_password'] = ['The provided old password does not match.'];
            }
            if (!empty($customErrors)) {
                return response()->json(['errors' => $customErrors], 422);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();
            DB::commit();
            return response()->json(['success' => 'Successfully Saved.']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function getTable(Request $request)
    {
        $users = User::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);
                $sq->where('email', 'like', $searchTerm);
            });
        })
            ->latest()
            ->paginate(10);

        return view('management.acl.users.getList', compact('users'));
    }

    public function exportToExcel()
    {
        $discounts = User::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'name');
        $sheet->setCellValue('B1', 'email');
        $sheet->setCellValue('C1', 'created at');

        $row = 2;
        foreach ($discounts as $discount) {
            $sheet->setCellValue('A' . $row, $discount->name);
            $sheet->setCellValue('B' . $row, $discount->email);
            $sheet->setCellValue('C' . $row, date('D d M Y', strtotime($discount->created_at)));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'users.xlsx';
        $writer->save($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
