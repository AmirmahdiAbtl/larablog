<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\User;
class comment extends Model
{
    protected $with = ['comments'];
    protected $fillable = [
        'comment',
        'status',
        'user_id',
        'post_id',
        'comment_id',
        'status',
    ];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function post(){
        return $this->belongsTo(Post::class,'post_id','id');
    }

    public function comments(){
        return $this->hasMany(comment::class,'comment_id','id');
    }

    public function getShamsyDate(){
        return verta($this->created_at)->format("Y/m/d-h:i");
    }
}
