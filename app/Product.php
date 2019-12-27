<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['category_id', 'product_name', 'product_img', 'benefits_of_use','usage_rates','aboutProduct','created_by'];


    public function getCategory()
    {
    	return $this->hasOne('App\Category', 'id', 'category_id');
    }

     public function getUser()
    {
    	return $this->hasOne('App\User', 'id', 'created_by');
    }

}
