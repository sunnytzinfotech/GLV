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
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserDetail;


class AdminController extends Controller {

    public function __construct() {
    }

    public function getIndex() {

        $cuid = Auth::user()->master_admin;
        if($cuid == 1){
            $result = User::where('urole','=',1)->where('master_admin','=',0)->get();
            // dd($result);

            return View::make('admin/user_admin/index')->with('result', $result);
        }else{
            return Redirect::to('admin/dashboard');
        }

    }

    public function addAdmin(Request $request) {


        $this->validate($request,
        [
          'user_name' => 'required',
          'email' => 'required|email',
          'password' => 'nullable|min:6|max:15',
          'c_password' => 'required|same:password'
              ], [
          'user_name.required' => 'Please enter First name!',
          'password.min' => 'Password length must be min. 6 characters!',
          'password.max' => 'The Password may not be greater than 15 characters.!',
          'c_password' => 'password and Confirm password must be same!'
        ]);


        $data = $request->all();



        if (isset($request->password) && $request->password != '') {
            if (strpos($request->password, ' ') !== false) {
                return back()->with('error', 'Invaild character and space not allowed in password.<br/>`=\/:;\'"<>? are not allowed!');
            }
            $newpassword = $request->password;
            $password_hash = Hash::make($newpassword);
        }

        $email_user = CustomFunction::filter_input($request->email);
        // check for already registered email
        $check_email = User::select('id')->where('email', $email_user)->count();
        if ($check_email > 0) {
            return back()->with('error', 'This Email is already registered, try other email address!');
        }

        $ud = New User;
        $ud->user_name = CustomFunction::filter_input($request->user_name);
        $ud->password = $password_hash;
        $ud->email = $email_user;

        $ud->status = 1;
        $ud->admin_confirm = null;
        $ud->urole = 1;
        $ud->email_confirm = null;

        $ud->pass_check = $request->password;

        $user_detail_id = $ud->id;

        $new_user_detail = new UserDetail;
        $new_user_detail->user_id = $user_detail_id;
        $new_user_detail->save();

        if ($ud->save()) {
            return back()->with('success', 'Admin create successfully.');
        } else {
            return back()->with('error', 'Admin not added!');
        }
    }


    public function updateAdmin(Request $request) {


        $this->validate($request,
        [
          'user_name' => 'required',
          'email' => 'required|email',
          'password' => 'nullable|min:6|max:15',
          'c_password' => 'same:password'
              ], [
          'user_name.required' => 'Please enter First name!',
          'password.min' => 'Password length must be min. 6 characters!',
          'password.max' => 'The Password may not be greater than 15 characters.!',
          'c_password' => 'password and Confirm password must be same!'
        ]);


        $data = $request->all();


        if (isset($request->password) && $request->password != '') {
            if (strpos($request->password, ' ') !== false) {
                return back()->with('error', 'Invaild character and space not allowed in password.<br/>`=\/:;\'"<>? are not allowed!');
            }
            $newpassword = $request->password;
            $password_hash = Hash::make($newpassword);
        }

        $cuid = $request->id;

        $email_user = CustomFunction::filter_input($request->email);
        // check for already registered email
        $check_email = User::select('id')->where('email', $email_user)->whereNotIn('id', array($cuid))->count();
        if ($check_email > 0) {
            return back()->with('error', 'This Email is already registered, try other email address!');
        }


        $ud = User::find($cuid);
        $ud->user_name = CustomFunction::filter_input($request->user_name);
        $ud->password = $password_hash;
        $ud->email = $email_user;

        $ud->status = 1;
        $ud->admin_confirm = 1;
        $ud->urole = 1;
        $ud->email_confirm = null;

        $ud->pass_check = $request->password;

        if ($ud->save()) {
            return back()->with('success', 'Admin update successfully.');
        } else {
            return back()->with('error', 'Admin not updated!');
        }
    }

    public function actionConfim(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["status"=>1]);


            echo '0';

        }else{
            echo '1';
        }
    }
    public function actionConfimDeactive(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('users')->where('id','=', $id)->update(["status"=>0]);


            echo '0';

        }else{
            echo '1';
        }
    }

}
