<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'IMG';

    protected $fillable = [
        'UNID',
        'UNID_SETTING_NUMBER',
        'IMG_NUMBER',
        'IMG_FILE',
        'IMG_EXT',
        'IMG_TYPE',
        'STATUS',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];
}
