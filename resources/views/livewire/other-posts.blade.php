<div class="grid grid-cols-12 gap-3">
    @foreach ($posts as $post)
        <div class="max-md:col-span-12 max-lg:col-span-2 col-span-3">
            <div class="card-grid relative">
                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                    <img loading="lazy" src="{{$post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img)}}" class="object-cover rounded-md w-full" alt="{{$post->title}}">
                </a>
                <div class="img-text flex items-center">
                    <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                        @if ($post->user)
                        <img src="{{ $post->user->profile_photo_url }}" class="author-img max-h-10 w-10 object-cover rounded-full float-start me-1" alt="{{$post->user->name}}">
                        @endif
                        <h4 class="text-justify">{{ $post->title }}</h4>
                    </a>
                </div>
                <div class="sub-news-time absolute top-0 left-0">
                    <span>
                        <i class="far fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    @endforeach
</div>