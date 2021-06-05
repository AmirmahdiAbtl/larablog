<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use App\Models\comment;
use App\Models\User;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'banner',
        'content',
        'user_id'
    ];
    /**
        * The category that belong to the PostController
        *
        * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
        */
        public function category(){
            return $this->belongsToMany(Category::class, 'category_post');
        }
    use HasFactory,Sluggable; 
    public function sluggable() :array {
        return [
            'slug' => [
                'source' => 'title'
            ]
            ];
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comment(){
        return $this->hasMany(comment::class);
    }
    public function getShamsyDate(){
        return verta($this->created_at)->format("Y/m/d-h:i");
    }
    public function getBannerUrl(){
        return asset('/images/banner/'.$this->banner);
    }
}
