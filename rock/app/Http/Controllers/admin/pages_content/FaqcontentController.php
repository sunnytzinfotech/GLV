<?php

namespace App\Http\Controllers\admin\pages_content;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use View;
use Validator;
use Hash;
use Carbon\Carbon;
use Mail;
use Auth;
use File;
use Cart;
use URL;
use Input;
use Artisan;
use App\Models\Faq;

class FaqcontentController extends Controller
{

	public function index()
	{
        $data = array();
        $data['faq_data'] = array();
        $faq_data = Faq::get();
        if(isset($faq_data) && $faq_data->isNotEmpty())
        {
            $data['faq_data'] = $faq_data;
        }

        return View::make('admin/faq/index', $data);

	}

    public function addFaq(Request $request)
	{
        $post = $request->all();
        // dd($post);
        $insert_ar = array();
        $insert_ar['title'] = $post['title'];
        $insert_ar['text'] = $post['text'];
        $insert_ar['status'] = $post['status'];

        Faq::insert($insert_ar);
        Session::flash('success','Item added successfully');
        return redirect()->back();
    }

    public function updateFaq(Request $request)
	{
        $post = $request->all();

        $update_ar = array();
        $update_ar['title'] = $post['title'];
        $update_ar['text'] = $post['text'];
        $update_ar['status'] = $post['status'];

        Faq::where('id','=', $post['id'])->update($update_ar);
        Session::flash('success','Item updated successfully');
        return redirect()->back();
    }

    public function deleteFaq(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id']))
        {
            Faq::where('id','=',$post['id'])->delete();
            Session::flash('success','Item deleted successfully');
            echo '0';
        }else{
            Session::flash('error','Something went wrong');
            echo '1';
        }
    }
}
