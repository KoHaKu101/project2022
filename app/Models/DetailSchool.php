<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSchool extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'DETAIL_SCHOOL';

     protected $fillable = [
        'UNID',
        'UNID_REF',
        'DETAIL_HEAD',
        'DETAIL_TEXT',
        'DETAIL_IMG',
        'DETAIL_IMG_EXT',
        'DETAIL_IMG_POSITION',
        'DETAIL_DAY',
        'DETAIL_MONTH',
        'DETAIL_YEAR',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',

    ];
}