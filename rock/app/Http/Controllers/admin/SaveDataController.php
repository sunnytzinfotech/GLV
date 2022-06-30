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
use Carbon;
use File;
use App\CustomFunction\CustomFunction;
use App\Models\Site_data;


class SaveDataController extends Controller {

    public function __construct() {

    }

    public function datasubmit(Request $request)
	{

        $post = $request -> all();
        // dd($post);
        //print_r($post);  exit;
        $mytime = Carbon\Carbon::now();

        $page = $post['page_name'];
        $token = $post['_token'];
        $status = 1;

        if(isset($post['description']) && !empty($post['description'])){
            $description = $post['description'];
        }
        if(isset($post['jason_hidden']) && !empty($post['jason_hidden'])){
            $description1 = $post['description1'];
            $description2 = $post['description2'];
            $description3 = $post['description3'];
            $jason_array = array($description1, $description2, $description3);
            $description = json_encode($jason_array);
        }


        if(isset($post['action']) && !empty($post['action'])){
            $action = $post['action'];
        }else{
            // Session::flash('admin_operationFailed','Some data missing!');
            // return Redirect::back();
            return redirect()->back()->with('error', 'Some data missing!');
        }

        if(isset($post['image']) && !empty($post['image']))
        {
            $vali = Validator::make($request->all(), [
                'image' => ['nullable', 'file', function($attribute, $value, $fail) {
                    $ext = $value->getClientOriginalExtension();
                    if (!in_array($ext, ['svg', 'svgz','jpg','png','jpeg','gif'])) {
                        return $fail($attribute . 'file must be svg, svgz, jpg, png, jpeg, gif.');
                    }
                }]
            ]);

            if($vali->fails()){
                $messages = $vali->messages();
                // print_r($messages);
                // exit;
                // Session::flash('admin_operationFailed','upload the valid file, enter valid value');
                // return Redirect::back();
                return redirect()->back()->with('error', 'upload the valid file, enter valid value');
            }


            $result = DB::table('site_data')->where('action','=',$action)->where('page_name','=',$page)->get();
            //print_r($result);exit;
            if(isset($result) && !empty($result))
            {
                if(count($result) > 0){
                    $fdata=array();
                    foreach($result as $key => $value){
                        $fdata[$value->action] = $value->description;
                    }
                    $img_data = $fdata[$action];
                    $unlink_path = 'uploads/site_data/' .$img_data;
                    if (File::exists($unlink_path))
                    {
                        File::delete($unlink_path);
                    }
                }
            }
            $image = $request->file('image');
            //dd($image);
            $file_name = $image->getClientOriginalName();
            $temp = explode(".", $file_name);
            $input['img'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'uploads/site_data/';
            $image->move($destinationPath, $input['img']);
            $description = $input['img'];
        }

        if(isset($post['video']) && !empty($post['video']))
        {
            $vali = Validator::make($request->all(), [
                'video' => 'required|file|mimes:mp4,mov,ogg,qt | max:20000',
            ]);

            if($vali->fails()){
                // Session::flash('admin_operationFailed','upload the valid file, enter valid value');
                // return Redirect::to('admin/home');
                return redirect()->back()->with('error', 'upload the valid file, enter valid value');
            }
            $result = DB::table('site_data')->where('action','=',$action)->where('page_name','=',$page)->get();

            if(isset($result) && !empty($result))
            {
                if(count($result) > 0){
                    $fdata=array();
                    foreach($result as $key => $value){
                        $fdata[$value->action] = $value->description;
                    }
                    $img_data = $fdata[$action];
                    $unlink_path = 'uploads/video/' .$img_data;
                    if (File::exists($unlink_path))
                    {
                        File::delete($unlink_path);
                    }
                }
            }
            $image = $request->file('video');
            $file_name = $image->getClientOriginalName();
            $temp = explode(".", $file_name);
            $input['video'] = $temp[0].'_'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = 'uploads/video/';
            $image->move($destinationPath, $input['video']);
            $description = $input['video'];
        }

        if(isset($post['file_pdf']) && !empty($post['file_pdf']))
        {
            $vali = Validator::make($request->all(), [
                'file_pdf' => 'required|file|mimes:pdf|max:10000000',
            ]);

            if($vali->fails()){
                // Session::flash('admin_operationFailed','upload the valid file, enter valid value');
                // return Redirect::to('admin/'.$page);
                return redirect()->back()->with('error', 'upload the valid file, enter valid value');
            }

            $result = DB::table('site_data')->where('action','=',$action)->where('page_name','=',$page)->where('status','=',$status)->get();
            //print_r($result);exit;
            if(isset($result) && !empty($result))
            {
                if(count($result) > 0){
                    $fdata=array();
                    foreach($result as $key => $value){
                        $fdata[$value->action] = $value->description;
                    }
                    $img_data = $fdata[$action];
                    $unlink_path = 'uploads/' .$img_data;
                    if (File::exists($unlink_path))
                    {
                        File::delete($unlink_path);
                    }
                }
            }
            $file = $request->file('file_pdf');

            /* echo $file->getClientoriginalName(); exit;
            print_r($file); exit; */
            $input['pdf'] = $file->getClientoriginalName();
            $destinationPath = 'uploads/';
            $file->move($destinationPath, $input['pdf']);
            $description = $input['pdf'];
        }


        $primary_key = array(
            'action' => $action
        );

        $update_array = array(
            'token' => $token,
            'action'	 => $action,
            'description' => $description,
            'page_name'	=> $page,
        );
        $result =  Site_data::updateOrCreate($primary_key, $update_array);
        // Session::flash('admin_operationSuccess','Data Updated Successfully');
        // return redirect()->back();
        return redirect()->back()->with('success', 'Data Updated Successfully');
        exit;

	}

}
