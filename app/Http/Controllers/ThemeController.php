<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(4);
        return view('theme.index' , compact('blogs'));
    }
    public function category($id)
    {
        
        $categoryname=Category::find($id)->name;
        $blogs= Blog::where('category_id', $id)->paginate(8);

       return view('theme.category', compact('blogs','categoryname'));
    }
    public function contact()
    {
        return view('theme.contact');
    }
  
    public function login()
    {
        return view('theme.login');
    }
       public function register()
    {
        return view('theme.register');
    }
}
