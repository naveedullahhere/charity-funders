<?php

namespace App\Http\Controllers;

use App\Models\AthleteProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AthleteProfileController extends Controller
{
    public function index()
    {
        $profiles = AthleteProfile::latest()->paginate(10);
        return view('management.athletes.index', compact('profiles'));
    }

    public function getTable(Request $request)
    {
        $AthleteProfiles = AthleteProfile::when($request->filled('search'), function ($q) use ($request) {
            $searchTerm = '%' . $request->search . '%';
            return $q->where(function ($sq) use ($searchTerm) {
                $sq->where('name', 'like', $searchTerm);

            });
        })->latest()->paginate(10);

        return view('management.athletes.getList', compact('AthleteProfiles'));


    }

    public function create()
    {
        return view('management.athletes.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:athlete_profiles,email',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'body_type' => 'nullable|in:Ectomorph,Mesomorph,Endomorph',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }



        $thumbnailName = null;
        if ($request->hasFile('profile_image')) {
            // Generate a random file name and store the file in public/thumbnails
            $thumbnail = $request->file('profile_image');
            $thumbnailName =  'athelete/' . uniqid() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('athelete'), $thumbnailName);
        }


        $data = $request->all();

        $data['profile_image'] = $thumbnailName;
        $data['unique_string'] = Str::uuid();

        $profile = AthleteProfile::create($data);

        return redirect()->route('athletes.index')->with('success', 'Profile created successfully!');
    }

    public function show(AthleteProfile $athleteProfile)
    {
        return view('management.athletes.show', compact('athleteProfile'));
    }

    public function edit($id)
    {
        $athleteProfile = AthleteProfile::findOrFail($id);

        return view('management.athletes.edit', compact('athleteProfile'));
    }

    public function update(Request $request, AthleteProfile $athleteProfile)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:athlete_profiles,email,' . $athleteProfile->id,
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'body_type' => 'nullable|in:Ectomorph,Mesomorph,Endomorph',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        if ($request->hasFile('profile_image')) {
            if ($athleteProfile->profile_image) {
                Storage::disk('public')->delete($athleteProfile->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        $athleteProfile->update($data);

        return redirect()->route('athletes.index')->with('success', 'Profile updated successfully!');
    }

    public function destroy($id)
    {
        $athleteProfile = AthleteProfile::findOrFail($id);

        if ($athleteProfile->profile_image) {
            Storage::disk('public')->delete($athleteProfile->profile_image);
        }

        $athleteProfile->delete();
        return response()->json(['success' => 'Successfully Deleted.', 'data' => $athleteProfile]);

    }


    public function showProfile($profile_link)
    {
        $profile = AthleteProfile::where('unique_string', $profile_link)->first();

        if (!$profile) {
            return abort(404, message: 'Profile not found.');
        }

        // Check if profile is already linked to a user
        if ($profile->user) {
            return redirect('/login')->with('message', 'This profile is already linked to a user.');
        }

        // Show registration form
        return view('auth.register', compact('profile'));
    }


    public function sendEmail($id){
        $profile =AthleteProfile::findOrFail($id);
      
        $data['profile'] = $profile;
        Mail::send('email.athleteprofile',$data ,  function ($message) use ($profile) {
            $message->to($profile->email)
                ->subject('Your Event Pictures Are Ready! - '.config('app.name'));
        });
    }
}
