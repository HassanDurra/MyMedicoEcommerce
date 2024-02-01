<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable  = ['id','name','category_id' , 'deleted_at'];
    public function category(){
        return $this->hasOne(Category::class , 'id' ,'category_id' );
    }
}
