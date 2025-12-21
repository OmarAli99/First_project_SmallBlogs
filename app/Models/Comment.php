<?php

namespace App\Models;
use App\Models\Blog;
use Dom\Comment as DomComment;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $fillable=['name' , 'email','subject','message','blog_id'];
   public function blog()
   { 
     return $this->belongsTo(Blog::class);
   }
}
