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
use StdClass;
use Session;
use Image;
use URL;
use File;
use App\CustomFunction\CustomFunction;
use App\Models\MetaInfo;
use App\Models\CommonPage;

class CommonController extends Controller {

    public function __construct() {

    }

    public function update_meta_info(Request $request)
    {
        $request->validate([
            'page_name' => 'required',
                ], [
            'page_name.required' => 'invaild request!',
        ]);
        $page_name = $request->page_name;
        $meta = MetaInfo::where('page_name', $page_name)->first();

        $meta->meta_keywords = CustomFunction::filter_input($request->meta_keywords);
        $meta->meta_desc = CustomFunction::filter_input($request->meta_desc);
        $meta->mdate = date('Y-m-d H:i:s');

        if ($meta->save()) {
            return back()->with('success', 'Details updated successfully.');
        } else {
            return back()->with('error', 'Details not updated!');
        }
    }

    public function uploadimage(Request $request)
    {

        // Allowed extentions.
        $allowedExts = array("gif", "jpeg", "jpg", "png");
        $allowedMime = array("image/gif", "image/jpeg", "image/pjpeg", "image/x-png", 'image/png');

        if ($request->hasFile('editor_img')) {
            $random_no = CustomFunction::random_string(10);
            $image = $request->file('editor_img');
            $mimetype = $image->getMimeType();
            if (in_array($mimetype, $allowedMime)) {
                $name = $random_no . '.' . $image->getClientOriginalExtension();
                $destinationPath = img_upload_path;
                $image->move($destinationPath, $name);

                // Generate response.
                $response = new StdClass;
                $response->link = file_path . '/' . $name;
                $response->name = $name;
                echo stripslashes(json_encode($response));
            }
        }
    }

    public function deleteimage(Request $request)
    {
        if (isset($request->src) && $request->src != '') {
            $filename = $request->src;
            if (file_exists(img_upload_path . $filename)) {
                $deleteurl = img_upload_path . $filename;
                unlink($deleteurl);
                echo '1';
                exit();
            }
        }
        echo '0';
        exit();
    }

}
