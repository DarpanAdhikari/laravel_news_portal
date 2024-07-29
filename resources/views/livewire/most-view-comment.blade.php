<div class="sticky top-36 left-0">
    <div class="flex items-center justify-content-between bg-blue-300 p-3">
        <h2 class="content-heading">Suggested</h2>
    </div>
    @foreach ($suggestedPost as $post)     
    <div class="people-grid1" title="{{$post->title}}">
        <div class="row">
            <div class="col-md-8 col-8">
                <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}">
                    <h5 class="line-clamp-2 text-pretty leading-5">{{$post->title}}</h5>
                </a>
                <p>{{$post->user->name}}</p>
                <span class="text-sm text-gray-400 flex w-full justify-around">
                    <div>
                        {{ Str::shortNumber($post->views->count()) }} <i class="fas fa-eye"></i>
                    </div>  
                    <div>
                        {{ Str::shortNumber($post->likes->count()) }} <i class="fas fa-thumbs-up"></i>
                    </div>
                    <div>
                        {{ Str::shortNumber($post->comments->count()) }} <i class="fas fa-comments"></i>
                    </div>
                </span>
            </div>
            <div class="col-md-4 col-4 p-0 flex items-center justify-center">
                <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}"><img loading="lazy"
                        src="{{$post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img)}}"
                        class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
            </div>
        </div>
    </div>
    @endforeach
    <div class="blog flex items-center px-0 justify-center overflow-hidden">
        <div class="inline-flex max-[800px]:flex-wrap gap-2 rounded-md shadow-sm" role="group">
            <span id="LikedBtn"
                class="inline-flex gap-2 items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-s-lg hover:bg-gray-900 hover:font-bold  cursor-pointer">
                <i class="fa-solid fa-thumbs-up"></i>
                Liked
            </span>
            <span id="commentedBtn"
                class="inline-flex gap-2 items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border border-gray-900 rounded-e-lg hover:bg-gray-900 hover:font-bold cursor-pointer">
                <i class="fas fa-comments"></i>
                Commented
            </span>
        </div>
    </div>
    {{-- most commented and liked section --}}
    <div id="most-liked">
        @foreach($mostLikedPosts as $post)
        <div class="people-grid1" title="{{$post->title}}">
            <div class="row">
                <div class="col-md-8 col-8">
                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}">
                        <h5 class="line-clamp-2 text-pretty leading-5">{{$post->title}}</h5>
                    </a>
                    <p>{{$post->user->name}}</p>
                    <span class="text-sm text-gray-400">{{ Str::shortNumber($post->likes_count) }} <i class="fas fa-thumbs-up"></i></span> 
                </div>
                <div class="col-md-4 col-4 p-0 flex items-center justify-center">
                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}"><img loading="lazy"
                            src="{{$post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img)}}"
                            class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div id="most-commented" class="hidden" >
        @foreach($mostCommentedPosts as $post)
        <div class="people-grid1" title="{{$post->title}}">
            <div class="row">
                <div class="col-md-8 col-8">
                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}">
                        <h5 class="line-clamp-2 text-pretty leading-5">{{$post->title}}</h5>
                    </a>
                    <p>{{$post->user->name}}</p>
                    <span class="text-sm text-gray-400"> {{ Str::shortNumber($post->comments_count) }} <i class="fas fa-comments"></i></span> 
                </div>
                <div class="col-md-4 col-4 p-0 flex items-center justify-center">
                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}"><img loading="lazy"
                            src="{{$post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img)}}"
                            class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>