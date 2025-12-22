@php
  $category = App\Models\Category::get();
  $recentblog = App\Models\Blog::latest()->take(3)->get();
@endphp
<div class="col-lg-4 sidebar-widgets">
              <div class="widget-wrap">
                <div class="single-sidebar-widget newsletter-widget">
                  <h4 class="single-sidebar-widget__title">Newsletter</h4>

                  @if(session('status'))
                <div class ="alert alert-success">
                  {{ session('status') }}
                </div>
                  @endif

                  <form method="POST" action="{{ route('subcriber.store') }}">
                    @csrf
                  <div class="form-group mt-30">
                    <div class="col-autos">
                      <input type="text" name ="email" class="form-control" id="inlineFormInputGroup"
                       placeholder="Enter email" value="{{ old('email') }}" onfocus="this.placeholder = ''"
                        onblur="this.placeholder = 'Enter email'">

                        @error('email')
                            <span class ="text-danger">{{ $message }}</span>                      
                        @enderror
                    </div>
                  </div>

                  <button type="submit" class="bbtns d-block mt-20 w-100">Subcribe</button>
                  </form>
                </div>
                
                @if(count($category) > 0)
                <div class="single-sidebar-widget post-category-widget">
                <h4 class="single-sidebar-widget__title">Category</h4>
                   <ul class="cat-list mt-20">
                @foreach ($category as $cat )
                    <li>
                      <a href="{{ route('theme.category' , ['id' =>$cat->id]) }}" class="d-flex justify-content-between">
                        <p>{{ $cat->name}}</p>
                        <p>({{ count($cat->blogs) }})</p>
                      </a>
                    </li>
                @endforeach
                   </ul>
                </div>
                
                @endif
                @if(count($recentblog) > 0)
                <div class="single-sidebar-widget popular-post-widget">
                  <h4 class="single-sidebar-widget__title">Recent Blogs</h4>
                    <div class="popular-post-list">
                  @foreach ( $recentblog as $blog )
                      <div class="single-post-list">
                        <div class="thumb">
                          <img class="card-img rounded-0 " src="{{asset("storage/blogs/$blog->image")}}" alt="">
                          <ul class="thumb-info">
                            <li><a href="#">{{ $blog->user->name }}</a></li>
                            <li><a href="#">{{ $blog->created_at->format('d M') }}</a></li>
                          </ul>
                        </div>
                        <div class="details mt-20">
                          <a href="{{ route('blogs.show' ,['blog' => $blog])}}">
                            <h6>{{ $blog->name }}</h6>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

              @endif
          </div>