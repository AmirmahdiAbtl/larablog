<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    protected $fillable = ['name','slug','category_id'];
    use HasFactory;
    public function parentCategory(){
        return $this->belongsTo(Category::class ,'category_id','id');
    }
    public function children(){
        return $this->hasMany(Category::class,'category_id','id');
    }
    public function parentCategoryName(){
        return is_null($this->parentCategory)?'ندارد':$this->parentCategory->name;
    }
    public function post(){
        return $this->belongsToMany(Post::class,'category_post');
    }
}
