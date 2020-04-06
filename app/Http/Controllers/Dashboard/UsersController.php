<?php

namespace App\Http\Controllers\Dashboard;

use App\AdminInfo;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {

        $users = array();

        foreach (User::where('type', '!=', 'public')->orderBy('type')->get() as $user) {

            $admininfo = AdminInfo::where('user_id', $user->id)->first();

            if ($admininfo) {

                array_push($users, array(
                    'user_id' => $user->id,
                    'admininfo_id' => $admininfo->id,
                    'image' => $admininfo->image,
                    'type' => $user->type,
                    'email' => $user->email,
                    'name' => $admininfo->name,
                    'contact' => $admininfo->contact,
                    'address' => $admininfo->address,
                    'created_at' => $user->created_at,
                ));
            } else {
                $user->delete();
            }
        }

        return view('dashboard.users.index', compact('users'));
    }
    public function addUser(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'type' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if (User::where('email', $request->email)->count() == 0) {

            $user = new  User();
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->type =  $request->type;
            $user->save();

            AdminInfo::create([
                'user_id' => $user->id,
                'image' => '-',
                'name' => $request->name,
                'contact' => $request->contact,
                'address' => $request->address,
            ]);
        }

        return redirect('/users');
    }

    public function removeUser($user_id)
    {

        $user = User::find($user_id);
        if ($user) {

            $admininfo =  AdminInfo::where('user_id', $user_id)->first();

            if ($admininfo) {
                $admininfo->delete();
                $user->delete();
            } else {
                $user->delete();
            }
        }
        return redirect('/users');
    }
    public function editPage($user_id)
    {

        $user = User::find($user_id);
        if ($user) {

            $admininfo =  AdminInfo::where('user_id', $user_id)->first();

            if ($admininfo) {

                return view('dashboard.users.edit', compact('user', 'admininfo'));
            } else {
                $user->delete();
            }
        }
        return redirect('/users');
    }
    public function editUser($user_id, Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'type' => 'required',
        ]);

        $user = User::find($user_id);
        if ($user) {

            $admininfo =  AdminInfo::where('user_id', $user_id)->first();

            if ($admininfo) {

                $user->type = $request->type;
                if ($request->has('password')) {
                    $user->password = bcrypt($request->password);
                }
                $user->save();
                $admininfo->name = $request->name;
                $admininfo->contact = $request->contact;
                $admininfo->address = $request->address;
                $admininfo->save();

                return redirect('/users');
            } else {
                $user->delete();
            }
        }
        return redirect('/users');
    }
}
