<?php

namespace App\Http\Controllers\Dashboard;

use App\AdminInfo;
use App\CustomHelpers\SystemLogger;
use App\DonationRecord;
use App\Events;
use App\Http\Controllers\Controller;
use App\PublicInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
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

    //Home/index Page
    public function index()
    {
        $events = Events::orderBy('created_at', 'desc')->get();

        $datas = array();
        foreach ($events as $event) {
            $records = DonationRecord::where('event_id', $event->id)->get();

            $total_donation = 0;
            $total_volume = 0;

            foreach ($records as $record) {
                $total_donation = $total_donation + 1;
                $total_volume = $total_volume + $record->volume;
            }

            array_push($datas, array(
                'id' => $event->id,
                'title' => $event->title,
                'desc' => $event->desc,
                'location' => $event->location,
                'created_at' => $event->created_at,
                'date_time' => $event->date_time,
                'total_donation' => $total_donation,
                'total_volume' => $total_volume,
            ));
        }


        return view('dashboard.events.index', compact('datas'));
    }
    public function addEventPage()
    {
        return view('dashboard.events.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'desc' => 'required',
            'location' => 'required',
            'date_time' => 'required',
        ]);

        $event = new Events();
        $event->title = $request->title;
        $event->desc = $request->desc;
        $event->location = $request->location;
        $event->date_time = $request->date_time;
        $event->save();


        $user =  AdminInfo::where('user_id', Auth::user()->id)->first();

        $logger = new  SystemLogger();
        $logger->addLog('Added new event "' . $request->title . '"', $user->name);

        return redirect('/events');
    }
    public function editEventPage($event_id)
    {

        $event = Events::find($event_id);
        if ($event) {
            return view('dashboard.events.edit', compact('event'));
        }
        return redirect('/events');
    }
    public function editEvent($event_id, Request $request)
    {

        $event = Events::find($event_id);
        if ($event) {
            $this->validate($request, [
                'title' => 'required',
                'desc' => 'required',
                'location' => 'required',
                'date_time' => 'required',
            ]);

            $event->title = $request->title;
            $event->desc = $request->desc;
            $event->location = $request->location;
            $event->date_time = $request->date_time;
            $event->save();

            $user =  AdminInfo::where('user_id', Auth::user()->id)->first();

            $logger = new  SystemLogger();
            $logger->addLog('Edited event "' . $request->title . '"', $user->name);

            return redirect('/events');
        }
        return redirect('/events');
    }

    public function singleEvent($event_id)
    {

        $event = Events::find($event_id);
        if ($event) {
            //get donations
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
                        'id'=> $record->id,
                        'event_id'=> $record->event_id,
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
            return view('dashboard.events.single', compact('event', 'records' ));
        }
        return redirect('/events');
    }

    public function removeEvent($event_id){
        $event = Events::find($event_id);
        if($event){
            DonationRecord::where('event_id',$event_id)->delete();
            $event->delete();
        }
        return redirect('/events');
    }

    //DONATION RECORD

    //add dontaion record page
    public function addDonationRecordHomeView($event_id)
    {


        $event = Events::find($event_id);
        if ($event) {

            return view('dashboard.events.donationrecord.index', compact('event'));
        }
        return redirect('/events');
    }

    public function addDonationRecordUnregistered($event_id, Request $request)
    {

        $event = Events::find($event_id);
        if ($event) {
            $this->validate($request, [
                'name' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'address' => 'required',
                'contact_no' => 'required',
                'blood_group' => 'required',
                'volume' => 'required',
            ]);

            $record = new DonationRecord();
            $record->event_id = $event->id;
            $record->user_id = 0;
            $record->name = $request->name;
            $record->age = $request->age;
            $record->gender = $request->gender;
            $record->address = $request->address;
            $record->contact_no = $request->contact_no;
            $record->blood_group = $request->blood_group;
            $record->volume = $request->volume;
            $record->save();

            $user =  AdminInfo::where('user_id', Auth::user()->id)->first();
            $logger = new  SystemLogger();
            $logger->addLog('Added Donation Record event = "' . $event->title . ' donor = "' . $request->name . '"', $user->name);

            return redirect('/events/' . $event->id . '/view');
        }
        return redirect('/events');
    }
    public function addDonationRecordRegistered($event_id, Request $request)
    {

        $this->validate($request, [
            'email' => 'required',
            'blood_group' => 'required',
            'volume' => 'required',
        ]);
        $event = Events::find($event_id);
        if ($event) {

            //check if user exists
            $user =  User::where('email', $request->email)->first();

            if ($user) {

                $record = new DonationRecord();
                $record->event_id = $event->id;
                $record->user_id = $user->id;
                $record->name = '-';
                $record->age = '-';
                $record->gender = '-';
                $record->address = '-';
                $record->contact_no =  '-';
                $record->blood_group = $request->blood_group;
                $record->volume = $request->volume;
                $record->save();

                $admin_user =  AdminInfo::where('user_id', Auth::user()->id)->first();
                $logger = new  SystemLogger();
                $logger->addLog('Added Donation Record event = "' . $event->title . ' donor user id = "' . $user->id . '"', $admin_user->name);

                return redirect('/events/' . $event->id . '/view');
            } else {
                return back();
            }



            // $user =  AdminInfo::where('user_id', Auth::user()->id)->first();
            // $logger = new  SystemLogger();
            // $logger->addLog('Added Donation Record event = "' . $event->title . ' donor = "' . $request->name . '"', $user->name);

            return redirect('/events/' . $event->id . '/view');
        }
        return redirect('/events');
    }

    public function removeDonationRecord($event_id, $record_id, Request $request)
    {

        $event = Events::find($event_id);
        if ($event) {
            $records = DonationRecord::where('event_id', $event->id)->where('id', $record_id)->delete();
        }

        return redirect('/events/' . $event->id . '/view');
    }
}
