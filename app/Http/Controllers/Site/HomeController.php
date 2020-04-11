<?php

namespace App\Http\Controllers\Site;

use App\Bloodrequests;
use App\DonationRecord;
use App\Events;
use App\Http\Controllers\Controller;
use App\PublicInfo;
use App\Recipients;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index');
    }
    public function eventsView()
    {

        $events = Events::orderBy('created_at', 'desc')->get();
        return view('site.events', compact('events'));
    }
    public function showProfile()
    {

        if (Auth::user()->type != 'public') {
            return redirect('/');
        }

        $profile = PublicInfo::where('user_id', Auth::user()->id)->first();
        $user = Auth::user();

        //joined events
        $joined_events = $this->joinedEvents();


        return view('site.profile', compact('profile', 'user', 'joined_events'));
    }


    public function editProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'age' => 'required',
            'blood_group' => 'required',
            'gender' => 'required',
        ]);

        //get user data
        $user =  Auth::user();

        $profile = PublicInfo::where('user_id', Auth::User()->id)->first();

        $profile->name = $request->name;
        $profile->contact = $request->contact;
        $profile->address = $request->address;
        $profile->age = $request->age;
        $profile->blood_group = $request->age;
        $profile->gender = $request->gender;

        //for image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move('images/profile', $user->id . '_profile_image.' . $file->getClientOriginalExtension());
            $profile->image = $user->id . '_profile_image.' . $file->getClientOriginalExtension();
        }
        $profile->save();

        return redirect('/public-profile');
    }


    public function singleEventView($event_id)
    {
        $event = Events::find($event_id);
        if ($event) {

            //dontaion record for event

            $raw_records = DonationRecord::where('event_id', $event->id)->orderBy('created_at', 'desc')->get();

            $records = array();
            foreach ($raw_records as $record) {



                if ($record->user_id == 0) {
                    $name = $record->name;
                    $age = $record->age;
                    $gender = $record->gender;
                    $address = $record->address;
                    $contact_no = $record->contact_no;
                } else {
                    //get user public info

                    $record_user = User::find($record->user_id);
                    if ($record_user) {

                        $publicinfo =  PublicInfo::where('user_id', $record_user->id)->first();
                        $name = $publicinfo->name;
                        $age = $publicinfo->age;
                        $gender = $publicinfo->gender;
                        $address = $publicinfo->address;
                        $contact_no = $publicinfo->contact;
                    } else {
                        //user dosnt exists
                        //remove record
                        $record->delete();
                        continue;
                    }
                }

                array_push(
                    $records,
                    array(
                        'id' => $record->id,
                        'event_id' => $record->event_id,
                        'name' => $name,
                        'age' => $age,
                        'gender' => $gender,
                        'address' => $address,
                        'contact_no' => $contact_no,
                        'blood_group' => $record->blood_group,
                        'volume' => $record->volume,
                    )
                );
            }

            return view('site.single-event', compact('event', 'records'));
        }
        return redirect('/events');
    }


    public function requestForBloodView()
    {

        //in stock blood quantities
        $blood_quantities = $this->bloodQuantities();

        return view('site.request-for-blood', compact('blood_quantities'));
    }

    public function requestForBlood(Request $request)
    {
        $this->validate($request, [
            'blood_group' => 'required',
            'volume' => 'required',
            'reason' => 'required',
        ]);

        $blood_request = new   Bloodrequests();
        $blood_request->user_id = Auth::user()->id;
        $blood_request->blood_group = $request->blood_group;
        $blood_request->volume =  $request->volume;
        $blood_request->reason =  $request->reason;
        $blood_request->save();

        return redirect('/request-for-blood/success');
    }

    public function requestSuccessView()
    {

        return view('site.request-for-blood-success');
    }


    //custom functions
    function joinedEvents()
    {

        $joined_events = array();

        //get email
        Auth::user()->email;


        foreach (DonationRecord::where('user_id', Auth::user()->id)->get() as $record) {

            $event = Events::find($record->event_id);
            if ($event) {

                array_push($joined_events, array(
                    'event_id' => $event->id,
                    'title' => $event->title,
                    'desc' => $event->desc,
                    'location' => $event->location,
                    'date_time' => $event->date_time,
                    'blood_group' => $record->blood_group,
                    'volume' => $record->volume,
                ));
            } else {
                $record->delete();
            }
        }

        return $joined_events;
    }

    function bloodQuantities()
    {
        $quantity = array();
        //Total donated
        foreach (DonationRecord::all() as $record) {


            $found_key = array_search($record->blood_group, array_column($quantity, 'group'));

            if (false !== $found_key) {

                $quantity[$found_key]['volume'] =  $quantity[$found_key]['volume'] + $record->volume;
            } else {

                array_push($quantity, array(
                    'group' => $record->blood_group,
                    'volume' => $record->volume,
                ));
            }
        }

        foreach (Recipients::all() as $recip) {

            $found_key = array_search($recip->blood_group, array_column($quantity, 'group'));

            if (false !== $found_key) {

                $quantity[$found_key]['volume'] =  $quantity[$found_key]['volume'] - $recip->volume;
            }
        }
        return $quantity;
    }
}
