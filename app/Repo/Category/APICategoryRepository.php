<?php 

namespace App\Repo\Category;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Category;

class APICategoryRepository extends BaseRepository implements CategoryInterface{

    public function __construct(){

        $this->modelName = new Category();
    }

    public function getSubFurthCategory(){

    	return Category::with('subcategory.furtherCategory')->get();
    }

  
	
}