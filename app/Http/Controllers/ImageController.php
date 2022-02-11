<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

use App\Models\Img;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
// use Image;
class ImageController extends Controller
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
    public function img_resize($image,$filePath,$FILE_NAME,$fix_w,$fix_h,$UNID_SETTING_NUMBER,$type,$IMG_NUMBER){
        $img        = Image::make($image->path());
        $EXT        = '.'.$image->extension();
        $width      = $img->width();
        $height     = $img->height();
        if($width <= $fix_w || $height <= $fix_h){
            $img->resize($fix_w, $fix_h)->save($filePath.'/'.$FILE_NAME.$EXT);
        }
        $img->save($filePath.'/'.$FILE_NAME.$EXT);
        $DATA_IMG     = Img::where('IMG_TYPE','=',$type)->where('IMG_NUMBER','=',$IMG_NUMBER)->first();
        if(!isset($DATA_IMG)){
            $UNID = $this->randUNID('IMG');
            Img::insert([
                'UNID' => $UNID,
                'UNID_SETTING_NUMBER' => $UNID_SETTING_NUMBER,
                'IMG_NUMBER' => $IMG_NUMBER,
                'IMG_FILE' => $FILE_NAME,
                'IMG_EXT' => $EXT,
                'IMG_TYPE'=>$type,
                'STATUS' => 'OPEN',
                'CREATE_BY' => auth::user()->USERNAME,
                'CREATE_TIME' => Carbon::now(),

            ]);
        }else{
            Img::where('IMG_TYPE','=',$type)->where('IMG_NUMBER','=',$IMG_NUMBER)->update([
                'IMG_FILE' => $FILE_NAME,
                'STATUS' => 'OPEN',
                'IMG_EXT' => $EXT,
                'IMG_TYPE'=>$type,
                'MODIFY_BY' => auth::user()->USERNAME,
                'MODIFY_TIME' => Carbon::now(),
            ]);
        }
    }
}
