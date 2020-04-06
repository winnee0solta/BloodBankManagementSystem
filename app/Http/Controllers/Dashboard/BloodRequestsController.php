<?php

namespace App\Http\Controllers\Dashboard;

use App\Bloodrequests;
use App\Http\Controllers\Controller;
use App\PublicInfo;
use App\User;
use Illuminate\Http\Request;

class BloodRequestsController extends Controller
{
    public function index()
    {

        $blood_requests = array();

        foreach (Bloodrequests::all() as $blood_request) {

            $user = User::find($blood_request->user_id);

            if ($user) {

                $publicinfo = PublicInfo::where('user_id', $blood_request->user_id)->first();

                if ($publicinfo) {

                    array_push($blood_requests, array(
                        'blood_request_id' => $blood_request->id,
                        'user_id' => $blood_request->user_id,
                        'email' => $user->email,
                        'blood_group' => $blood_request->blood_group,
                        'volume' => $blood_request->volume,
                        'name' => $publicinfo->name,
                        'contact' => $publicinfo->contact,
                        'age' => $publicinfo->age,
                        'gender' => $publicinfo->gender,
                        'address' => $publicinfo->gender,

                        'created_at' => $blood_request->created_at,
                    ));
                } else {
                    $blood_request->delete();
                }
            } else {
                $blood_request->delete();
            }
        }
        return view('dashboard.bloodrequests.index',compact('blood_requests'));
    }

    public function destroy($blood_request_id){

        $bloodreq = Bloodrequests::find($blood_request_id);
        if($bloodreq){
            $bloodreq->delete();
        }

        return redirect('/blood-requests');
    }
}
