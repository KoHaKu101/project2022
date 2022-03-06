<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\PostImg;
use App\Models\PostTag;
use App\Models\Tag;
use Carbon\Carbon;
use Facade\Ignition\Tabs\Tab;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Document;
class PostController extends Controller
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
    private function save_logo($image,$FILE_NAME,$POST_LOGO_EXT){

        $filePath   = public_path('assets/image/post/logo/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath,0777,true);
        }
        $fix_w      =  800 ;
        $fix_h      =  600 ;
        $img        = Image::make($image->path());
        $img->resize($fix_w, $fix_h)->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);
        $img->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);

    }
    private function save_img($image,$FILE_NAME,$POST_LOGO_EXT){
        $filePath   = public_path('assets/image/post/img/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath,0777,true);
        }
        $fix_w      =  1024 ;
        $fix_h      =  768 ;
        $img        = Image::make($image->path());
        $img->resize($fix_w, $fix_h)->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);
        $img->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);

    }
    private function save_file($PDF_FILE,$FILE_NAME,$POST_FILE_EXT){
        $filePath   = public_path('assets/pdf/post/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath,0777,true);
        }
        $PDF_FILE->move($filePath, $FILE_NAME.$POST_FILE_EXT);
    }
    private function save_tag($POST_TAG,$UNID){
        foreach($POST_TAG as $index => $row){
            PostTag::insert([
            'UNID'=> $this->randUNID('POST_TAG'),
            'UNID_POST' => $UNID,
            'UNID_TAG' => $row,
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        }
    }
    public function insert_pdf(Request $request){
        $POST_TYPE = $request->POST_TYPE_PDF;
        $POST_HEADER = $request->POST_HEADER;
        $POST_BODY = $request->POST_BODY;
        $POST_TAG = $request->POST_TAG ;
        // Save Logo post
        $POST_LOGO = $request->file('POST_LOGO');
        $POST_LOGO_NAME = date('ymdhis') . uniqid() . time();
        $POST_LOGO_EXT = '.'.$POST_LOGO->extension();
        $this->save_logo($POST_LOGO,$POST_LOGO_NAME,$POST_LOGO_EXT);
        // Save File PDF
        $POST_FILE = $request->file('POST_FILE');
        $POST_FILE_NAME = $POST_HEADER;
        $POST_FILE_EXT = '.'.$POST_FILE->extension();
        $this->save_file($POST_FILE,$POST_FILE_NAME,$POST_FILE_EXT);
        //Save Database
        $UNID = $this->randUNID('POST');
        Post::insert([
            'UNID' => $UNID,
            'POST_TYPE' => $POST_TYPE,
            'POST_HEADER' => $POST_HEADER,
            'POST_BODY' => $POST_BODY,
            'POST_IMG_LOGO' =>$POST_LOGO_NAME,
            'POST_IMG_EXT'=>$POST_LOGO_EXT,
            'POST_PDF' => $POST_FILE_NAME,
            'POST_PDF_EXT' => $POST_FILE_EXT,
            'POST_DAY' => date('d'),
            'POST_MONTH' => date('n'),
            'POST_YEAR' => date('Y'),
            'POST_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        //save tag
         if(isset($POST_TAG)){
        $this->save_tag($POST_TAG,$UNID);
        }
        return response()->json(['pass'=>true]);
    }
    public function insert_default(Request $request){
        $POST_TYPE = $request->POST_TYPE_DEFAULT;
        $POST_HEADER = $request->POST_HEADER;
        $POST_BODY = $request->POST_BODY;
        $POST_TAG = $request->POST_TAG ;
        $UNID = $this->randUNID('POST');
        $POST_IMG = $request->file('POST_IMG');
        $POST_IMG_POSITION = $request->POST_IMG_POSITION;
        //save logo img
        $POST_LOGO = $request->file('POST_LOGO');
        $POST_LOGO_NAME = date('ymdhis') . uniqid() . time();
        $POST_LOGO_EXT = '.'.$POST_LOGO->extension();
        $this->save_logo($POST_LOGO,$POST_LOGO_NAME,$POST_LOGO_EXT);
        //save post
        Post::insert([
            'UNID' => $UNID,
            'POST_TYPE' => $POST_TYPE,
            'POST_HEADER' => $POST_HEADER,
            'POST_BODY' => $POST_BODY,
            'POST_IMG_LOGO' =>$POST_LOGO_NAME,
            'POST_IMG_EXT'=>$POST_LOGO_EXT,
            'POST_PDF' => '',
            'POST_PDF_EXT' => '',
            'POST_DAY' => date('d'),
            'POST_MONTH' => date('n'),
            'POST_YEAR' => date('Y'),
            'POST_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ]);
        //save img post mutiple file
        foreach($POST_IMG as $index => $row){
            $image = $row;
            $POST_IMG_NAME = date('ymdhis') . uniqid() . time();
            $POST_IMG_EXT = '.'.$image->extension();
            $this->save_img($image,$POST_IMG_NAME,$POST_IMG_EXT);
                PostImg::insert([
                'UNID'=> $this->randUNID('POST_IMG'),
                'UNID_REF'=> $UNID,
                'POST_IMG_POSITION'=>$POST_IMG_POSITION,
                'POST_IMG_NAME'=> $POST_IMG_NAME,
                'POST_IMG_EXT'=> $POST_IMG_EXT,
                'CREATE_BY' => Auth::user()->USERNAME,
                'CREATE_TIME' => Carbon::now(),
                ]);
        }
        //save tag
        if(isset($POST_TAG)){
        $this->save_tag($POST_TAG,$UNID);
        }
                return response()->json(['pass'=>true]);
        }
    public function checkform_default(Request $request){
        $pass = false;
        $POST_LOGO = $request->file('POST_LOGO') ? '' : 'กรุณาใส่รูปภาพหัวข้อ' ;
        $POST_HEADER = isset($request->POST_HEADER) ? '' : 'กรุณาใส่ส่วนหัวข้อ' ;
        $POST_BODY = isset($request->POST_BODY) ? '' : 'กรุณาใส่เนื้อหาข้อมูล' ;
        $POST_IMG = '';
        if($request->file('POST_LOGO')){
            $allowed = array('.png', '.jpg','.jpeg');
            $img = $request->file('POST_LOGO');
            $img_ext = '.'.$img->extension();
            if (!in_array($img_ext, $allowed)) {
                $POST_LOGO = 'กรุณาใส่ไฟล์ที่เป็นรูปภาพเท่านั้น';
            }
        }
        if($request->file('POST_IMG')){
            $allowed = array('.png', '.jpg','.jpeg');
            $images = $request->file('POST_IMG');
            foreach($images as $index =>$row){
            $image = $row;
            $image_ext = '.'.$image->extension();
                if (!in_array($image_ext, $allowed)) {
                    $POST_IMG = 'กรุณาใส่ไฟล์ที่เป็นรูปภาพเท่านั้น';
                }
            }

        }
        $text = array('POST_HEADER'=>$POST_HEADER,'POST_BODY'=>$POST_BODY,'POST_LOGO'=>$POST_LOGO ,'POST_IMG' => $POST_IMG);
        if($POST_HEADER == ''&&$POST_BODY == ''&&$POST_LOGO == '' && $POST_IMG == ''){
            $pass = true;
        }
        return response()->json(['pass'=>$pass,'text'=>$text]);
    }
    public function checkform_pdf(Request $request){
        $pass = false;
        $POST_HEADER = isset($request->POST_HEADER) ? '' : 'กรุณาใส่ส่วนหัวข้อ' ;
        $POST_BODY = isset($request->POST_BODY) ? '' : 'กรุณาใส่คำอธิบาย' ;
        $POST_LOGO = $request->file('POST_LOGO') ? '' : 'กรุณาใส่รูปภาพหัวข้อ' ;
        $POST_FILE = $request->file('POST_FILE') ? '' : 'กรุณาใส่ข้อมูล' ;
        if($request->file('POST_LOGO')){
            $allowed = array('.png', '.jpg','.jpeg');
            $img = $request->file('POST_LOGO');
            $img_ext = '.'.$img->extension();
            if (!in_array($img_ext, $allowed)) {
                $POST_LOGO = 'กรุณาใส่ไฟล์ที่เป็นรูปภาพเท่านั้น';
            }
        }
        $text = array('POST_HEADER'=>$POST_HEADER,'POST_BODY'=>$POST_BODY,'POST_LOGO'=>$POST_LOGO,'POST_FILE'=>$POST_FILE);
        if($POST_HEADER == ''&&$POST_BODY == ''&&$POST_LOGO == ''&&$POST_FILE == ''){
            $pass = true;
        }
        return response()->json(['pass'=>$pass,'text'=>$text]);
    }
    public function post_edit($UNID = null){
        $DATA_POST = Post::where('UNID','=',$UNID)->first();
        $DATA_IMG = PostImg::where('UNID_REF','=',$UNID)->get();
        $POST_TAG = PostTag::where('UNID_POST','=',$UNID)->get();
        $DATA_TAG = Tag::where('TAG_STATUS','=','OPEN')->get();
        return view('editpage.post.postedit',compact('DATA_POST','DATA_IMG','DATA_TAG','POST_TAG'));
    }
    public function update(Request $request){
        $UNID = $request->UNID;
        $POST_TYPE = $request->POST_TYPE;
        $POST_HEADER = $request->POST_HEADER;
        $POST_TAG = $request->POST_TAG;
        $POST_BODY = $request->POST_BODY;
        $POST_IMG_LOGO = $request->file('POST_IMG_LOGO');
        $DATA_POST = Post::where('UNID','=',$UNID)->first();
        //delete old logo
        $POST_LOGO_NAME = $DATA_POST->POST_IMG_LOGO;
        $POST_LOGO_EXT =$DATA_POST->POST_IMG_EXT;

        if(isset($POST_IMG_LOGO)){
             $this->delete_logo($POST_LOGO_NAME,$POST_LOGO_EXT);
            // insert new logo
            $POST_LOGO_NAME = date('ymdhis') . uniqid() . time();
            $POST_LOGO_EXT = '.'.$POST_IMG_LOGO->extension();
            $this->save_logo($POST_IMG_LOGO,$POST_LOGO_NAME,$POST_LOGO_EXT);
        }
        if(isset($POST_TAG)){
            PostTag::where('UNID_POST','=',$UNID)->delete();
            $this->save_tag($POST_TAG,$UNID);
        }else{
            PostTag::where('UNID_POST','=',$UNID)->delete();
        }
        //end process logo
        if($POST_TYPE == 'DEFAULT'){
            $POST_IMG = $request->file('POST_IMG');

            if(isset($POST_IMG)){
            // delete old img
            $DATA_IMG = PostImg::where('UNID_REF','=',$UNID)->get();

             foreach($DATA_IMG as $index => $row){
                $this->delete_img($row->POST_IMG_NAME,$row->POST_IMG_EXT);
             }
             PostImg::where('UNID_REF','=',$UNID)->delete();
             // inset new img
            $POST_IMG_POSITION = $request->POST_IMG_POSITION;

            foreach ($POST_IMG as $index => $image){
                $POST_IMG_NAME = date('ymdhis') . uniqid() . time();
                $POST_IMG_EXT = '.'.$image->extension();
                $this->save_img($image,$POST_IMG_NAME,$POST_IMG_EXT);
                    PostImg::insert([
                    'UNID'=> $this->randUNID('POST_IMG'),
                    'UNID_REF'=> $UNID,
                    'POST_IMG_POSITION'=>$POST_IMG_POSITION,
                    'POST_IMG_NAME'=> $POST_IMG_NAME,
                    'POST_IMG_EXT'=> $POST_IMG_EXT,
                    'CREATE_BY' => Auth::user()->USERNAME,
                    'CREATE_TIME' => Carbon::now(),
                    ]);
                }
            }
            //end process img
        $DATA_UPDATE = [
            'POST_TYPE' => $POST_TYPE,
            'POST_HEADER' => $POST_HEADER,
            'POST_BODY' => $POST_BODY,
            'POST_IMG_LOGO' =>$POST_LOGO_NAME,
            'POST_IMG_EXT'=>$POST_LOGO_EXT,
            'POST_PDF' => '',
            'POST_PDF_EXT' => '',
            'POST_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),
        ];
        }else{
            $POST_FILE = $request->file('POST_FILE_PDF');
            $POST_FILE_NAME = $DATA_POST->POST_PDF;
            $POST_FILE_EXT = $DATA_POST->POST_PDF_EXT;
            if(isset($POST_FILE)){
                $POST_FILE_NAME = $POST_HEADER;
                $POST_FILE_EXT = '.'.$POST_FILE->extension();
                $this->save_file($POST_FILE,$POST_FILE_NAME,$POST_FILE_EXT);
            }
            $DATA_IMG = PostImg::where('UNID_REF','=',$UNID)->get();
            if(count($DATA_IMG) > 0){
               foreach($DATA_IMG as $index => $row){
                 $this->delete_img($row->POST_IMG_NAME,$row->POST_IMG_EXT);
                }
                PostImg::where('UNID_REF','=',$UNID)->delete();
            }
            $DATA_UPDATE = [
            'POST_TYPE' => $POST_TYPE,
            'POST_HEADER' => $POST_HEADER,
            'POST_BODY' => $POST_BODY,
            'POST_IMG_LOGO' =>$POST_LOGO_NAME,
            'POST_IMG_EXT'=>$POST_LOGO_EXT,
            'POST_PDF' => $POST_FILE_NAME,
            'POST_PDF_EXT' => $POST_FILE_EXT,
            'POST_STATUS' => 'OPEN',
            'CREATE_BY' => Auth::user()->USERNAME,
            'CREATE_TIME' => Carbon::now(),

        ];
        }
        Post::where('UNID','=',$UNID)->update($DATA_UPDATE);
        alert()->success('แก้ไขรายการสำเร็จ')->autoClose(1500);
        return redirect()->back();

    }
    public function delete_logo($POST_LOGO_NAME,$POST_LOGO_EXT){
        $check_file = public_path('assets/image/post/logo/'.$POST_LOGO_NAME.$POST_LOGO_EXT);
        if(file_exists($check_file)){
            File::delete($check_file);
        }
    }
    public function delete_img($POST_IMG_NAME,$POST_IMG_EXT){
        $check_file = public_path('assets/image/post/img/'.$POST_IMG_NAME.$POST_IMG_EXT);
        if(file_exists($check_file)){
            File::delete($check_file);
        }
    }
    public function download_pdf(Request $request){
        $UNID = $request->UNID;
        $DATA_POST = Post::where('UNID','=',$UNID)->first();
        $filePath = public_path('assets/pdf/post/'.$DATA_POST->POST_PDF.$DATA_POST->POST_PDF_EXT);

        return response()->download($filePath);
    }
    public function delete(Request $request){
        $UNID = $request->UNID;
        $DATA_POST = Post::where('UNID','=',$UNID)->first();
        PostTag::where('UNID_POST','=',$UNID)->delete();
        $POST_LOGO_NAME = $DATA_POST->POST_IMG_LOGO;
        $POST_LOGO_EXT = $DATA_POST->POST_IMG_EXT;
        $this->delete_logo($POST_LOGO_NAME,$POST_LOGO_EXT);
        if($DATA_POST->POST_TYPE == 'DEFAULT'){
            $DATA_IMG = PostImg::where('UNID_REF','=',$UNID)->get();

             foreach($DATA_IMG as $index => $row){
                $this->delete_img($row->POST_IMG_NAME,$row->POST_IMG_EXT);
             }
             PostImg::where('UNID_REF','=',$UNID)->delete();
        }else{
            $POST_FILE_NAME = $DATA_POST->POST_PDF;
            $POST_FILE_EXT = $DATA_POST->POST_PDF_EXT;
            $filePath = public_path('assets/pdf/post/'.$POST_FILE_NAME.$POST_FILE_EXT);
            File::delete($filePath);
        }
             Post::where('UNID','=',$UNID)->delete();
        return response()->json(['status'=>'pass']);
    }
}