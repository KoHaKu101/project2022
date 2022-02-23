<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;
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
    public function save_logo($image,$FILE_NAME,$POST_LOGO_EXT){
        $filePath   = public_path('assets/image/post/logo/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath,0777,true);
        }
        $fix_w      =  267 ;
        $fix_h      =  356 ;
        $img        = Image::make($image->path());
        $img->resize($fix_w, $fix_h)->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);
        $img->save($filePath.'/'.$FILE_NAME.$POST_LOGO_EXT);

    }
    public function save_file($PDF_FILE,$FILE_NAME,$POST_FILE_EXT){
        $filePath   = public_path('assets/pdf/post/');
        if(!file_exists($filePath)){
            File::makeDirectory($filePath,0777,true);
        }
            $PDF_FILE->move($filePath, $FILE_NAME.$POST_FILE_EXT);
    }

    public function insert_pdf(Request $request){
        $POST_TYPE = $request->POST_TYPE_PDF;
        $POST_HEADER = $request->POST_HEADER;
        $POST_BODY = $request->POST_BODY;
        $POST_TAG = $request->POST_TAG ;
        // Save Logo post
        $POST_LOGO = $request->file('POST_LOGO');
        $POST_LOGO_NAME = $this->randUNID('POST_IMG');
        $POST_LOGO_EXT = '.'.$POST_LOGO->extension();
        $this->save_logo($POST_LOGO,$POST_LOGO_NAME,$POST_LOGO_EXT);
        // Save File PDF
        $POST_FILE = $request->file('POST_FILE');
        $POST_FILE_NAME = date('ymdhis', time());
        $POST_FILE_EXT = '.'.$POST_FILE->extension();
        $this->save_file($POST_FILE,$POST_FILE_NAME,$POST_FILE_EXT);
        //Save Database
        Post::insert([
            'UNID' => $this->randUNID('POST'),
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
        //Save Tag
        // if($POST_TAG != ''){
        //     dd($POST_TAG);
        // }
        alert()->success('บันทึกสำเร็จ')->autoClose($milliseconds = 1000);
        return redirect()->back();
    }
     public function insert_default(Request $request){
         dd($request);
         $POST_TYPE = $request->POST_TYPE_PDF;
        $POST_HEADER = $request->POST_HEADER;
        $POST_BODY = $request->POST_BODY;
        $POST_TAG = $request->POST_TAG ;
     }
}