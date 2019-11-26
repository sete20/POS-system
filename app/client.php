<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $guarded=[];
    // casts تستخدم للتحكم في كيفية عودة العمود عل هيئة ماذا 
    protected $casts =[
        'phone'=>'array',
    ];
}
