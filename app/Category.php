<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    public function subcategory(){

    	return $this->hasMany('App\SubCategory', 'category_id', 'id');
    }
}
