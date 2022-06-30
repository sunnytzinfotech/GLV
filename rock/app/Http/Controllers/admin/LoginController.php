<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use Illuminate\Http\Request;
use Mail;
use Session;
use Hash;
use DB;
use App\CustomFunction\CustomFunction;
use App\Models\User;
use App\Models\SiteSetting;

class LoginController extends Controller {

    public function __construct() {

    }

    public function getIndex() {
        return view('admin.login');
    }

    public function doLogin(Request $request) {

        // validate the info, create rules for the inputs
        $rules = array(
            'email' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $messages = [
            'email.required' => 'Email is required!',
        ];

        $data_velidator = $request->all();

        // run the validation rules on the inputs from the form
        $validator = Validator::make($data_velidator, $rules, $messages);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('admin/login')
                            ->withErrors($validator); // send back all errors to the login form
                            // ->withInput(Request::except('password')); // send back the input (not the password) so that we can repopulate the form
        } else {

            // create our user data for the authentication
            $result = DB::table('users')->where('status','=', 1)->where('email','=', $data_velidator['email'])->first();
            if(isset($result) && !empty($result)){

                $userdata = array(
                    'email' => CustomFunction::filter_input($data_velidator['email']),
                    'password' => CustomFunction::filter_input($data_velidator['password']),
                    'urole' => $result->urole,
                    'id' => $result->id
                );
                // dd($data_velidator);
                if (Auth::attempt($userdata)) {
                    \Session::put('adminLog', $userdata);
                    Session::save();
                    return Redirect::to('admin/dashboard');
                } else {
                    return back()->with('error', 'Email or Password is wrong!');
                }
            }else{
                return back()->with('error', 'Email or Password is wrong!');
            }

        }
    }

    public function doLogout() {
        Auth::logout(); // log the user out of our application
        return Redirect::to('admin/'); // redirect the user to the login screen
    }

    public function getIndexForgotPassword() {
        return view('admin.forgot_password');
    }

    public function GenerateNewPassword(Request $request) {
      
        $this->validate($request,
        [
          'adminemail' => 'required|email'
        ],[
          'adminemail.required' => 'Please enter Email address!',
          'adminemail.email' => 'Please enter valid Email address!',
        ]);

        $adminemail = CustomFunction::filter_input($request->adminemail);

        $check_user_exists = User::where('email', $adminemail)->where('urole', 1)->get()->toArray();
        if (empty($check_user_exists)) {
            return back()->with('error', 'No details found, please try again!')->withInput(Input::all());
        }

        $uname = $check_user_exists[0]['user_name'] . ' ' . $check_user_exists[0]['user_name'];

        $get_ss_data = SiteSetting::all()->toArray();

        $phno1 = $get_ss_data[0]['contact_no'];
        $dbemail = $get_ss_data[0]['site_email'];
        $site_name = $get_ss_data[0]['site_name'];

        $random_no = CustomFunction::random_string(10);
        $new_password = Hash::make($random_no);

        $login_url = url('admin/');

        $data = array('fullname' => $uname, 'email' => $adminemail, 'new_password' => $random_no, 'login_url' => $login_url,
            'phno1' => $phno1, 'dbemail' => $dbemail, 'site_name' => $site_name);

        try {
            Mail::send('admin.admin_resetpassword_mail', $data, function ($message) use ($adminemail, $site_name) {
                $message->to($adminemail, $site_name)->subject
                        ('Password reset successfully');
            });

            $update_user = User::where('email', $adminemail)->first();
            $update_user->password = $new_password;
            $update_user->password_mdate = date('Y-m-d H:i:s');

            if ($update_user->save()) {
                return redirect('/admin/')->with('success', "Your admin account password has been reset successfully, you will receive new password in your email account.<br/>
                Note: If you don't see the email in your inbox, then please check your SPAM folder too.");
            } else {
                return back()->with('error', 'Password not Reset, please try again!');
            }
        } catch (Exception $exc) {
            return back()->with('error', 'Password not Reset, please try again!');
        }
    }

}
