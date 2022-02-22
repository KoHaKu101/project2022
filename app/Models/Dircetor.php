<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dircetor extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'DIRCETOR';

     protected $fillable = [
        'UNID',
        'DIRCETOR_TEXT',
        'DIRCETOR_TEXT_NAME',
        'DIRCETOR_SCHOOL',
        'STATUS',
        'DIRCETOR_IMG',
        'DIRCETOR_IMG_EXT',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];






}