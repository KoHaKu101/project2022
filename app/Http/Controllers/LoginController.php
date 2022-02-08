<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    public function randUNID($table)
    {
        $number = date('ymdhis', time());
        $length = 7;
        do {
            for ($i = $length; $i--; $i > 0) {
                $number .= mt_rand(0, 9);
            }
        } while (
            !empty(
                DB::table($table)
                ->where('UNID', $number)
                ->first(['UNID'])
            )
        );
        return $number;
    }
     public function homepage()
    {
        return view('homepage');
    }
    public function login(Request $request)
    {
        $message = [
            'USERNAME.required' => 'กรุณากรอกชื่อผู้ใช้',
            'password.required' => 'กรุณากรอกรหัสผ่าน',
        ];
        $Validated = Validator::make(
            $request->all(),
            [
                'USERNAME' => 'required',
                'password' => 'required',
            ],
           $message
        );

        if($Validated->fails()){
            $response = $Validated->messages();

            return response()->json(['id'=>$response,'massage' => 'กรุณาตรวจสอบข้อมูลให้ครบถ้วน','alert'=>'error'],200);
        }
        $USERNAME = $request->USERNAME;
        $password = $request->password;
        $remember = $request->remember == 'on' ? true : false;
        $LOGIN_SET = ['USERNAME' => $USERNAME, 'password' => $password];
        if(!Auth::attempt($LOGIN_SET, $remember)){
            return response()->json(['massage' => 'รหัสผ่านหรือชื่อผู้ใช้ผิดพลาด','alert'=>'error'],200);
        }
        Auth::attempt($LOGIN_SET, $remember);
        $request->session()->regenerate();
        return response()->json(['massage' => 'เข้าสู่ระบบสำเร็จ','alert'=>"success"]);
    }
    public function register(Request $request)
    {

        $message = [
            'required' => 'กรุณากรอกข้อมูลให้ครบถ้วน',
            'min' => 'รหัสผ่านขั้นต่ำ 8 ตัวอักษร',
            'confirmed' => 'รหัสผ่านไม่เหมือนกัน',
            'regex' => 'รหัสผ่านต้องมี ตัวเลขและตัวอักษร',
            'same' => 'รหัสผ่านไม่เหมือนกัน',
        ];
        $Validated = Validator::make(
            $request->all(),
            [
                'NEW_FIRST_NAME' => 'required',
                'NEW_LAST_NAME' => 'required',
                'NEW_USERNAME' => 'required',
                'NEW_EMAIL' => 'required',
                'NEW_PASSWORD' => 'required|same:CONFIRM_PASSWORD|min:8|regex:/(^[a-z0-9 ]+$)+/',
                'CONFIRM_PASSWORD' => 'required|same:NEW_PASSWORD|min:8',
            ],
           $message
        );
        if($Validated->fails()){
            $response = $Validated->messages();
            $alert = 'error';
            return response()->json(['massage' => $response,'alert'=>$alert],200);
        }
        $UNID = $this->randUNID('NKD_USER');
        $PASSWORD = $request->NEW_PASSWORD;
        $USERNAME = $request->NEW_USERNAME;
        Register::insert([
            'UNID' => $UNID,
            'USERNAME' => $USERNAME,
            'EMAIL' => $request->NEW_EMAIL,
            'password' => Hash::make($PASSWORD),
            'STATUS' => 'OPEN',
            'ROLE' => 'USER',
            'FIRST_NAME' => $request->NEW_FIRST_NAME,
            'LAST_NAME' => $request->NEW_LAST_NAME,
            'CREATE_BY' => $request->NEW_USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);

        $LOGIN_SET = ['USERNAME' => $USERNAME, 'password' => $PASSWORD];
        if (Auth::attempt($LOGIN_SET)) {
            $request->session()->regenerate();
            $alert = 'success';
            return response()->json(['massage' => 'เข้าสู่ระบบสำเร็จ','alert'=>$alert]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}