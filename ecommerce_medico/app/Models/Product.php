<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable =  ['image' , 'name' , 'category_id' , 'price' , 'subcategory_id','description' , 'brand_id' ,'quantity' , 'price','in_sale' , 'is_published'];
    public function brand(){
        return $this->hasOne(Brands::class , 'id' , 'brand_id');
    }
    public function category(){
        return $this->hasOne(Category::class , 'id' , 'category_id');

    }
    public function subcategory(){
        return $this->hasOne(SubCategory::class , 'id' , 'subcategory_id');
    }

}
