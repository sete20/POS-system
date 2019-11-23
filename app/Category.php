<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
class Category extends Model
{
        use \Dimsav\Translatable\Translatable;
    
        protected $guarded = [];
        public $translatedAttributes = ['name'];
    
        public function products()
        {
            return $this->hasMany(Product::class);
    
        }//end of products
    
    }//end of model
    
