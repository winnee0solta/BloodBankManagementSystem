<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\PublicInfo;
use App\User;
use Illuminate\Http\Request;

class DonorsController extends Controller
{
    public function index()
    {

        $donors = array();

        foreach (PublicInfo::all() as $public_info) {

            $user = User::find($public_info->user_id);

            if ($user) {

                array_push($donors, array(
                    'publicinfo_id' => $public_info->id,
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'image' => $public_info->image,
                    'name' => $public_info->name,
                    'contact' => $public_info->contact,
                    'age' => $public_info->age,
                    'blood_group' => $public_info->blood_group,
                    'gender' => $public_info->gender,
                    'address' => $public_info->address,
                ));
            } else {
                //user dsnt exists
                //delete
                $public_info->delete();
            }
        }
        return view('dashboard.donors.index', compact('donors'));
    }

    public function removeDonor($user_id)
    {

        $user = User::find($user_id);
        if ($user) {

            $public_info =  PublicInfo::where('user_id', $user_id)->first();

            if ($public_info) {
                $public_info->delete();
                $user->delete();
            } else {
                //remove user
                $user->delete();
            }
        }

        return back();
    }
}
