<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->only(['create']);
    
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if(Auth::check())
        // {  
        $categories = Category::get();
        return view('theme.blogs.create',compact('categories'));
        // }
            //  abort(403);
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
       $data = $request->validated();
       // image uploading
       //1. get image
       $image = $request->image;
       //2. change its current name
        $newimagename = time() . '-' . $image->getClientOriginalName();
       //3. move image to my project
       $image->storeAs('blogs' , $newimagename,'public');
       //4. save new name to database record
       $data['image'] = $newimagename;
       $data['user_id'] = Auth::user()->id;
       Blog::create($data);
       return back()->with('statusblog', 'your blog created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
         return view('theme.singleblog' , compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        if($blog->user_id == Auth::user()->id)
        {
        $categories = Category::get();
        return view('theme.blogs.edit',compact('categories' , 'blog'));
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
         if($blog->user_id == Auth::user()->id)
        {  

        $data = $request->validated();
        if($request->hasFile('image'))
        {
        Storage::delete("public/blogs/$blog->image");

        // image uploading
        //1. get image
        $image = $request->image;
        //2. change its current name
            $newimagename = time() . '-' . $image->getClientOriginalName();
        //3. move image to my project
        $image->storeAs('blogs' , $newimagename,'public');
        //4. save new name to database record
        $data['image'] = $newimagename;
        }
        $blog->update($data);
        return back()->with('statusblogedit', 'your blog updated successfully');
    }
    abort(403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
          if($blog->user_id == Auth::user()->id)
        {  
        Storage::delete("public/blogs/$blog->image");
        $blog->delete();
        return back()->with('statusblogdelete', 'your blog deleted successfully');


        }
    }
        public function myBlogs(Blog $blog)
    {
        if(Auth::check())
        {
      $blogs=Blog::where('user_id', Auth::user()->id)->paginate(10);
      return view('theme.blogs.my_blogs',compact('blogs'));
        }
        abort(403);
       
    }
    
}
