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
use App\Models\User;
use App\Models\HomeSlider;

class HomeSliderController extends Controller {

    public function __construct() {

    }

    public function getIndex(Request $request)
    {
    	$id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            $result = HomeSlider::orderBy('id','desc')->get()->toArray();
	    	return view('admin.slider.index',compact('result'));

		}
		else{
			Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
		}
    }

    public function addSlider(Request $request) {

        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg|max:500'
        ], [
            'file.max' => 'The Image may not be greater than 500 kb!',
            'file.image' => 'The File must be an Image!',
            'file.mimes' => 'Image type Should Be .jpg .jpeg or .png!',
        ]);


        $today = date('Y-m-d H:i:s');

        $text_1 = $request->text_1;
        $text_2 = $request->text_2;
        $status = $request->status;


        if ($files = $request->file('file')) {

            //store file into document folder
            $random_no = CustomFunction::random_string(10);

            $image = $request->file('file');
            $name = $random_no . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/';

            $image->move($destinationPath, $name);

        }

        $update_ar =array();
        $update_ar['image'] = $name;
        $update_ar['text_1'] = $text_1;
        $update_ar['text_2'] = $text_2;
        $update_ar['status'] = $status;
        $update_ar['created_at'] = $today;


        HomeSlider::create($update_ar);

        return back()->with('success', 'Slider Add successfully.');

    }

    public function editSlider(Request $request) {

        $post = $request->all();



        $today = date('Y-m-d H:i:s');
        $id = $request->id;

        $text_1 = $request->text_1;
        $text_2 = $request->text_2;
        $status = $request->status;


        if(isset($post['file']) && !empty($post['file']))
        {
            $vali = Validator::make($request->all(), [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if($vali->fails()){
                return Redirect::back()->with('error', 'upload the valid file, enter valid value');
            }
            $destinationPath = 'uploads/';

            if(!empty($post['old_file'])){
                $unlink_path = $destinationPath.'/'.$post['old_file'];
                if(File::exists($unlink_path)) {
                    File::delete($unlink_path);
                }
                $logo = $request->file('file');
                $random_no = CustomFunction::random_string(10);
                $input['img'] = $random_no.'.'.$logo->getClientOriginalExtension();

                $img = \Image::make($logo->getRealPath());
                $img->save($destinationPath.$input['img']);
                $name = $input['img'];
            }
        }else{
            if(isset($post['old_file']) && !empty($post['old_file'])){
                $name = $post['old_file'];
            }
        }

        $update_ar =array();
        $update_ar['image'] = $name;
        $update_ar['text_1'] = $text_1;
        $update_ar['text_2'] = $text_2;
        $update_ar['status'] = $status;
        $update_ar['updated_at'] = $today;

        HomeSlider::where('id', $id)->update($update_ar);

        return back()->with('success', 'Slider update successfully.');

    }

    public function delete(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $portal_data = HomeSlider::where('id', "=" , $id)->first();

            $destinationPath = 'uploads/';

            $unlink_path = $destinationPath.'/'.$portal_data->image;

            if(File::exists($unlink_path)) {
                File::delete($unlink_path);
            }

            DB::table('home_slider')->where('id','=', $id)->delete();

            echo '0';

        }else{
            echo '1';
        }
    }

}
