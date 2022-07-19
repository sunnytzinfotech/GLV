<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUS;
use App\Models\SiteSetting;
use App\CustomFunction\CustomFunction;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserDetail;
use Session;
use Hash;
use DB;
use Mail;
use PDF;
use File;
use App\Models\HomePortal;
use App\Models\UserEmpfehlungCode;
use App\Models\Deine;
use App\Models\HomePortalCategory;
use App\Models\HomeSlider;
use App\Models\Site_data;
use App\Models\Faq;
use App\Models\LogData;
use App\Models\Footer;
use Carbon\Carbon;


class IndexController extends Controller

{

    public function __construct()
    {
        // method's body
    }

    public function index(Request $request)
    {
        $result = HomePortal::where('special_tipps','=','1')->where('active','=','1')->get()->toArray();

        $home_slider = HomeSlider::where('status','=', 1)->orderBy('id','desc')->get()->toArray();
        $result_1 = HomePortal::where('active','=','1')->get()->toArray();
        $auth = Auth::user();

        $portal_category = HomePortalCategory::orderBy('c_id','asc')->get()->toArray();

        $siteData = array();
        $pageData = Site_data::where('page_name','home')->get();
		if(isset($pageData) && !empty($pageData))
		{
			foreach($pageData as $page_key => $page_value )
			{
				$siteData[$page_value->action] = $page_value->description;
			}
		}

        if(isset($auth) && !empty($auth)){
            return view('frontview.index')->with('result', $result)->with('auth', $auth)->with('portal_category', $portal_category)->with('result_1', $result_1)->with('home_slider', $home_slider)->with('siteData', $siteData);
        }else{
            return view('frontview.index')->with('result', $result)->with('portal_category', $portal_category)->with('result_1', $result_1)->with('home_slider', $home_slider)->with('siteData', $siteData);
        }
    }

