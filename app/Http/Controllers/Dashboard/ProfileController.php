<?php

namespace App\Http\Controllers\Dashboard;

use App\AdminInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type == 'public') {
                return redirect('/');
            }
            return $next($request);
        });
    }

    //INdex Page
    public function index()
    {
        //get user data
        $user =  Auth::user();

        $profile = AdminInfo::where('user_id', Auth::User()->id)->first();

        return view('dashboard.profile.index', compact('profile', 'user'));
    }
    public function edit()
    {
        //get user data
        $user =  Auth::user();

        $profile = AdminInfo::where('user_id', Auth::User()->id)->first();



        return view('dashboard.profile.edit', compact('profile', 'user'));
    }
    public function editPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
        ]);

        //get user data
        $user =  Auth::user();

        $profile = AdminInfo::where('user_id', Auth::User()->id)->first();

        $profile->name = $request->name;
        $profile->contact = $request->contact;
        $profile->address = $request->address;

        //for image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('images/profile', $user->id . '_profile_image.' . $file->getClientOriginalExtension());
            $profile->image = $user->id . '_profile_image.' . $file->getClientOriginalExtension();
        }
         $profile->save();

        return redirect('/profile');
    }
}
