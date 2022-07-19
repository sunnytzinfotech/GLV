<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CustomFunction\CustomFunction;
use App\Models\User;
use App\Models\LogData;
use DB;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request) {

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'],'email_confirm' => 1))){

            $result = DB::table('users')->where('email','=', $input['email'])->first();

            $user_detail = DB::table('user_detail')->where('user_id','=', $result->id)->first();

            $logdata = LogData::where('user_id','=',$result->id)->where('stage','=',4)->first();
            $log_ar =array();

            $log_ar['user_id'] = $result->id;
            $log_ar['stage'] = 4;
            $log_ar['updated_at'] = date('Y-m-d H:i:s');

            if($logdata){
                LogData::updateOrCreate(['id' => $logdata->id], $log_ar);
            }else{
                $logdata = new LogData;
                $logdata->user_id = $result->id;
                $logdata->stage = 4;
                $logdata->created_at = date('Y-m-d H:i:s');
                $logdata->updated_at = date('Y-m-d H:i:s');
                $logdata->save();
            }

            

            if($result->admin_confirm != 0){

                $check_value = 0;
                if($user_detail->check_status == 1 && $user_detail->step_5_check == 1 && $user_detail->avv_contract_status == 1 && $user_detail->confidentiality_status == 1 && $user_detail->distribution_status == 1){
                    $check_value = 1;
                }

                if($check_value == 1){
                    /*return redirect('/')->with('code', 3);*/
                    return redirect('/');

                }elseif($user_detail->check_status == 1){
                    return redirect('/deine');
                }else{

                    return redirect('/')->with('code', 3);
                }

            }else{

                return redirect('/')->with('code', 3);
            }

        }else{
            return redirect('/')->with('code', 2)->with('error', 'Email or Password is wrong!');
        }
    }
    public function logout() {
        Auth::logout(); // log the user out of our application
        return redirect('/')->with('code', 2); // redirect the user to the login screen
    }
}
