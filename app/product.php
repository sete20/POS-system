<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $guarded = [];
    public $translatedAttributes = ['name','description',];
   public function category(){
       return $this->belongTo(Category::class);
   }
   
}
