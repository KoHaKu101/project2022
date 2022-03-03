<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailId extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'DETAIL_ID';

     protected $fillable = [
        'UNID',
        'DETAIL_TYPE',
        'DETAIL_HEAD',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',

    ];
}
