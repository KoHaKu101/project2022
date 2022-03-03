<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpRank extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'EMP_RANK';

    protected $fillable = [
        'UNID',
        'RANK_NAME_TH',
        'RANK_NAME_ENG',
        'RANK_STATUS',
        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];


}