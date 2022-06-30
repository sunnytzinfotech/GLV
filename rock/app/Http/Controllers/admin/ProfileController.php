<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use View;
use DB;
use Hash;
use App\CustomFunction\CustomFunction;
use App\Models\User;

class ProfileController extends Controller {

    public function __construct() {

    }

    public function getIndex() {
        $cuid = Auth::user()->id;
        $ud = User::where('id','=',$cuid)->get()->toArray();
        return view('admin.profile')->with('ud', $ud);
    }

    public function updateprofile(Request $request) {

        $this->validate($request,
        [
          'user_name' => 'required',
          'email' => 'required|email',
          'password_user' => 'nullable|min:6|max:15',
              ], [
          'user_name.required' => 'Please enter First name!',
          'password_user.min' => 'Password length must be min. 6 characters!',
          'password_user.max' => 'The Password may not be greater than 15 characters.!',
        ]);

        $ischangepassword = 0;
        if (isset($request->password_user) && $request->password_user != '') {
            if (strpos($request->password_user, ' ') !== false) {
                return back()->with('error', 'Invaild character and space not allowed in password.<br/>`=\/:;\'"<>? are not allowed!');
            }

            $ischangepassword = 1;
            $newpassword = $request->password_user;
            $password_hash = Hash::make($newpassword);
        }

        $cuid = Auth::user()->id;

        $email_user = CustomFunction::filter_input($request->email);
        // check for already registered email
        $check_email = User::select('id')->where('email', $email_user)->whereNotIn('id', array($cuid))->count();
        if ($check_email > 0) {
            return back()->with('error', 'This Email is already registered, try other email address!');
        }

        // $userp = UserProfile::where('id', $cuid)->first();
        // $userp->mdate = date('Y-m-d H:i:s');

        $ud = User::find($cuid);
        if ($ischangepassword == 1) {
            $ud->user_name = CustomFunction::filter_input($request->user_name);
            $ud->password = $password_hash;
            $ud->password_mdate = date('Y-m-d H:i:s');
        }
        
        $ud->user_name = CustomFunction::filter_input($request->user_name);
        $ud->email = $email_user;

        if ($ud->save()) {
            if ($ischangepassword == 1) {
                return back()->with('success', 'Profile & Password updated successfully.');
            } else {
                return back()->with('success', 'Profile updated successfully.');
            }
        } else {
            return back()->with('error', 'Profile updated added!');
        }
    }

}
