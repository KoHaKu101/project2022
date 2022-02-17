<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSchool extends Model
{
    use HasFactory;

    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'ABOUT_SCHOOL';

    protected $fillable = [
        'UNID',
        'ABOUT_NUMBER',
        'ABOUT_NAME',
        'ABOUT_TEXT',
        'ABOUT_IMG',
        'ABOUT_IMG_EXT',
        'ABOUT_IMG_POSITION',
        'ABOUT_STATUS',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];
}
