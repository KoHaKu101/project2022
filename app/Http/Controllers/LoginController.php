<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function login(Request $request){
        $USERNAME = $request->USERNAME ;
        $PASSWORD = $request->PASSWORD;
        $DATA_USER = Register::where("USERNAME",'=',$USERNAME)->first();
        if($USERNAME == "" || isset($DATA_USER) == false){
            Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'ไม่พบชื่อผู้ใช้');
            return redirect()->route('homepage');
        }
        dd("s");
        if(Hash::check($PASSWORD,$DATA_USER->PASSWORD)){
               Alert::error('เข้าสู่ระบบไม่สำเร็จ', 'รหัสผ่านผิดพลาด');
            }
        Alert::success('เข้าสู่ระบบสำเร็จ', 'ยินดีต้อนรับ');
        return redirect()->route('homepage');
    }
    public function register(){

    }
    public function homepage(){
        return view("homepage.homepage");
    }
}