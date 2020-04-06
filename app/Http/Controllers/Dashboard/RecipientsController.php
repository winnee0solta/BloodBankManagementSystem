<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Recipients;
use Illuminate\Http\Request;

class RecipientsController extends Controller
{
    public function index()
    {
        $recipients = Recipients::all();
        return view('dashboard.recipients.index', compact('recipients'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'blood_group' => 'required',
            'volume' => 'required',
        ]);


        Recipients::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'blood_group' => $request->blood_group,
            'volume' => $request->volume,
        ]);

        return redirect('/recipients');
    }
    public function destroy($recipient_id){
        $recipient = Recipients::find($recipient_id);
        if($recipient){
            $recipient->delete();
        }

        return redirect('/recipients');
    }
}