    public function deineIndex(Request $request)
    {
        $auth = Auth::user();

        $result = Deine::get()->toArray();

        if(isset($auth) && !empty($auth)){
            $broker = $auth->broker;
            if($auth->admin_confirm != 0){
                return view('frontview.deine')->with('result', $result)->with('broker', $broker);
            }else if ($auth->email_confirm != 0){
                return view('frontview.deine')->with('result', $result)->with('broker', $broker);
            }else {
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function emailTemplate(Request $request)
    {
        return view('frontview.email_template');
    }

    public function doSignup(Request $request) {
        $data_post = $request->all();
        $logo1 = asset('/assets/frontend/images/email_logo_1.png');
        $logo2 = asset('/assets/frontend/images/email_logo_2.png');

        $request->validate([
            'frau' => 'required',
            'nachname' => 'required',
            'vorname' => 'required',
            'email' => 'required|email',
            'conform_number' => 'regex:/[0-9]/',
            'number1' => 'regex:/[0-9]/',
            'number2' => 'regex:/[0-9]/',
        ]);

        $sent_email = CustomFunction::filter_input($request->uemail);
        $random_no = CustomFunction::random_string(10);
        $key = 'rockit';
        $new_key = $random_no . '#' . $key;
        $new_ket_encode = base64_encode($new_key);

        $mr_mrs = CustomFunction::filter_input($request->frau);
        $user_name = CustomFunction::filter_input($request->nachname);
        $last_name = CustomFunction::filter_input($request->vorname);
        $broker = CustomFunction::filter_input($request->broker);
        $GLV_tipsters = CustomFunction::filter_input($request->insurance_broker);
        $Empfohlen_von_detail = CustomFunction::filter_input($request->recommanded_details);
        $Sonstiges_detail = CustomFunction::filter_input($request->other_details);
        $note = CustomFunction::filter_input($request->anmerkung);
        $email = CustomFunction::filter_input($request->email);
        $password = CustomFunction::filter_input($request->password);
        $password_hash = Hash::make($password);
        $number = CustomFunction::filter_input($request->number);
        $anmerkung = CustomFunction::filter_input($request->anmerkung);

        $cname = $user_name." ".$last_name;
        $confirm_url = url('/confirm_email/' . $new_ket_encode);

        $data = array('cname' => $cname, 'email' => $email, 'confirm_url' => $confirm_url,'logo1' => $logo1,'logo2'=>$logo2);

        $new_user = new User;
        $new_user->mr_mrs = $mr_mrs;
        $new_user->user_name = $user_name;
        $new_user->last_name = $last_name;
        $new_user->broker = $broker;
        $new_user->GLV_tipsters = $GLV_tipsters;
        $new_user->Empfohlen_von_detail = $Empfohlen_von_detail;
        $new_user->Sonstiges_detail = $Sonstiges_detail;
        $new_user->note = $note;
        $new_user->email = $email;
        $new_user->password = $password_hash;
        $new_user->phone = $number;
        $new_user->status = 1;
        $new_user->urole = 2;
        $new_user->admin_confirm = 0;
        $new_user->email_key = $random_no;
        $new_user->anmerkung = $anmerkung;
        $new_user->created_at = date('Y-m-d H:i:s');
        $insert = $new_user->save();

		$user_detail_id = $new_user->id;

        $new_user_detail = new UserDetail;
        $new_user_detail->user_id = $user_detail_id;
        $new_user_detail->save();

        $logdata = new LogData;
        $logdata->user_id = $user_detail_id;
        $logdata->stage = 1;
        $logdata->created_at = date('Y-m-d H:i:s');
        $logdata->updated_at = date('Y-m-d H:i:s');
        $logdata->save();

        // send email

        try {
            Mail::send('frontview.email_template', $data, function ($message) use ($email,$cname) {
                $message->to($email)->subject('Welcome to RockIt');
            });
            return Redirect::back()->with('code', 1);
        } catch (Exception $exc) {
            return Redirect::back()->with('code', 2);
        }
    }

    public function verify_email(Request $request) {
        $rules = array(
            'id' => 'required',
        );
        $attributes = [
            'id' => $request->id
        ];

        $validator = Validator::make($attributes, $rules);

        if ($validator->fails()) {
            return redirect('/');
        }

        $id = $request->id;

        if ($id == "" || $id == null) {
            return redirect('/')->with('code', 2);
        }

        $decode_id = base64_decode($id);
        $decode_id_ex = explode('#', $decode_id);
        $email_key = $decode_id_ex[0];



        $is_found_email = User::where('email_key', $email_key)->get()->toArray();

        if (empty($is_found_email)) {

            return redirect('/')->with('code', 2);

        } else {

            $email_status = $is_found_email[0]['email_confirm'];

            if ($email_status == 1) {
                return redirect('/')->with('code', 2);
            }

            $details = User::where('email_key', $email_key)->first();
            $details->email_confirm = 1;
            $details->email_key = null;
            $details->updated_at = date('Y-m-d H:i:s');

            if ($details->save()) {

                $logdata = new LogData;
                $logdata->user_id = $details->id;
                $logdata->stage = 2;
                $logdata->created_at = date('Y-m-d H:i:s');
                $logdata->updated_at = date('Y-m-d H:i:s');
                $logdata->save();

                return redirect('/')->with('code', 2);
            } else {
                return redirect('/');
            }
        }
    }



    public function emailValidation(Request $request){

        $get_email = '';

        $email_get = $request->email;
        $emailData = User::where('email', '=', $email_get)->first();

        if(isset($emailData) && !empty($emailData)){

            echo 'false';

        }else{

            echo 'true';
        }
    }

    public function totalValidation(Request $request){

        $data_post = $request->all();

        $no1 = $request->conform_number;
        $no2 = $request->number1;
        $no_total = $no1 + $no2;

        $total = $request->total;

        if($total == $no_total){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    public function secondtotalValidation(Request $request){

        $data_post = $request->all();
        $no1 = $request->confirm_no;
        $no2 = $request->number1;
        $no_total = $no1 + $no2;

        $total = $request->total;

        if($total == $no_total){
            echo 'true';
        }else{
            echo 'false';
        }
    }




    public function doRegister(Request $request) {

        $data_post = $request->all();

        $user_id = $data_post['user_id'];

        $frau1 = null;
        if (isset($data_post['frau1']) && !empty($data_post['frau1'])) {
            $frau1 = $data_post['frau1'];
        }


        $ar_check_all_field = array();

        $ar_field = array();
        array_push($ar_field, 'frau');
        array_push($ar_field, 'nachname');
        array_push($ar_field, 'vorname');
        array_push($ar_field, 'unternehmen');
        array_push($ar_field, 'plzort');
        array_push($ar_field, 'ihkregister');
        array_push($ar_field, 'telefon');
        /*array_push($ar_field, 'email1');*/
        array_push($ar_field, 'email2');
        // array_push($ar_field, 'iban');
        array_push($ar_field, 'kontoinhaber');


        foreach($ar_field as $key => $value) {

            if (isset($data_post[$value]) && !empty($data_post[$value])) {
                array_push($ar_check_all_field, 1);
            }else {
                array_push($ar_check_all_field, 0);
            }
        }



        $status = 0;

        if(isset($ar_check_all_field) && !empty($ar_check_all_field)) {

            $ar_check_all_field = array_unique($ar_check_all_field);
                        $status = 1;
        }


        $today = date('Y-m-d H:i:s');

        $geburtsdatum = CustomFunction::filter_input($data_post['geburtsdatum']);
        $dob_date = null;
        if (isset($geburtsdatum) && !empty($geburtsdatum)) {
            $dob_date = $geburtsdatum;
            $dob_date = str_replace('/', '-', $dob_date);
            $dob_date = date("Y-m-d", strtotime($dob_date));
        }

        $update_ar =array();
        $update_ar_sub =array();

        $update_ar['mr_mrs'] = $data_post['frau'];
        $update_ar['user_name'] = $data_post['nachname'];
        $update_ar['last_name'] = $data_post['vorname'];
        $update_ar['email'] = $data_post['email1'];
        $update_ar['phone'] = $data_post['telefon'];

        $update_ar_sub['unternehmen'] = $data_post['unternehmen'];
        $update_ar_sub['strabe'] = $data_post['strabe'];
        $update_ar_sub['plzort'] = $data_post['plzort'];
        $update_ar_sub['geburtsdatum'] = $dob_date;
        $update_ar_sub['ihkregister'] = $data_post['ihkregister'];

        if(isset($data_post['beginndes']) && !empty($data_post['beginndes'])){
            $update_ar_sub['beginndes'] = $data_post['beginndes'];
        }

        $update_ar_sub['email2'] = $data_post['email2'];
        $update_ar_sub['iban'] = $data_post['iban'];
        $update_ar_sub['bankdetail'] = $data_post['bankdetail'];
        $update_ar_sub['kontoinhaber'] = $data_post['kontoinhaber'];
        $update_ar_sub['weitere'] = $data_post['weitere'];
        $update_ar_sub['sonsge'] = $data_post['sonsge'];
        $update_ar_sub['user_id'] = $data_post['user_id'];
        $update_ar_sub['frau1'] = $frau1;
        $update_ar_sub['created_at'] = $today;
        $update_ar_sub['check_status'] = $status;

        User::where('id','=',$user_id)->update($update_ar);
        UserDetail::updateOrCreate(['user_id' => $user_id], $update_ar_sub);

        $logdata = new LogData;
        $logdata->user_id = $user_id;
        $logdata->stage = 3;
        $logdata->created_at = date('Y-m-d H:i:s');
        $logdata->updated_at = date('Y-m-d H:i:s');
        $logdata->save();

        $user_data = UserDetail::where('user_id','=',$user_id)->where('distribution_status','=','1')->where('confidentiality_status','=','1')->where('avv_contract_status','=','1')->where('check_status','=','1')->where('step_5_check','=','1')->first();


        if(isset($user_data) && !empty($user_data)){
            $user_id = $user_data->user_id;
            $user_data = User::where('id','=',$user_id)->first();
            $userName = $user_data->user_name.' '.$user_data->last_name;
            $masterAdmin = User::where('master_admin','=','1')->first();
            $email = $masterAdmin->email;
            self::adminMailSend($userName,$email);
        }


        return redirect('/deine');
    }

    public function GenerateNewPassword(Request $request)
    {
        $html = "";
        $data_post = $request->all();

        if(isset($data_post['email']) && !empty($data_post['email']))
        {
            $email = CustomFunction::filter_input($request->email);

            $check_user_exists = User::where('email', $email)->where('urole', 2)->get()->toArray();
            if (empty($check_user_exists)) {

                $html = "email_not_found";

            }else
            {
                $user_id = $check_user_exists[0]['id'];
                $uname = $check_user_exists[0]['user_name'] . ' ' . $check_user_exists[0]['user_name'];

                $get_ss_data = SiteSetting::all()->toArray();

                $phno1 = $get_ss_data[0]['contact_no'];
                $dbemail = $get_ss_data[0]['site_email'];
                $site_name = $get_ss_data[0]['site_name'];

                $random_no = CustomFunction::random_string(10);
                $new_password = Hash::make($random_no);

                $login_url = url('/forget').'/'.$random_no;

                $data = array('fullname' => $uname, 'email' => $email, 'new_password' => $random_no, 'login_url' => $login_url,
                     'site_name' => $site_name);

                try {

                    $mail_res = Mail::send('frontview.forget_user_email', $data, function ($message) use ($email, $site_name) {
                        $message->to($email, $site_name)->subject('Password reset successfully');
                    });

                    $update_user = User::where('email', $email)->first();
                    $update_user->remember_token = $random_no;

                    if ($update_user->save()) {
                        $logdata = new LogData;
                        $logdata->user_id = $user_id;
                        $logdata->stage = 5;
                        $logdata->created_at = date('Y-m-d H:i:s');
                        $logdata->updated_at = date('Y-m-d H:i:s');
                        $logdata->save();

                        $html = "success";

                    } else {

                        $html = "error";
                    }

                } catch (Exception $exc) {
                    $html = "error";
                }
            }

        }else{
            $html = "email_not_found";
        }
        echo $html;

    }

    public function resetPasswordPage($id)
    {
        $id = $id;
        return view('frontview.forget_user_reset',compact('id'));
    }

    public function resetPassword(Request $request)
    {
            $data = $request->all();

            $new_password = Hash::make($data['new_password']);

            $update_user = User::where('remember_token', $data['user_id'])->first();
            if(isset($update_user) && !empty($update_user)){

                $update_user->password = $new_password;
                $update_user->password_mdate = date('Y-m-d H:i:s');
                $update_user->remember_token = null;

                if ($update_user->save()) {

                    $logdata = new LogData;
                    $logdata->user_id = $update_user->id;
                    $logdata->stage = 6;
                    $logdata->created_at = date('Y-m-d H:i:s');
                    $logdata->updated_at = date('Y-m-d H:i:s');
                    $logdata->save();

                    return redirect('/')->with('code', 5);
                } else {
                    return redirect('/')->with('code', 6);
                }

            }else{
                return redirect('/')->with('code', 6);
            }
    }


    public function downloadDistribution($id=null)
    {
        if(isset($id) && !empty($id)){
            $user_id = $id;

            $result = Deine::find($id);
            $file_name = $result->pdf;
            $file_path = "uploads";

            $file_full_path = $file_path.'/'.$file_name;

            $headers = array(
                'Content-Type' => 'application/pdf',
            );

            return response()->download($file_full_path,$file_name,$headers);

        }else{
            return redirect('/');
        }

    }


    public function distributionStore(Request $request)
    {
        request()->validate([
            'distribution'  => 'mimes:pdf',
        ]);

        if ($files = $request->file('distribution')) {

            $value = Auth::user();
            $id = $value->id;
            $today = date('Y-m-d H:i:s');

            $image = $request->file('distribution');
            $name = $request->file('distribution')->getClientOriginalName();
            $destinationPath = 'uploads/'.$id;

            File::makeDirectory($destinationPath, $mode = 0777, true, true);

            $image->move($destinationPath, $name);


            $update_ar =array();

            $update_ar['distribution'] = $name;
            $update_ar['distribution_status'] = 1;
            $update_ar['updated_at'] = $today;

            $insert = UserDetail::updateOrCreate(['user_id' => $id], $update_ar);

            $user_data = UserDetail::where('user_id','=',$id)->where('distribution_status','=','1')->where('confidentiality_status','=','1')->where('avv_contract_status','=','1')->where('check_status','=','1')->where('step_5_check','=','1')->first();


            if(isset($user_data) && !empty($user_data)){
                $user_id = $user_data->user_id;
                $user_data = User::where('id','=',$user_id)->first();
                $userName = $user_data->user_name.' '.$user_data->last_name;
                $masterAdmin = User::where('master_admin','=','1')->first();
                $email = $masterAdmin->email;
                self::adminMailSend($userName,$email);
            }


            return Response()->json([
                "success" => true,
            ]);

        }

        return Response()->json([
            "success" => false
        ]);

    }

    public function confidentialityStore(Request $request)
    {
        request()->validate([
            'confidentiality'  => 'mimes:pdf',
        ]);
        if ($files = $request->file('confidentiality')) {

            $value = Auth::user();
            $id = $value->id;
            $today = date('Y-m-d H:i:s');

            $image = $request->file('confidentiality');
            $name = $request->file('confidentiality')->getClientOriginalName();
            $destinationPath = 'uploads/'.$id;

            File::makeDirectory($destinationPath, $mode = 0777, true, true);

            $image->move($destinationPath, $name);


            $update_ar =array();

            $update_ar['confidentiality'] = $name;
            $update_ar['confidentiality_status'] = 1;
            $update_ar['updated_at'] = $today;

            $insert = UserDetail::updateOrCreate(['user_id' => $id], $update_ar);

            $user_data = UserDetail::where('user_id','=',$id)->where('distribution_status','=','1')->where('confidentiality_status','=','1')->where('avv_contract_status','=','1')->where('check_status','=','1')->where('step_5_check','=','1')->first();


            if(isset($user_data) && !empty($user_data)){
                $user_id = $user_data->user_id;
                $user_data = User::where('id','=',$user_id)->first();
                $userName = $user_data->user_name.' '.$user_data->last_name;
                $masterAdmin = User::where('master_admin','=','1')->first();
                $email = $masterAdmin->email;
                self::adminMailSend($userName,$email);
            }

            return Response()->json([
                "success" => true,
            ]);

        }

        return Response()->json([
            "success" => false
        ]);

    }

    public function avvContractStore(Request $request)
    {
        request()->validate([
            'avv_contract'  => 'mimes:pdf',
        ]);
        if ($files = $request->file('avv_contract')) {

            $value = Auth::user();
            $id = $value->id;
            $today = date('Y-m-d H:i:s');

            $image = $request->file('avv_contract');
            $name = $request->file('avv_contract')->getClientOriginalName();
            $destinationPath = 'uploads/'.$id;

            File::makeDirectory($destinationPath, $mode = 0777, true, true);

            $image->move($destinationPath, $name);


            $update_ar =array();

            $update_ar['avv_contract'] = $name;
            $update_ar['avv_contract_status'] = 1;
            $update_ar['updated_at'] = $today;

            $insert = UserDetail::updateOrCreate(['user_id' => $id], $update_ar);

            $user_data = UserDetail::where('user_id','=',$id)->where('distribution_status','=','1')->where('confidentiality_status','=','1')->where('avv_contract_status','=','1')->where('check_status','=','1')->where('step_5_check','=','1')->first();


            if(isset($user_data) && !empty($user_data)){
                $user_id = $user_data->user_id;
                $user_data = User::where('id','=',$user_id)->first();
                $userName = $user_data->user_name.' '.$user_data->last_name;
                $masterAdmin = User::where('master_admin','=','1')->first();
                $email = $masterAdmin->email;
                self::adminMailSend($userName,$email);
            }
            return Response()->json([
                "success" => true,
            ]);

        }

        return Response()->json([
            "success" => false
        ]);

    }


    public function actionConfim(Request $request)
    {
        $post = $request->all();
        if(isset($post['id']) && !empty($post['id'])){

            $id = $post['id'];

            DB::table('user_detail')->where('user_id','=', $id)->update(["step_5_check"=>1]);


            $user_data = UserDetail::where('user_id','=',$id)->where('distribution_status','=','1')->where('confidentiality_status','=','1')->where('avv_contract_status','=','1')->where('check_status','=','1')->where('step_5_check','=','1')->first();


            if(isset($user_data) && !empty($user_data)){
                $user_id = $user_data->user_id;
                $user_data = User::where('id','=',$user_id)->first();
                $userName = $user_data->user_name.' '.$user_data->last_name;
                $masterAdmin = User::where('master_admin','=','1')->first();
                $email = $masterAdmin->email;
                self::adminMailSend($userName,$email);
            }

            echo '0';

        }else{
            echo '1';
        }
    }



    public function generateUniqueCode()
    {
        $code = random_int(100000, 999999);
        return $code;
    }

    public function generateUniqueString()
    {
        $token = Str::random(30);
        $code = 'EN'. $token . substr(strftime("%Y", time()),2);

        return $code;
    }

    public function sendMessage(Request $request){

        $auth = Auth::user();
        $id = $auth->id;

        $today = date('Y-m-d H:i:s');

        $number = $request->number;

        $code = $this->generateUniqueCode();

        $popup_id = $request->popup_id;

        $update_ar =array();


        $update_ar['userid'] = $id;
        $check_url = $this->generateUniqueString();

        $update_ar['code'] = $code;
        $update_ar['phone_code'] = null;
        $update_ar['time'] = 0;
        $update_ar['used'] = 0;
        $update_ar['popup_id'] = $popup_id;
        $update_ar['phone_number'] = $number;
        $update_ar['check_url'] = $check_url;


        $number_check = UserEmpfehlungCode::where('phone_number','=',$number)->where('userid','=',$id)->where('popup_id','=',$popup_id)->first();
        $url =  route('anmelding');

        if(isset($number_check) && !empty($number_check)){
            $insert = $number_check->c_id;
            $update_ar['updated_at'] = $today;
            UserEmpfehlungCode::where('c_id','=',$insert)->update($update_ar);
        }else{
            $update_ar['created_at'] = $today;
            $insert = DB::table('user_empfehlung_code')->insertGetId($update_ar);
        }

        $setUsername = env('CLICKSEND_USERNAME'); //h.rocks@glv24.com
        $setPassword = env('CLICKSEND_PASSWORD'); //EA58AF96-2C3B-E94C-450A-1CEA8CDD3AD3

        $config = \ClickSend\Configuration::getDefaultConfiguration()->setUsername($setUsername)->setPassword($setPassword);

        $apiInstance = new \ClickSend\Api\SMSApi(new \GuzzleHttp\Client(),$config);
        $msg = new \ClickSend\Model\SmsMessage();
        $msg->setBody("Sie haben eine Empfehlung von einem GLV-Tippgeber erhalten. \n Der Code lautet: ".$code." \n Url: ". $url);
        $msg->setTo($number);
        $msg->setSource("GLV Tippgeber");

        $sms_messages = new \ClickSend\Model\SmsMessageCollection();
        $sms_messages->setMessages([$msg]);



        try {
            $result = $apiInstance->smsSendPost($sms_messages);

            $userdata = array(
                'popup_id' => $popup_id,
                'u_id' => $id,
                'i_id' => $insert
            );

            return Redirect::route('anmelding');

        } catch (Exception $e) {

            return redirect('/');

        }

    }

    public function anmelding(Request $request)
    {

        return view('frontview.anmelding');
    }

    public function openIframe($id,$uid=null)
    {

        if(isset($id) && !empty($id)){

            $result = HomePortal::where('id','=',$id)->first();

            if(isset($result) && !empty($result)){
                if(isset($uid) && !empty($uid)){
                    $user_data_data = User::select('user_name')->where('id','=',$uid)->first();
                    if(isset($user_data_data) && !empty($user_data_data)){
                        $user_data = array();
                        $user_data['user_name'] = $user_data_data->user_name;
                        if(isset($user_data) && !empty($user_data)){
                            return view('frontview.open_iframe')->with('result',$result)->with('user_data',$user_data);
                        }else{
                            return redirect('/');
                        }
                    }else{
                        return redirect('/');
                    }
                }else{

                    $auth = Auth::user();

                    if(isset($auth) && !empty($auth)){
                        $user_data = array();
                        $user_data['user_name'] = $auth->user_name;

                        return view('frontview.open_iframe')->with('result',$result)->with('user_data',$user_data);

                    }else{
                        return redirect('/');
                    }
                }
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }

    public function checkSMS(Request $request)
    {
        $data = $request->all();

        $today = date('Y-m-d H:i:s');

        $code = $data['code'];

        $data_layouts_ar = array();

        $find_user_data = UserEmpfehlungCode::where('code','=',$code)->first();

        if (isset($find_user_data) && !empty($find_user_data)){

            $user_data = User::select('user_name')->where('id','=',$find_user_data->userid)->first();
            $time = $find_user_data->time;

            $used = $find_user_data->used;

            $update_ar =array();

            $update_ar['time'] = $time;
            $insert_id = $find_user_data->c_id;
            $update_ar['used'] = $used;
            $update_ar['check_verify'] = 1;
            $update_ar['updated_at'] = $today;

            UserEmpfehlungCode::where('c_id','=',$insert_id)->update($update_ar);

            $check_popup = HomePortal::where('id','=',$find_user_data->popup_id)->first();
            if($check_popup->check_internal_frame == 0){
                $open_url = $check_popup->g_btn_url;
                $data_layouts_ar['target'] = '1';
            }else{
                $base_url = url('/open-iframe/');
                $open_url = $base_url.'/'.$find_user_data->popup_id.'/'.$find_user_data->userid;
            }

            $data_layouts_ar['ok'] = 'true';
            $data_layouts_ar['message'] = 'Code Valid';
            $data_layouts_ar['url'] = $open_url;
            $data_layouts_ar['code'] = $code;

        }else{
            $data_layouts_ar['ok'] = 'false';
            $data_layouts_ar['message'] = 'Code invalid';
            $data_layouts_ar['url'] = 'javascript:void(0)';
        }

        return $data_layouts_ar;
    }

    public function soeinfach()
    {
        $data = array();
        $data['content_data'] = array();
        $result = DB::table('site_data')->where('page_name','=','soeinfach')->get();
        if(!empty($result))
        {
            foreach($result as $key => $value){
                $data['content_data'][$value->action] = $value->description;
            }
        }
        return view('frontview.soeinfach', $data);
    }

    public function faq()
    {
        $data = array();
        $data['faq_data'] = array();
        $result = Faq::where('status','=',1)->get();
        if(!empty($result) && $result->isNotEmpty())
        {
            $data['faq_data'] = $result;
        }
        return view('frontview.faq', $data);
    }

    public function contact()
    {
        $data = array();
        return view('frontview.contact', $data);
    }

    public function sendMessageAddData(Request $request)
    {
        $mr_mrs = $request->frau;
        $user_name = $request->vorname;
        $last_name = $request->nachname;
        $dob = $request->geburtsdatum;


        $update_ar = array();

        $update_ar['user_name'] = $user_name;
        $update_ar['last_name'] = $last_name;
        $update_ar['mr_mrs'] = $mr_mrs;
        $update_ar['dob'] = $dob;

        $get_data = UserEmpfehlungCode::where('code',$request->code)->first();
        if(isset($get_data) && !empty($get_data))
        {
            DB::table('user_empfehlung_code')->where('c_id',$get_data->c_id)->update($update_ar);
        }

        if(isset($request->url) && !empty($request->url))
        {
            return Redirect::to($request->url);
        }else{
            return redirect()->back();
        }
    }

    public function secondAddData(Request $request)
    {
        $today = date('Y-m-d H:i:s');
        $mr_mrs = $request->frau;
        $user_name = $request->vorname;
        $last_name = $request->nachname;
        $user_id = $request->user_id;
        $popup_id = $request->popup_id;

        $update_ar = array();
        $update_ar['user_name'] = $user_name;
        $update_ar['last_name'] = $last_name;
        $update_ar['mr_mrs'] = $mr_mrs;
        $update_ar['userid'] = $user_id;
        $update_ar['popup_id'] = $popup_id;
        $update_ar['time'] = 0;
        $update_ar['used'] = 0;
        $update_ar['created_at'] = $today;
        $update_ar['updated_at'] = $today;



        $check_popup = HomePortal::where('id','=',$request->popup_id)->first();
            if($check_popup->check_internal_frame == 0){
                $open_url = $check_popup->g_btn_url;
            }else{
                $base_url = url('open-iframe');
                $open_url = $base_url.'/'.$request->popup_id;
            }

        UserEmpfehlungCode::create($update_ar);

        return Redirect::to($open_url);

    }

    public function adminMailSend($userName,$email){

        $logo1 = asset('/assets/frontend/images/email_logo_1.png');
        $logo2 = asset('/assets/frontend/images/email_logo_2.png');

        $data = array('email' => $email,'logo1' => $logo1,'logo2'=>$logo2,'userName'=>$userName);

        try {
            Mail::send('frontview.email_template_confirm_all_step', $data, function ($message) use ($email) {
                $message->to($email)->subject('New User Registered RockIt');
            });
        } catch (Exception $exc) {

        }

    }


    public function Impressum(Request $request)
    {
        $pageData = Site_data::where('page_name','page_data')->where('action','impressum')->first();
        return view('frontview.impressum')->with('pageData', $pageData);
    }

    public function Datenschutz(Request $request)
    {
        $pageData = Site_data::where('page_name','page_data')->where('action','datenschutz')->first();
        return view('frontview.datenschutz')->with('pageData', $pageData);
    }

    public function Erstinformation(Request $request)
    {
        $pageData = Site_data::where('page_name','page_data')->where('action','erstinformation')->first();
        return view('frontview.erstinformation')->with('pageData', $pageData);
    }

    public static function getFooter(){
       $footer = Footer::where('slug','front-footer')->first();
       return $footer;
   }

}
