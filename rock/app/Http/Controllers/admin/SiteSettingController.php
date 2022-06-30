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
use App\Models\SiteSetting;


class SiteSettingController extends Controller {

    public function __construct() {

    }

    public function getIndex() {
        $get_site_data = SiteSetting::all()->toArray();
        return view('admin.site_setting')->with('site_data', $get_site_data);
    }

    public function updateSite(Request $request) {

        $rules = array(
            'stitle' => 'required',
        );
        $messages = [
            'stitle.required' => 'Please Enter Site Title!',
        ];

        $data_velidator = $request->all();

        $id = $data_velidator['id'];

        $validator = Validator::make($data_velidator, $rules, $messages);

        if ($validator->fails()) {
            return Redirect::back()
                            ->withErrors($validator);
        } else {
            $ss = SiteSetting::first();
            $ss->site_name = CustomFunction::filter_input($request->stitle);
            $ss->site_email = CustomFunction::filter_input($request->site_email);
            $ss->contact_no = CustomFunction::filter_input($request->contact_no);
            $ss->fax = CustomFunction::filter_input($request->fax);;
            $ss->updated_at = date('Y-m-d H:i:s');

            if ($request->hasFile('slogo')) {
                $random_no = CustomFunction::random_string(10);
                $image = $request->file('slogo');
                $name = $random_no . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'uploads/';

                $image->move($destinationPath, $name);

                $ss->slogo = $name;

                // remove old image
                $result_old = SiteSetting::select('slogo')->where('sid', $id)->first();
                $oldimg = $result_old['slogo'];

                if ($oldimg != '') {
                    if (file_exists($destinationPath . $oldimg)) {
                        $filename = $destinationPath . $oldimg;
                        unlink($filename);
                    }
                }
            }

            if ($request->hasFile('sflogo')) {
                $random_no = CustomFunction::random_string(10);
                $image = $request->file('sflogo');
                $name = $random_no . '.' . $image->getClientOriginalExtension();
                $destinationPath = 'uploads/';

                $image->move($destinationPath, $name);

                $ss->sflogo = $name;

                // remove old image
                $result_old = SiteSetting::select('sflogo')->where('sid', $id)->first();
                $oldimg = $result_old['sflogo'];

                if ($oldimg != '') {
                    if (file_exists($destinationPath . $oldimg)) {
                        $filename = $destinationPath . $oldimg;
                        unlink($filename);
                    }
                }
            }

            if ($ss->save()) {
                return back()->with('success', 'Details updated successfully.');
            } else {
                return back()->with('error', 'Details not updated, please try again!');
            }
        }
    }

}
