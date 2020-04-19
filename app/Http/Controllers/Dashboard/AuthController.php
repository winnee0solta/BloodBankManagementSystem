<?php

namespace App\Http\Controllers\Dashboard;

use App\AdminInfo;
use App\CustomHelpers\UserHelper;
use App\Http\Controllers\Controller;
use App\PublicInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login Pageview
    public function index()
    {
        return view('dashboard.login');
    }
    //register  Pageview
    public function registerPage()
    {
        return view('dashboard.register');
    }
    /**
     * Login User
     */
    public function loginUser(Request $request)
    {


        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $userhelper = new UserHelper();
        if ($userhelper->checkIfUserExists($request->email)) {

            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                // The passwords match...
                //check if rehash needed
                if (Hash::needsRehash($user->password)) {
                    $user->password = Hash::make($request->password);
                    $user->save();
                }

                //Authenticate
                auth()->attempt([
                    'email' => request('email'),
                    'password' => request('password')
                ]);

                //get type
                switch ($user->type) {
                    case 'admin':
                        return redirect('/dashboard');
                        break;
                    case 'staff':
                        return redirect('/dashboard');
                        break;
                    case 'public':
                        return redirect('/');
                        break;

                        // TODO: add remaining cases
                    default:
                        # code...
                        break;
                }
            }
            return back();
        }



        return redirect('/');
    }

    /**
     * Register admin
     * user for creating 1st admin account
     * @param $email , $password
     * @return json resonse message
     */
    public function registerAdmin($email, $password)
    {
        //check if email already exists
        if (User::where('email', $email)->count() > 0) {
            return array(
                'message' => "Email already exists"
            );
        }

        $user = new  User();
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->type = 'admin';
        $user->save();

        AdminInfo::create([
            'user_id' => $user->id,
            'image' => '-',
            'name' => '-',
            'contact' => '-',
            'address' => '-',
        ]);

        return array(
            'message' => "User created",
            'user' => $user
        );
    }
    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'contact' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'blood_group' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        //check if email already exists
        if (User::where('email', $request->email)->count() > 0) {

            return back();
        }

        $user = new  User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->type = 'public';
        $user->save();

        PublicInfo::create([
            'user_id' => $user->id,
            'image' => '-',
            'name' => $request->name,
            'contact' => $request->contact,
            'age' => $request->age,
            'blood_group' => $request->blood_group,
            'gender' => $request->gender,
            'gender' => $request->gender,
            'address' => '-',
        ]);

        //Authenticate
        auth()->attempt([
            'email' => request('email'),
            'password' => request('password')
        ]);


        return redirect('/');
    }


    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }

    /**
     *
     */
}
