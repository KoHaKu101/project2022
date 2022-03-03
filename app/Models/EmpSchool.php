<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpSchool extends Model
{
    use HasFactory;
    const CREATED_AT = 'CREATE_TIME';
    const UPDATED_AT = 'MODIFY_TIME';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = "UNID";
    protected $keyType = 'BigInteger';
    public $table = 'EMP_SCHOOL';

    protected $fillable = [
        'UNID',
        'EMP_PREFIX',
        'EMP_FIRST_NAME_TH',
        'EMP_MIDDLE_NAME_TH',
        'EMP_LAST_NAME_TH',

        'EMP_FIRST_NAME_EN',
        'EMP_MIDDLE_NAME_EN',
        'EMP_LAST_NAME_EN',
        'EMP_IMG',
        'EMP_IMG_EXT',

        'EMP_AGE',
        'EMP_SEX',
        'EMP_NATION',
        'EMP_RANK',
        'EMP_RANK_REF',
        'EMP_STATUS',

        'EMP_IN_DAY',
        'EMP_IN_MONTH',
        'EMP_IN_YEAR',
        'EMP_OUT_DAY',
        'EMP_OUT_MONTH',
        'EMP_OUT_YEAR',

        'CREATE_BY',
        'CREATE_TIME',
        'MODIFY_BY',
        'MODIFY_TIME',
    ];
}