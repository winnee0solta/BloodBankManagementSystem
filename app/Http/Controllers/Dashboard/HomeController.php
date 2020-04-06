<?php

namespace App\Http\Controllers\Dashboard;

use App\DonationRecord;
use App\Events;
use App\Http\Controllers\Controller;
use App\Recipients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

        $total_events = Events::count();
        $total_donations = 0;
        $total_volume = 0;

        $records =    DonationRecord::all();

        foreach ($records as $record) {
            $total_donations = $total_donations + 1;
            $total_volume = $total_volume + $record->volume;
        }

        //in stock blood quantities
        $blood_quantities = $this->bloodQuantities();

        return view(
            'dashboard.home.index',
            compact(
                'total_events',
                'total_donations',
                'total_volume',
                'blood_quantities'
            )
        );
    }



    // custom functions

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
