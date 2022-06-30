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
use App\CustomFunction\CustomFunction;
use App\Models\Deine;

class DeineController extends Controller {

    public function __construct() {

    }

    public function getIndex() {

        $result = Deine::get()->toArray();
        return view('admin.deine.index')->with('result', $result);

    }

    public function store(Request $request){

        $data = $request->all();
        $pdf_id = $data['p_id'];
        
        $update_ar =array();

        $destinationPath = 'uploads';

        if(!empty($data['pdf_1'])){
            if(!empty($data['pdf_1_old'])){

                $unlink_path = $destinationPath.'/'.$data['pdf_1_old'];
                // dd($unlink_path);
                if(File::exists($unlink_path)) {
                    File::delete($unlink_path);
                }

                $image = $request->file('pdf_1');
                $filename = $request->file('pdf_1')->getClientOriginalName();

                $upload_success = $image->move($destinationPath, $filename);

                if($upload_success)
                {
                    $update_ar['pdf'] = $filename;
                }
            }else{

                $image = $request->file('pdf_1');
                $filename = $request->file('pdf_1')->getClientOriginalName();

                $upload_success = $image->move($destinationPath, $filename);

                if($upload_success)
                {
                    $update_ar['pdf'] = $filename;
                }
            }

        }else{
            $update_ar['pdf'] = $data['pdf_1_old'];
        }

        $update_ar['created_at'] = date('Y-m-d H:i:s');

        Deine::updateOrCreate(['p_id' => $pdf_id], $update_ar);

        return back()->with('success', 'Updated successfully.');
    }

}
