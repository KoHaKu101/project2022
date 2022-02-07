<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function login(Request $request)
    {
        $validated = $request->validate(
            [
                'USERNAME' => 'required',
                'password' => 'required',
            ],
            [
                'USERNAME.required' => 'กรุณาใส่ข้อมูล',
                'password.required' => 'กรุณาใส่ข้อมูล',
            ],
        );
        $USERNAME = $request->USERNAME;
        $password = $request->password;
        $LOGIN_SET = ['USERNAME' => $USERNAME, 'password' => $password];
        if (!Auth::validate($LOGIN_SET)) {
            Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'ไม่พบชื่อผู้ใช้ หรือ รหัสผ่านผิดพลาด');
            return redirect()->route('homepage');
        }
        $remember = $request->remember == 'on' ? true : false;
        Auth::attempt($LOGIN_SET, $remember);
        $request->session()->regenerate();
        Alert::success('เข้าสู่ระบบสำเร็จ', 'ยินดีต้อนรับ');
        return redirect()->route('homepage');
    }
    public function register(Request $request)
    {
        $UNID = $this->randUNID('NKD_USER');
        $PASSWORD = $request->NEW_PASSWORD;
        $CONFIRM_PASSWORD = $request->CONFIRM_PASSWORD;

        if ($PASSWORD != $CONFIRM_PASSWORD) {
            Alert::error('เกิดข้อผิดพลาด', 'รหัสไม่ตรงกัน');
            return Redirect()->back();
        }

        $CURRENT_PASSWORD = $PASSWORD;
        $USERNAME = $request->NEW_USERNAME;
        Register::insert([
            'UNID' => $UNID,
            'USERNAME' => $USERNAME,
            'EMAIL' => $request->NEW_EMAIL,
            'password' => Hash::make($CURRENT_PASSWORD),
            'STATUS' => 'OPEN',
            'ROLE' => 'USER',
            'FIRST_NAME' => $request->NEW_FIRST_NAME,
            'LAST_NAME' => $request->NEW_LAST_NAME,
            'CREATE_BY' => $request->NEW_USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);

        $LOGIN_SET = ['USERNAME' => $USERNAME, 'password' => $CURRENT_PASSWORD];
        if (Auth::attempt($LOGIN_SET)) {
            $request->session()->regenerate();
            Alert::success('เข้าสู่ระบบสำเร็จ', 'ยินดีต้อนรับ');
            return redirect()->route('homepage');
        } else {
            Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'เกิดข้อผิดพลาด');
            return redirect()->route('homepage');
        }
    }
    public function homepage()
    {
        return view('homepage.homepage');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}