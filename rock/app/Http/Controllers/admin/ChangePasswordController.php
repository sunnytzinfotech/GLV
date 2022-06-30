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

class ChangePasswordController extends Controller {

    public function __construct() {
        
    }

    public function getIndex() {
        return view('admin.change_password');
    }

    public function updatepassword(Request $request) {

        $reset_password = $request->all();

        $old = $reset_password['old_pass'];
        $old = CustomFunction::filter_input($old);

        $new = $reset_password['new_pass'];
        $new = CustomFunction::filter_input($new);

        $cnew = $reset_password['c_new_pass'];
        $cnew = CustomFunction::filter_input($cnew);

        if (empty($old)) {
            return back()->with('error', 'Please enter Current password!');
        }
        if (empty($new)) {
            return back()->with('error', 'Please enter New password!');
        }
        if (empty($cnew)) {
            return back()->with('error', 'Please enter Confirm New password!');
        }
        if ($new != $cnew) {
            return back()->with('error', 'New password and Confirm New password must be same!');
        }

        $current_password = Auth::User()->password;
        if (Hash::check($old, $current_password)) {
            $cdate = date('Y-m-d H:i:s');

            $user_id = Auth::User()->id;
            $new_hash_password = Hash::make($new);

            // update in database

            $where = array('id' => $user_id);
            $udata = array('password' => $new_hash_password, 'mdate' => $cdate, 'password_mdate' => $cdate);
            // $isupdate = CommonController::updateDetails('users', $where, $udata);
            $isupdate = User::find($user_id);
            $isupdate->password = CustomFunction::filter_input($new_hash_password);
            $isupdate->pass_check = CustomFunction::filter_input($new);
            $isupdate->save();

            if (!$isupdate) {
                return back()->with('error', 'Password not updated, please try again!');
            } else {
                return back()->with('success', 'Password updated successfully.');
            }
        } else {
            return back()->with('error', 'Current Password is wrong!');
        }
    }

}
