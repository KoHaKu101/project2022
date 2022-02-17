<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'POST';

     protected $fillable = [
        'UNID',
        'POST_TYPE',
        'POST_TEXT',
        'POST_LINK',
        'POST_NAME',
        'POST_SCHOOL',
        'POST_DAY',
        'POST_MONTH',
        'POST_YEAR',
        'POST_STATUS',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];
}
