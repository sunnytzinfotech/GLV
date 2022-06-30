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
use App\CustomFunction\CustomFunction;
use App\Models\GeneralSetting;

class LogoController extends Controller {

    public function __construct() {

    }

    public function getIndex() {
        $wherein_arr = array('header_logo', 'favicon');
        $get_logo_data = GeneralSetting::whereIn('skey', $wherein_arr)->get()->toArray();

        return view('admin.logo')->with('logo_details', $get_logo_data);
    }

    public function updatelogo(Request $request) {
        $request->validate([
            'logo_img' => 'image|mimes:jpeg,png,jpg|max:300',
            'lstatus' => 'required',
            'id' => 'required',
                ], [
            'bstatus.id' => 'Details not updated, please try again!',
            'lstatus.required' => 'Please Select option for Enabled!',
            'logo_img.max' => 'The Image may not be greater than 300 kb!',
            'logo_img.image' => 'The File must be an Image!',
            'logo_img.mimes' => 'Image type Should Be .jpg .jpeg or .png!',
        ]);

        $id = $request->id;
        $logo_row = GeneralSetting::where('sid', $id)->first();

        $logo_row->status = CustomFunction::filter_input($request->lstatus);
        $logo_row->mdate = date('Y-m-d H:i:s');

        if ($request->hasFile('logo_img')) {
            $random_no = CustomFunction::random_string(10);
            $image = $request->file('logo_img');
            $name = $random_no . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/';

            $image->move($destinationPath, $name);

            $logo_row->sdesc = $name;

            // remove old image
            $result_old = GeneralSetting::select('sdesc')->where('sid', $id)->get()->toArray();
            $oldimg = $result_old[0]['sdesc'];

            if ($oldimg != '') {
                if (file_exists($destinationPath . $oldimg)) {
                    $filename = $destinationPath . $oldimg;
                    unlink($filename);
                }
            }
        }

        if ($logo_row->save()) {
            return back()->with('success', 'Details updated successfully.');
        } else {
            return back()->with('error', 'Details not updated, please try again!');
        }
    }

}
