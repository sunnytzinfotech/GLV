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
use File;
use URL;
use App\CustomFunction\CustomFunction;
use App\Models\User;
use App\Models\HomePortal;
use App\Models\UserEmpfehlungCode;
use App\Models\HomePortalCategory;

class PortalController extends Controller {

    public function __construct() {

    }

    public function getIndex() {

        $result = HomePortal::orderBy('id','desc')->get()->toArray();
        $portal_category = HomePortalCategory::orderBy('c_id','desc')->get()->toArray();

        return view('admin.portal.index')->with('result', $result)->with('portal_category', $portal_category);

    }

    public function add() {

        $portal_category = HomePortalCategory::orderBy('c_id','desc')->get()->toArray();
        return view('admin.portal.add')->with('portal_category', $portal_category);

    }

    public function store(Request $request) {

        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:500'
        ], [
            'logo.max' => 'The Image may not be greater than 500 kb!',
            'logo.image' => 'The File must be an Image!',
            'logo.mimes' => 'Image type Should Be .jpg .jpeg or .png!',
        ]);


        $today = date('Y-m-d H:i:s');

        $title = $request->title;
        $decription = $request->decription;
        $price = $request->price;
        $color = $request->color_code;

        $model = 0;
        if (isset($request->model_check) && !empty($request->model_check)){
            $model = $request->model_check;
        }
        $b_btn_text = $request->blue_btn_text;
        $b_btn_text_2 = $request->b_btn_text_2;
        $b_btn_text_3 = $request->b_btn_text_3;
        $b_btn_url = $request->blue_btn_url;
        $g_btn_text = $request->gray_btn_text;
        $g_btn_text_2 = $request->g_btn_text_2;
        $g_btn_text_3 = $request->g_btn_text_3;
        $g_btn_url = $request->gray_btn_url;

        $s_b_btn_text = $request->s_b_btn_text;
        $s_b_btn_text_2 = $request->s_b_btn_text_2;
        $s_b_btn_text_3 = $request->s_b_btn_text_3;

        $s_g_btn_text = $request->s_gray_btn_text;
        $s_g_btn_text_2 = $request->s_g_btn_text_2;
        $s_g_btn_text_3 = $request->s_g_btn_text_3;

        $active = $request->active;

        $document = '';
        if(isset($request->images) && !empty($request->images))
        {
            $exclusive_img_ar = explode(",",$request->images);
            $exclusive_img_ar = json_encode($exclusive_img_ar);
            $document = $exclusive_img_ar;
        }

        $btn_iframe = $request->btn_iframe;
        $check_internal_frame = $request->optionsRadios;
        $sub_price = $request->sub_price;
        $category_id = $request->category_id;

        $m_description = $request->modal_description;

        $special_tipps = 0;
        if (isset($request->special_tipps) && !empty($request->special_tipps)){
            $special_tipps = $request->special_tipps;
        }

        if ($files = $request->file('logo')) {

            //store file into document folder
            $random_no = CustomFunction::random_string(10);

            $image = $request->file('logo');
            $name = $random_no . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/modelLogo/';

            $image->move($destinationPath, $name);

        }

        $update_ar =array();
        $update_ar['logo'] = $name;
        $update_ar['title'] = $title;
        $update_ar['decription'] = $decription;
        $update_ar['price'] = $price;
        $update_ar['sub_price'] = $sub_price;
        $update_ar['color'] = $color;
        $update_ar['model'] = $model;
        $update_ar['b_btn_text'] = $b_btn_text;
        $update_ar['b_btn_text_2'] = $b_btn_text_2;
        $update_ar['b_btn_text_3'] = $b_btn_text_3;
        $update_ar['b_btn_url'] = $b_btn_url;
        $update_ar['g_btn_text'] = $g_btn_text;
        $update_ar['g_btn_text_2'] = $g_btn_text_2;
        $update_ar['g_btn_text_3'] = $g_btn_text_3;
        $update_ar['g_btn_url'] = $g_btn_url;

        $update_ar['s_b_btn_text'] = $s_b_btn_text;
        $update_ar['s_b_btn_text'] = $s_b_btn_text_2;
        $update_ar['s_b_btn_text'] = $s_b_btn_text_3;

        $update_ar['s_g_btn_text'] = $s_g_btn_text;
        $update_ar['s_g_btn_text_2'] = $s_g_btn_text_2;
        $update_ar['s_g_btn_text_3'] = $s_g_btn_text_3;

        $update_ar['active'] = $active;
        $update_ar['document'] = $document;


        $update_ar['check_internal_frame'] = $check_internal_frame;
        $update_ar['btn_iframe'] = $btn_iframe;
        $update_ar['m_description'] = $m_description;
        $update_ar['created_at'] = $today;
        $update_ar['special_tipps'] = $special_tipps;
        $update_ar['category_id'] = $category_id;

        HomePortal::create($update_ar);

        return Redirect::to('admin/get-portal')->with('success', 'Portal Details Add successfully.');

    }

    public function edit($id) {

        $portal_data = HomePortal::where('id', "=" , $id)->first();
        $portal_category = HomePortalCategory::orderBy('c_id','desc')->get()->toArray();
        return view('admin.portal.edit',compact('portal_data','portal_category'));
    }

    public function update(Request $request) {

        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:500'
        ], [
            'logo.max' => 'The Image may not be greater than 500 kb!',
            'logo.image' => 'The File must be an Image!',
            'logo.mimes' => 'Image type Should Be .jpg .jpeg or .png!',
        ]);

        $post = $request->all();


        $today = date('Y-m-d H:i:s');
        $id = $request->id;

        $title = $request->title;
        $decription = $request->decription;
        $price = $request->price;
        $sub_price = $request->sub_price;
        $color = $request->color_code;

        $model = 0;
        if (isset($request->model_check) && !empty($request->model_check)){
            $model = $request->model_check;
        }
        $b_btn_text = $request->blue_btn_text;
        $b_btn_text_2 = $request->b_btn_text_2;
        $b_btn_text_3 = $request->b_btn_text_3;
        $b_btn_url = $request->blue_btn_url;

        $g_btn_text = $request->gray_btn_text;
        $g_btn_text_2 = $request->g_btn_text_2;
        $g_btn_text_3 = $request->g_btn_text_3;
        $g_btn_url = $request->gray_btn_url;

        $s_b_btn_text = $request->s_b_btn_text;
        $s_b_btn_text_2 = $request->s_b_btn_text_2;
        $s_b_btn_text_3 = $request->s_b_btn_text_3;

        $s_g_btn_text = $request->s_gray_btn_text;
        $s_g_btn_text_2 = $request->s_g_btn_text_2;
        $s_g_btn_text_3 = $request->s_g_btn_text_3;

        $check_internal_frame = $request->optionsRadios;
        $btn_iframe = $request->btn_iframe;

        $m_description = $request->modal_description;
        $category_id = $request->category_id;

        $active = $request->active;

        $document = '';
        if(isset($request->images) && !empty($request->images))
        {
            $exclusive_img_ar = explode(",",$request->images);
            $exclusive_img_ar = json_encode($exclusive_img_ar);
            $document = $exclusive_img_ar;
        }

        $special_tipps = 0;
        if (isset($request->special_tipps) && !empty($request->special_tipps)){
            $special_tipps = $request->special_tipps;
        }

        if(isset($post['logo']) && !empty($post['logo']))
        {
            $vali = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if($vali->fails()){
                return Redirect::back()->with('error', 'upload the valid file, enter valid value');
            }
            $destinationPath = 'uploads/modelLogo/';

            if(!empty($post['oldlogo'])){
                $unlink_path = $destinationPath.'/'.$post['oldlogo'];
                if(File::exists($unlink_path)) {
                    File::delete($unlink_path);
                }
                $logo = $request->file('logo');
                $random_no = CustomFunction::random_string(10);
                $input['img'] = $random_no.'.'.$logo->getClientOriginalExtension();

                $img = \Image::make($logo->getRealPath());
                $img->save($destinationPath.$input['img']);
                $name = $input['img'];
            }
        }else{
            if(isset($post['oldlogo']) && !empty($post['oldlogo'])){
                $name = $post['oldlogo'];
            }
        }

        $update_ar =array();
        $update_ar['logo'] = $name;
        $update_ar['title'] = $title;
        $update_ar['decription'] = $decription;
        $update_ar['price'] = $price;
        $update_ar['sub_price'] = $sub_price;
        $update_ar['color'] = $color;
        $update_ar['model'] = $model;
        $update_ar['b_btn_text'] = $b_btn_text;
        $update_ar['b_btn_text_2'] = $b_btn_text_2;
        $update_ar['b_btn_text_3'] = $b_btn_text_3;
        $update_ar['b_btn_url'] = $b_btn_url;
        $update_ar['g_btn_text'] = $g_btn_text;
        $update_ar['g_btn_text_2'] = $g_btn_text_2;
        $update_ar['g_btn_text_3'] = $g_btn_text_3;

        $update_ar['s_b_btn_text'] = $s_b_btn_text;
        $update_ar['s_b_btn_text_2'] = $s_b_btn_text_2;
        $update_ar['s_b_btn_text_3'] = $s_b_btn_text_3;

        $update_ar['s_g_btn_text'] = $s_g_btn_text;
        $update_ar['s_g_btn_text_2'] = $s_g_btn_text_2;
        $update_ar['s_g_btn_text_3'] = $s_g_btn_text_3;


        $update_ar['active'] = $active;
        $update_ar['document'] = $document;

        $update_ar['g_btn_url'] = $g_btn_url;
        $update_ar['check_internal_frame'] = $check_internal_frame;
        $update_ar['btn_iframe'] = $btn_iframe;
        $update_ar['m_description'] = $m_description;
        $update_ar['updated_at'] = $today;
        $update_ar['special_tipps'] = $special_tipps;
        $update_ar['category_id'] = $category_id;

        HomePortal::where('id', $id)->update($update_ar);

        return Redirect::to('admin/get-portal')->with('success', 'Portal Details update successfully.');

    }

    public function delete(Request $request)
    {
        $post = $request->all();

        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $portal_data = HomePortal::where('id', "=" , $id)->first();

            $destinationPath = 'uploads/modelLogo/';

            $unlink_path = $destinationPath.'/'.$portal_data->logo;

            if(File::exists($unlink_path)) {
                File::delete($unlink_path);
            }

            DB::table('home_portal')->where('id','=', $id)->delete();

            echo '0';

        }else{
            echo '1';
        }
    }

    public function tippgeberPortal()
    {
        $result = UserEmpfehlungCode::orderBy('c_id','desc')->get()->toArray();
        return view('admin.portal.tippgeber_ortal')->with('result', $result);
    }

    public function addCategory(Request $request) {

        $request->validate([
            'file' => 'image|mimes:jpeg,png,jpg|max:500'
        ], [
            'file.max' => 'The Image may not be greater than 500 kb!',
            'file.image' => 'The File must be an Image!',
            'file.mimes' => 'Image type Should Be .jpg .jpeg or .png!',
        ]);


        $today = date('Y-m-d H:i:s');

        $title = $request->title;
        $color = $request->color_code;



        if ($files = $request->file('file')) {

            //store file into document folder
            $random_no = CustomFunction::random_string(10);

            $image = $request->file('file');
            $name = $random_no . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads/';

            $image->move($destinationPath, $name);

        }

        $update_ar =array();
        $update_ar['c_image'] = $name;
        $update_ar['c_name'] = $title;
        $update_ar['color'] = $color;
        $update_ar['created_at'] = $today;

        // dd($update_ar);
        HomePortalCategory::create($update_ar);

        return back()->with('success', 'Portal Category Add successfully.');

    }

    public function editCategory(Request $request) {

        $post = $request->all();


        $today = date('Y-m-d H:i:s');
        $id = $request->id;

        $title = $request->title;
        $color = $request->color_code;
        

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
        $update_ar['c_image'] = $name;
        $update_ar['c_name'] = $title;
        $update_ar['color'] = $color;
        $update_ar['updated_at'] = $today;

        HomePortalCategory::where('c_id', $id)->update($update_ar);

        return back()->with('success', 'Portal Category update successfully.');

    }

    public function deleteCategory(Request $request)
    {
        $post = $request->all();
        

        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $portal_data = HomePortalCategory::where('c_id', "=" , $id)->first();

            $destinationPath = 'uploads/';

            $unlink_path = $destinationPath.'/'.$portal_data->c_image;

            if(File::exists($unlink_path)) {
                File::delete($unlink_path);
            }

            DB::table('home_portal_category')->where('c_id','=', $id)->delete();

            echo '0';

        }else{
            echo '1';
        }
    }


    public function documentStore(Request $request)
    {
        $success_ar_file_name = array();
		$destinationPath = document;
        if(!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }
		$files = request()->file('req_images');

		foreach($files as $file)
		{
			$filename_ar = array();
            $random_no = CustomFunction::random_string(10);
			$newfilename = $random_no . '.' . $file->getClientOriginalExtension();
			$file->move($destinationPath,$newfilename);

			$filename_ar['oldFileName'] = $file->getClientOriginalName();
			$filename_ar['dfileName'] = $newfilename;

			$success_ar_file_name[] = $filename_ar;
		}

		if(!empty($success_ar_file_name))
		{
			echo json_encode($success_ar_file_name,true);
		}

    }

    public function documentRemove(Request $request)
	{
		$destinationPath = document;

		$data = $request->all();
		$file_name = $data['file'];
		File::delete($destinationPath.$file_name);
		if(isset($data['file']) && isset($data['data_file_id']) )
		{

			$id = $data['data_file_id'];
			$result = HomePortal::where('id','=',$id)->first();
			if(!empty($result))
			{
				$update_ar = $data;
				if( !empty($data['images']) )
				{
					$img_srt = $data['images'];
					$image_ar = explode(",", $img_srt);
					$update_ar['document'] = json_encode( $image_ar );
				}
				else{
					$update_ar['document'] = '';
				}

				unset($update_ar['_token']);
				unset($update_ar['id']);
				unset($update_ar['file']);
				unset($update_ar['data_file_id']);

				$file_name = $data['file'];
				File::delete($destinationPath.$file_name);
				HomePortal::where('id','=',$id)->update($update_ar);

			}
		}
	}

	public function documentGet(Request $request)
	{
		$data_post = $request->all();
        
        $hidden_file_name_string = array();
        $hidden_file_name = '';
        $hidden_file_list = array();
        $file_path = '';
		$id = $data_post['id'];

		if(isset($id) && ($id != 0))
		{
			$result = HomePortal::where('id','=',$id)->first();
			if(!empty($result))
			{
				$hidden_file_name = $result->document;
				if($hidden_file_name != '')
				{
					$hidden_file_name_ar = json_decode($hidden_file_name);

					foreach( $hidden_file_name_ar as $key_file => $value_file)
					{
						$file_list = array();
						$file_name = $value_file;
						$hidden_file_name_string[] = $file_name;
						$file_path = 'uploads/document/'.$file_name;
						$file_full_path = URL::to($file_path);
						$file_list['name'] = $file_name;

						foreach (glob("uploads/*.*") as $filename)
						{
							if($filename == $file_path)
							{
								$file_list['size'] = filesize($filename);
								$file_list['type'] = File::extension($file_name);
							}else{
								$file_list['size'] = filesize($filename);
								$file_list['type'] = File::extension($file_name);
							}
						}

						$file_list['file'] = $file_path;
						$file_list['url'] = $file_full_path;
						$hidden_file_list[] = $file_list;
					}
					$hidden_file_name  = implode(',',$hidden_file_name_string);
                    echo json_encode($hidden_file_list,true);
				}
			}
		}
	}

    public function actionConfim(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            $get_user = DB::table('home_portal')->where('id','=', $id)->update(["active"=>1]);


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

            $get_user = DB::table('home_portal')->where('id','=', $id)->update(["active"=>0]);


            echo '0';

        }else{
            echo '1';
        }
    }
}
