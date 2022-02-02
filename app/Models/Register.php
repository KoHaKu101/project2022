<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table ='SCH_USER';

    protected $fillable = [
         'UNID',
         'USERNAME',
         'EMAIL',
         'EMAIL_VERIFIED_AT',
         'PASSWORD',
         'STATUS',
         'ROLE',
         'CREATE_BY',
         'CREATE_TIME',
         'MODIFY_BY',
         'MODIFY_TIME',
    ];
        protected $hidden = [
        'PASSWORD',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
