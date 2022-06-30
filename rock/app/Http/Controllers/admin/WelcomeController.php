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
use App\Models\WelComePage;

class WelcomeController extends Controller {

    public function __construct() {

    }

    public function welComeSetting(Request $request)
    {
        $id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            $wel_come_text = WelComePage::where('page_name','welcome')->where('action','wel_come_text')->first();
            $logo_1 = WelComePage::where('page_name','welcome')->where('action','wel_come_logo_1')->first();
            $logo_2 = WelComePage::where('page_name','welcome')->where('action','wel_come_logo_2')->first();
            $logo_3 = WelComePage::where('page_name','welcome')->where('action','wel_come_logo_3')->first();
            // dd($logo_2);
            return view('admin.wel_come_page.index',compact('wel_come_text','logo_1','logo_2','logo_3'));

        }
        else{
            Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
        }
    }

    public function welComeSave(Request $request)
    {
        $id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            $post = $request->all();

            $page = $post['page_name'];
            $action = $post['action'];
            $token = $post['_token'];
            $status = 1;
            $today = date('Y-m-d H:i:s');
            // dd($post);

            $text_1 = '';
            if(isset($post['text_1']) && !empty($post['text_1'])){
                $text_1 = $post['text_1'];
            }
            $text_2 = '';
            if(isset($post['text_2']) && !empty($post['text_2'])){
                $text_2 = $post['text_2'];
            }
            $url = '';
            if(isset($post['url']) && !empty($post['url'])){
                $url = $post['url'];
            }

            $page_image  = '';

            if(isset($post['page_image']) && !empty($post['page_image']))
            {
                $vali = Validator::make($request->all(), [
                    'page_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                ]);

                if($vali->fails()){
                    Session::flash('admin_operationFailed','upload the valid file, enter valid value');
                     return Redirect::to('admin/'.$page);
                }

                $result = DB::table('home_section_page')->where('action','=',$action)->where('page_name','=',$page)->where('status','=',$status)->get();
                if(isset($result) && !empty($result))
                {
                    if(count($result) > 0){
                        $fData=array();
                        foreach($result as $key => $value){

                            $fData[$value->action] = $value->page_image;
                        }
                        $img_data = $fData[$action];
                        $unlink_path = 'uploads/' .$img_data;
                        if(File::exists($unlink_path)) {
                            $data = File::delete($unlink_path);
                        }
                    }
                }
                $destinationPath = 'uploads/';
                $page_image = $request->file('page_image');
                $random_no = CustomFunction::random_string(10);
                $input['img'] = $random_no.time().'.'.$page_image->getClientOriginalExtension();

                $img = \Image::make($page_image->getRealPath());
                $height = Image::make($page_image->getRealPath())->height();
                $width = Image::make($page_image->getRealPath())->width();
                $img->resize($width,null);
                $img->save($destinationPath.$input['img']);
                $page_image = $input['img'];
            }

            $update_array = array(
                'page_name' => $page,
                'text_1' => $text_1,
                'text_2' => $text_2,
                'logo' => $page_image,
                'url' => $url,
                'updated_at' => $today,
                'status' => 1,
            );  

            $primary_key = array(
                'action' => $action
            );


            $result =  WelComePage::updateOrCreate($primary_key, $update_array);
            return Redirect::back()->with('success', 'Details updated successfully.');
            exit;

        }
        else{
            Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
        }
    }

    public function testimonialEdit(Request $request)
    {
        $id = 0;
        $sessionData = Session::get('adminLog');
        $id = $sessionData['id'];
        if (isset($id) && ($id != 0)) {

            $post = $request->all();

            $token = $post['_token'];
            $status = 1;
            $today = date('Y-m-d H:i:s');

            $author_name = '';
            if(isset($post['author_name']) && !empty($post['author_name'])){
                $author_name = $post['author_name'];
            }
            $description = '';
            if(isset($post['description']) && !empty($post['description'])){
                $description = $post['description'];
            }

            $destinationPath = 'uploads/';

                if(!empty($post['image_name'])){
                    if(!empty($post['old_image_name'])){


                        $unlink_path = $destinationPath.'/'.$post['old_image_name'];
                        if(File::exists($unlink_path)) {
                            File::delete($unlink_path);
                        }
                        $file = $request->file('image_name');
                        $random_no = CustomFunction::random_string(10);
                        $img_name = $random_no.time().$file->getClientOriginalExtension();

                        $img = Image::make($file->getRealPath());
                        $height = Image::make($file->getRealPath())->height();
                        $width = Image::make($file->getRealPath())->width();
                        $img->resize($width,null);
                        $data = $img->save($destinationPath.'/'.$img_name, 90,);

                        // $file->move($destinationPath, $img_name);
                        $image_name = $img_name;

                    }else{

                        $file = $request->file('image_name');
                        $random_no = CustomFunction::random_string(10);
                        $img_name = $random_no.time().$file->getClientOriginalExtension();

                        $img = Image::make($file->getRealPath());
                        $height = Image::make($file->getRealPath())->height();
                        $width = Image::make($file->getRealPath())->width();
                        $img->resize($width,null);
                        $data = $img->save($destinationPath.'/'.$img_name, 90);

                        // $file->move($destinationPath, $img_name);
                        $image_name = $img_name;
                    }

                }else{
                    $image_name = $post['old_image_name'];
                }
                $post['status'] = '1';
                $id = $post['id'];


            $update_array = array(
                'author_name' => $author_name,
                'author_image' => $image_name,
                'description' => $description,
                'created_at' => $today,
                'status' => 1,
            );  
            // dd($update_array);

            $result =  DB::table('testimonial')->where('id',$id)->update($update_array);
            return Redirect::back()->with('success', 'Details Add successfully.');
            exit;

        }
        else{
            Session::flash('admin_operationFailed','Please Login!');
            return Redirect::to('admin/login');
        }
    }



}
