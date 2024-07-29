<x-app-layout>
    <div class="ads-container">
        <div class="container">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/1140-100.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
    </div>
    <hr>
    @foreach ($headline as $post)
        <div class="news-headline">
            <div class="container px-0 mt-5">
                <div class="headline-content flex flex-col items-center">
                    <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                        <h1>{{ $post->title }}</h1>
                    </a>
                    <div class="headline-details flex justify-center items-center mb-3">
                        @if ($post->user)
                            <a href="{{ $post->user->u_id }}" class="flex items-center">
                                <img loading="lazy" src="{{ $post->user->profile_photo_url }}"
                                    class="object-cover w-full rounded-full shadow-lg" alt="{{$post->user->name}}">
                                <span>{{ $post->user->name }}</span>
                            </a>
                        @endif
                        <i
                            class="far fa-clock"><span>{{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span></i>
                        <i class="far fa-comment-alt"><span>{{ Str::shortNumber($post->comments->count()) }}</span></i>
                    </div>
                    <div class="main-news-img w-full">
                        <img loading="lazy"
                            src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                            class="object-cover w-full rounded-lg" alt="{{$post->title}}">
                    </div>
                    <p class="line-clamp-3">
                        {{ $post->meta_description }}
                    </p>
                </div>
            </div>
            <hr>
        </div>
    @endforeach
    @if (isset($buletine[0]))
    <section class="container">
        <div class="grid grid-cols-12 gap-1">
            <div class="col-span-6 max-md:col-span-12">
                <div class="bulletin-news flex flex-col items-center justify-center">
                    <a href="{{$buletine[0]->slug ? url($buletine[0]->slug):url($buletine[0]->post->slug)}}"><img loading="lazy" src="{{$buletine[0]->feature_img ? asset($buletine[0]->feature_img):asset($buletine[0]->post->feature_img)}}"
                            class="object-cover rounded-md w-full" alt="{{$buletine[0]->title}}">
                        <h2>{{$buletine[0]->title}}</h2>
                    </a>
                    <div class="sub-news-time flex justify-center items-center">
                        <i class="far fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($buletine[0]->created_at)->shortAbsoluteDiffForHumans() }}
                            {{ __('time')['ago'] }}</span>
                        <i class="far fa-comment-alt"></i><span>{{ Str::shortNumber($buletine[0]->comments->count()) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-span-3 max-md:col-span-12">
                @for ($i = 1; $i < count($buletine); $i++)
                <div class="bulletin-grid max-md:mt-10 p-2 rounded-sm hover:shadow-md duration-75">
                    <div class="flex justify-center gap-5">
                            <a href="{{$buletine[$i]->slug ? url($buletine[$i]->slug):url($buletine[$i]->post->slug)}}"><img loading="lazy"
                                    src="{{$buletine[$i]->feature_img ? asset($buletine[$i]->feature_img):asset($buletine[$i]->post->feature_img)}}"
                                    class="object-cover rounded-md w-full" alt="{{$buletine[$i]->title}}"></a>
                        <div class="w-full">
                            <a href="{{$buletine[$i]->slug ? url($buletine[$i]->slug):url($buletine[$i]->post->slug)}}">
                                <h4 class="line-clamp-2">{{$buletine[$i]->title}}</h4>
                            </a>
                            <div class="sub-news-time">
                                <i class="far fa-clock"></i><span>{{ \Carbon\Carbon::parse($buletine[$i]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="col-span-3 max-md:col-span-12">
                <div class="ad-grid hide-mobile sticky top-14 right-0">
                    <a href="#"><img loading="lazy" src="{{asset('asset/img/ime-super-man_300x150.gif')}}" class="object-cover rounded-md w-full" alt="ads"></a>
                    <a href="#"><img loading="lazy" src="{{asset('asset/img/300_125-mother-daughter_new.gif')}}" class="object-cover rounded-md w-full" alt="ads"></a>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="ads-container hide-mobile-l">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/Desktop-03-05.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
    </div>
    @endif
    @if (isset($firstCat[0]))
    <section class="news">
        <div class="container">
            <div class="grid grid-cols-12 gap-3">
                <div class=" max-md:col-span-12 {{ (!isset($fifthCat[0]) && !isset($blogs[0])) ? 'col-span-12' : 'col-span-9' }}">
                    <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                        <h2 class="content-heading">{{ __('navigation')['name']['1'] }}</h2>
                        <a href="{{ __('navigation')['name']['1'] }}">
                            <p class="news-option flex justify-center items-center"><i
                                    class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="row news-headline">
                        <div class="col-md-7 news-img">
                            <div class="news-main">
                                <a href="{{ $firstCat[0]->slug ? url($firstCat[0]->slug) : url($firstCat[0]->post->slug) }}">
                                    <h2>{{$firstCat[0]->title}}</h2>
                                </a>
                            </div>
                            <a href="{{ $firstCat[0]->slug ? url($firstCat[0]->slug) : url($firstCat[0]->post->slug) }}"><img loading="lazy"
                                    src="{{$firstCat[0]->feature_img ? asset($firstCat[0]->feature_img):asset($firstCat[0]->post->feature_img)}}"
                                    class="object-cover rounded-md w-full" alt="{{$firstCat[0]->title}}"></a>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-news-time">
                                <i class="far fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($firstCat[0]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                            </div>
                            <div class="news-detail line-clamp-6">
                                <p>{!! html_entity_decode($firstCat[0]->content) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row news-grid">
                        @for ($i = 1; $i <= min(3, count($firstCat) - 1); $i++)
                            <div class="col-md-4 col-12">
                                <a href="{{ $firstCat[$i]->slug ? url($firstCat[$i]->slug) : url($firstCat[$i]->post->slug) }}"><img loading="lazy"
                                        src="{{ $firstCat[$i]->feature_img ? asset($firstCat[$i]->feature_img) : asset($firstCat[$i]->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$firstCat[$i]->title}}"></a>
                                <a href="{{ $firstCat[$i]->slug ? url($firstCat[$i]->slug) : url($firstCat[$i]->post->slug) }}">
                                    <h4>{{$firstCat[$i]->title}}</h4>
                                </a>
                                <div class="sub-news-time">
                                    <i class="far fa-clock"></i><span>{{ \Carbon\Carbon::parse($firstCat[$i]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-span-3 max-md:col-span-12">
                    @if (isset($fifthCat[0]))    
                    <div class="relative">
                        <div class="thoughts flex items-center justify-content-between sticky top-14 z-10">
                            <h2 class="content-heading">{{ __('navigation')['name'][5] }}</h2>
                            <a href="{{ __('navigation')['name'][5] }}">
                                <p class="news-option flex justify-center items-center"><i
                                        class="fas fa-circle-arrow-right"></i></p>
                            </a>
                        </div>
                        @foreach ($fifthCat as $post)
                        <div class="people-grid1">
                            <div class="row">
                                <div class="col-md-8 col-8">
                                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}">
                                        <h5>{{$post->title}}</h5>
                                    </a>
                                    @if ($post->user)
                                    <p>{{$post->user->name}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4 col-4 p-0 flex justify-center items-center">
                                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}"><img loading="lazy" src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}" class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    @if (isset($blogs[0]))
                    <div class="relative">
                        <div class="blog flex items-center justify-content-between sticky top-14 z-10">
                            <h2 class="content-heading">{{ __('categories')['blog'] }}</h2>
                            <a href="content/{{ __('categories')['blog'] }}">
                                <p class="news-option flex justify-center items-center"><i
                                        class="fas fa-circle-arrow-right"></i></p>
                            </a>
                        </div>
                        @foreach ($blogs as $post)
                        <div class="people-grid1">
                            <div class="row">
                                <div class="col-md-8 col-8">
                                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}">
                                        <h5>{{$post->title}}</h5>
                                    </a>
                                    @if ($post->user)
                                    <p>{{$post->user->name}}</p>
                                    @endif
                                </div>
                                <div class="col-md-4 col-4 p-0 flex items-center justify-center">
                                    <a href="{{$post->slug ? url($post->slug) : url($post->post->slug)}}"><img loading="lazy"
                                            src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="ads-container">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/western.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
    </div>
    <section class="bulletin">
        <div class="container">
            <div class="row flex justify-center flex-wrap">
                <div class="col-md-9">
                    <div class="grid grid-cols-12 gap-3 bulletin-news-gap">
                        @for ($i = 4; $i < count($firstCat); $i++)
                        <div class="col-span-6 max-md:col-span-12">
                            <div class="row">
                                <div class="col-md-4 col-5">
                                    <a href="{{ $firstCat[$i]->slug ? url($firstCat[$i]->slug) : url($firstCat[$i]->post->slug) }}"><img loading="lazy" src="{{ $firstCat[$i]->feature_img ? asset($firstCat[$i]->feature_img) : asset($firstCat[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$firstCat[$i]->title}}"></a>
                                </div>
                                <div class="col-md-8 col-7">
                                    <a href="{{ $firstCat[$i]->slug ? url($firstCat[$i]->slug) : url($firstCat[$i]->post->slug) }}">
                                        <h4>{{$firstCat[$i]->title}}</h4>
                                    </a>
                                    <div class="sub-news-time">
                                        <i class="far fa-clock"></i>
                                        {{ \Carbon\Carbon::parse($firstCat[$i]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="col-md-3 {{(count($firstCat)<5) ? 'hidden' : '' }}">
                    <div class="ad-grid hide-mobile sticky top-14 right-0">
                        <a href="#"><img loading="lazy"
                                src="{{ asset('asset/img/13-300-x-100_ONLINE_KHABAR_.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                        <a href="#"><img loading="lazy" src="{{ asset('asset/img/300x125.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="ads-container flex justify-center">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/ASTON_1000-100.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
    </div>
    @endif
    @if (isset($national[0]))
    <section class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                    <h2 class="content-heading">{{ __('categories')['national'] }}</h2>
                    <a href="content/{{ __('categories')['national'] }}">
                        <p id="last" class="news-option flex justify-center items-center"><i
                                class="fas fa-circle-arrow-right"></i></p>
                    </a>
                </div>
                <div class="row">

                    <div class="col-md-6 @if(count($national)<2) col-md-12 @endif">
                        <a href="{{ $national[0]->slug ? url($national[0]->slug) : url($national[0]->post->slug) }}"><img loading="lazy"
                                src="{{ $national[0]->feature_img ? asset($national[0]->feature_img) : asset($national[0]->post->feature_img) }}" width="100%"
                                class="object-cover rounded-md w-full" alt="{{$national[0]->title}}"></a>
                        <div class="country-main-grid">
                            <a href="{{ $national[0]->slug ? url($national[0]->slug) : url($national[0]->post->slug) }}">
                                <h2>{{$national[0]->title}}</h2>
                            </a>
                            <div class="sub-news-time">
                                <i class="far fa-calendar-alt"></i><span>{{ \Carbon\Carbon::parse($national[0]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                            </div>
                            <div class="news-detail bulletin line-clamp-3">{!! html_entity_decode($national[0]->content) !!}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            @for ($i = 1; $i <= min(4, count($national) - 1); $i++)
                            <div class="col-md-6">
                                <div class="country-sub-grid">
                                    <div class="row">
                                        <div class="col-md-12 col-5">
                                            <a href="{{ $national[$i]->slug ? url($national[$i]->slug) : url($national[$i]->post->slug) }}"><img loading="lazy"
                                                    src="{{ $national[$i]->feature_img ? asset($national[$i]->feature_img) : asset($national[$i]->post->feature_img) }}"
                                                    class="object-cover rounded-md h-32 max-md:h-auto" alt="{{$national[$i]->title}}"></a>
                                        </div>
                                        <div class="country-sub-txt col-md-12 col-7">
                                            <a href="{{ $national[$i]->slug ? url($national[$i]->slug) : url($national[$i]->post->slug) }}">
                                                <h4 class="line-clamp-2">{{$national[$i]->title}}</h4>
                                            </a>
                                            <div class="sub-news-time">
                                                <i class="far fa-clock"></i><span>{{ \Carbon\Carbon::parse($national[$i]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="country-grid">
                    <div class="row">
                        @for ($i = 5; $i < count($national); $i++)
                        <div class="col-md-6 md:mt-3">
                            <div class="row">
                                <div class="col-md-4 col-5">
                                    <a href="{{ $national[$i]->slug ? url($national[$i]->slug) : url($national[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $national[$i]->feature_img ? asset($national[$i]->feature_img) : asset($national[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$national[$i]->title}}"></a>
                                </div>
                                <div class="col-md-8 col-7">
                                    <a href="{{ $national[$i]->slug ? url($national[$i]->slug) : url($national[$i]->post->slug) }}">
                                        <h4>{{$national[$i]->title}}</h4>
                                    </a>
                                    <div class="sub-news-time">
                                        <i class="far fa-clock"></i><span>{{ \Carbon\Carbon::parse($national[$i]->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="trending1 flex items-center justify-content-between sticky top-14 z-10">
                    <h2 class="content-heading">{{ __('trending') }}</h2>
                </div>
                <div class="container">
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($trending as $post)     
                    <div class="row trending-grid flex justify-center items-center">
                        <div class="col-md-3 col-2 flex items-center justify-center">
                            <div class="number">
                                <h1>{{ __('numbers')[$count] }}.</h1>
                            </div>
                        </div>
                        <div class="col-md-9 col-10 line-clamp-2">
                            <div class="trending-headlines">
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                    <h4>{{$post->title}}</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php
                        $count += 1;
                    @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="ads-container">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/1140x100.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
    </section>
    @endif


    <section class="container">
        @if (isset($technologies[0]))
        <section class="tech">
            <div class="row">
                <div class="{{(!isset($mostCommented[0])?'col-md-12' : 'col-md-9')}}">
                    <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                        <h2 class="content-heading">{{ __('categories')['com-tech'] }}</h2>
                        <a href="content/{{ __('categories')['com-tech'] }}">
                            <p class="news-option flex justify-center items-center"><i
                                    class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="tech-headline">
                                <div class="tech-main-news-img">
                                    <a href="{{ $technologies[0]->slug ? url($technologies[0]->slug) : url($technologies[0]->post->slug) }}"><img loading="lazy"
                                            src="{{ $technologies[0]->feature_img ? asset($technologies[0]->feature_img) : asset($technologies[0]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$technologies[0]->title}}"></a>
                                </div>
                                <div class="tech-headline-text mb-2">
                                    <a href="{{ $technologies[0]->slug ? url($technologies[0]->slug) : url($technologies[0]->post->slug) }}">
                                        <h2 class="font-bold text-xl">{{$technologies[0]->title}}</h2>
                                    </a>
                                </div>
                                <div class="news-detail bulletin line-clamp-2">{!! html_entity_decode($technologies[0]->content) !!}</div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            @for ($i = 1; $i < count($technologies); $i++)
                            <div class="row tech-grid">
                                <div class="col-md-5 col-4">
                                    <a href="{{ $technologies[$i]->slug ? url($technologies[$i]->slug) : url($technologies[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $technologies[$i]->feature_img ? asset($technologies[$i]->feature_img) : asset($technologies[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$technologies[$i]->title}}"></a>
                                </div>
                                <div class="col-md-7 col-8 p-0">
                                    <a href="{{ $technologies[$i]->slug ? url($technologies[$i]->slug) : url($technologies[$i]->post->slug) }}">
                                        <h4>{{$technologies[$i]->title}}</h4>
                                    </a>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                @if (isset($mostCommented[0]))
                <div class="col-md-3 h-max">
                    <div class="tech-comments sticky top-14 right-0 z-10">
                        <h2>{{ __('most') }} {{ __('comment') }}</h2>
                    </div>
                    <div class="container">
                        @foreach ($mostCommented as $post)     
                        <div class="row tech-comments-grid">
                            <div class="col-md-3 col-3 flex p-0">
                                <div class="number flex flex-col justify-center items-center">
                                    <h4>{{ __('numbers')[$post->comments->count()] }}</h4>
                                    <p>{{ __('comment') }}</p>
                                </div>
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="trending-headlines line-clamp-2">
                                    <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                        <h4>{{$post->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </section>
        <div class="ads-container">
            <a href="#"><img loading="lazy" src="{{ asset('asset/img/cg-digital-june.gif') }}"
                    class="object-cover rounded-md w-full" alt="ads"></a>
        </div>
       @endif

       @if (isset($interviews[0]))
        <section class="interview-section">
            <div class="row relative">
                <div class="{{(!isset($remem[0])) ? 'col-md-12' : 'col-md-9'}}">
                    <div class="interview">
                        <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                            <h2 class="content-heading">{{ __('categories')['interview'] }}</h2>
                            <a href="content/{{ __('categories')['interview'] }}">
                                <p class="news-option flex justify-center items-center"><i
                                        class="fas fa-circle-arrow-right"></i></p>
                            </a>
                        </div>
                        <div class="interview-main rounded-md">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="interview-text">
                                        <div class="interview-quote">
                                            <i class="fas fa-quote-left"></i>
                                        </div>
                                        <div class="interview-headline flex items-center">
                                            <a href="{{ $interviews[0]->slug ? url($interviews[0]->slug) : url($interviews[0]->post->slug) }}">
                                                <h2 class="content-heading">{{$interviews[0]->title}}</h2>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <a href="{{ $interviews[0]->slug ? url($interviews[0]->slug) : url($interviews[0]->post->slug) }}"><img loading="lazy"
                                            src="{{ $interviews[0]->feature_img ? asset($interviews[0]->feature_img) : asset($interviews[0]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$interviews[0]->title}}"></a>
                                </div>
                            </div>
                        </div>
                        <div class="row interview-grid">
                            @for ($i = 1; $i < count($interviews); $i++)    
                            <div class="col-md-6">
                                <div class="row items-center">
                                    <div class="col-md-4 col-4 md:mt-3">
                                        <a href="{{ $interviews[$i]->slug ? url($interviews[$i]->slug) : url($interviews[$i]->post->slug) }}"><img loading="lazy"
                                                src="{{ $interviews[$i]->feature_img ? asset($interviews[$i]->feature_img) : asset($interviews[$i]->post->feature_img) }}"
                                                class="object-cover rounded-md w-full" alt="{{$interviews[$i]->title}}"></a>
                                    </div>
                                    <div class="col-md-8 col-8">
                                        <a href="{{ $interviews[$i]->slug ? url($interviews[$i]->slug) : url($interviews[$i]->post->slug) }}">
                                            <h4>{{$interviews[$i]->title}}</h4>
                                        </a>
                                        <div class="interview-quote-small flex justify-content-end">
                                            <i class="fas fa-quote-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                @if (isset($remem[0]))
                <div class="col-md-3">
                    <div class="interview-extra sticky top-14 right-0 z-10">
                        <h2 class="content-heading">{{ __('miss-remem') }}</h2>
                    </div>
                    @foreach ($remem as $post)    
                    <div class="row interview-extra-grid items-center">
                        <div class="col-md-5 col-5">
                            <a href="{{$post->slug ? url($post->slug): url($post->post->slug)}}">
                                <img loading="lazy" src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                        </div>
                        <div class="col-md-7 col-7">
                            <a href="{{$post->slug ? url($post->slug): url($post->post->slug)}}">
                                <h4>{{$post->title}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </section>
    @endif
    

    @if (isset($secondCat[0]))
        <section class="business">
            <div class="news-title sticky top-14 z-10 hide-mobile hide-tab flex items-center justify-content-between">
                <h2 class="content-heading">{{ __('navigation')['name'][2] }}</h2>
                <a href="{{ __('navigation')['name'][2] }}">
                    <p id="last" class="news-option flex justify-center items-center"><i
                            class="fas fa-circle-arrow-right"></i></p>
                </a>
            </div>
            <div class="row">
                <div class="{{(count($secondCat)<6) ? 'col-md-12':'col-md-9'}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="business-main">
                                <a href="{{ $secondCat[0]->slug ? url($secondCat[0]->slug) : url($secondCat[0]->post->slug) }}"><img loading="lazy"
                                        src="{{ $secondCat[0]->feature_img ? asset($secondCat[0]->feature_img) : asset($secondCat[0]->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$secondCat[0]->title}}"></a>
                                <a href="{{ $secondCat[0]->slug ? url($secondCat[0]->slug) : url($secondCat[0]->post->slug) }}">
                                    <h2 class="font-bold text-xl">{{$secondCat[0]->title}}</h2>
                                </a>
                            </div>
                            <div class="news-detail line-clamp-4">
                                <p>{!! html_entity_decode($secondCat[0]->content) !!}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @for ($i = 1; $i <= min(5, count($secondCat) - 1); $i++)
                            <div class="row business-grid">
                                <div class="col-md-4 col-4">
                                    <a href="{{ $secondCat[$i]->slug ? url($secondCat[$i]->slug) : url($secondCat[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $secondCat[$i]->feature_img ? asset($secondCat[$i]->feature_img) : asset($secondCat[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$secondCat[$i]->title}}"></a>
                                </div>
                                <div class="col-md-8 col-8">
                                    <a href="{{ $secondCat[$i]->slug ? url($secondCat[$i]->slug) : url($secondCat[$i]->post->slug) }}">
                                        <h4>
                                            {{$secondCat[$i]->title}}
                                        </h4>
                                    </a>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-3 items-center">
                    @for ($i = 6; $i < count($secondCat); $i++)
                    <div class="business-extra-grid">
                        <a href="{{ $secondCat[$i]->slug ? url($secondCat[$i]->slug) : url($secondCat[$i]->post->slug) }}">
                            <h4>{{$secondCat[$i]->title}}</h4>
                        </a>
                    </div>
                    @endfor
                </div>
            </div>
        </section>
    </section>
    @endif

    @if (isset($fourthCat[0]))
    <section class="entertainment rounded-sm">
        <div class="container">
            <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                <h2 class="content-heading">{{ __('navigation')['name'][4] }}</h2>
                <a href="{{ __('navigation')['name'][4] }}">
                    <p id="last" class="news-option flex justify-center items-center"><i
                            class="fas fa-circle-arrow-right"></i></p>
                </a>
            </div>
            <div class="row mt-1 flex justify-center flex-wrap">
                <div class="news-headline m-0 {{(count($fourthCat)<7) ? 'col-md-8':'col-md-4'}}">
                    <div class="main-news-img">
                        <div class="div1">
                            <a href="{{ $fourthCat[0]->slug ? url($fourthCat[0]->slug) : url($fourthCat[0]->post->slug) }}"><img loading="lazy"
                                    src="{{ $fourthCat[0]->feature_img ? asset($fourthCat[0]->feature_img) : asset($fourthCat[0]->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$fourthCat[0]->title}}"></a>
                        </div>
                        <div class="headline-text">
                            <a href="{{ $fourthCat[0]->slug ? url($fourthCat[0]->slug) : url($fourthCat[0]->post->slug) }}">
                                <h2 class="line-clamp-2">{{$fourthCat[0]->title}}</h2>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @for ($i = 1; $i <= min(5, count($fourthCat) - 1); $i++)
                    <div class="row entertainment-grid mt-3">
                        <div class="col-md-5 col-5">
                            <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}"><img loading="lazy"
                                    src="{{ $fourthCat[$i]->feature_img ? asset($fourthCat[$i]->feature_img) : asset($fourthCat[$i]->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$fourthCat[$i]->title}}"></a>
                        </div>
                        <div class="col-md-7 col-7">
                            <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}">
                                <h4>‘{{$fourthCat[$i]->title}}’</h4>
                            </a>
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="col-md-4">
                    @for ($i = 6; $i <= min(6, count($fourthCat) - 1); $i++)
                    <div class="entertainment-extra-grid mb-4">
                        <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}"><img src="{{ $fourthCat[$i]->feature_img ? asset($fourthCat[$i]->feature_img) : asset($fourthCat[$i]->post->feature_img) }}"
                                class="object-cover rounded-md w-full" alt="{{$fourthCat[$i]->title}}"></a>
                        <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}">
                            <h2>{{$fourthCat[$i]->title}}’</h2>
                        </a>
                    </div>
                    @endfor
                    @for ($i = 7; $i <count($fourthCat); $i++)
                    <div class="row entertainment-grid">
                        <div class="col-md-5 col-5">
                            <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}"><img loading="lazy"
                                    src="{{ $fourthCat[$i]->feature_img ? asset($fourthCat[$i]->feature_img) : asset($fourthCat[$i]->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$fourthCat[$i]->title}}"></a>
                        </div>
                        <div class="col-md-7 col-7">
                            <a href="{{ $fourthCat[$i]->slug ? url($fourthCat[$i]->slug) : url($fourthCat[$i]->post->slug) }}">
                                <h4>{{$fourthCat[$i]->title}}’</h4>
                            </a>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($thirdCat[0]))
    <section class="health rounded-sm">
        <div class="container">
            <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                <div class="health-title">
                    <h2 class="content-heading">{{ __('navigation')['name'][3] }}</h2>
                </div>
                <a href="{{ __('navigation')['name'][3] }}">
                    <p id="last" class="news-option flex justify-center items-center"><i
                            class="fas fa-circle-arrow-right"></i></p>
                </a>
            </div>
            <div class="row">
                <div class="col-md-5 headline {{(count($thirdCat)<6) ? 'col-md-9' : 'col-md-5'}}">
                    <a href="{{ $thirdCat[0]->slug ? url($thirdCat[0]->slug) : url($thirdCat[0]->post->slug) }}"><img loading="lazy"
                            src="{{ $thirdCat[0]->feature_img ? asset($thirdCat[0]->feature_img) : asset($thirdCat[0]->post->feature_img) }}"
                            class="object-cover rounded-md w-full" alt="{{$thirdCat[0]->title}}"></a>
                    <a href="{{ $thirdCat[0]->slug ? url($thirdCat[0]->slug) : url($thirdCat[0]->post->slug) }}">
                        <h2 class="font-bold text-xl line-clamp-2">{{$thirdCat[0]->title}}</h2>
                    </a>
                </div>
                <div class="{{(count($thirdCat)<6) ? 'col-md-3' : 'col-md-7'}}">
                    <div class="row">
                        <div class="col-md-6 {{(count($thirdCat)<6) ? 'col-md-12' : 'col-md-6'}}">
                            @for ($i = 1; $i <= min(5, count($thirdCat) - 1); $i++)
                            <div class="row health-grid items-center">
                                <div class="col-md-5 col-5">
                                    <a href="{{ $thirdCat[$i]->slug ? asset($thirdCat[$i]->slug) : asset($thirdCat[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $thirdCat[$i]->feature_img ? asset($thirdCat[$i]->feature_img) : asset($thirdCat[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$thirdCat[$i]->title}}"></a>
                                </div>
                                <div class="col-md-7 col-7">
                                    <a href="{{ $thirdCat[$i]->slug ? asset($thirdCat[$i]->slug) : asset($thirdCat[$i]->post->slug) }}">
                                        <h4>{{$thirdCat[$i]->title}}</h4>
                                    </a>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <div class="col-md-6 health-extra-grid">
                            @for ($i = 6; $i < count($thirdCat); $i++)
                            <a href="{{ $thirdCat[$i]->slug ? url($thirdCat[$i]->slug) : url($thirdCat[$i]->post->slug) }}"><img loading="lazy"
                                    src="{{ $thirdCat[$i]->feature_img ? asset($thirdCat[$i]->feature_img) : asset($thirdCat[$i]->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$thirdCat[$i]->title}}"></a>
                            <a href="{{ $thirdCat[$i]->slug ? url($thirdCat[$i]->slug) : url($thirdCat[$i]->post->slug) }}">
                                <h4 class="line-clamp-1">{{$thirdCat[$i]->title}}</h4>
                            </a>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($sixthCat[0]))
    <section class="sports">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                        <h2 class="content-heading">{{ __('navigation')['name'][6] }}</h2>
                        <a href="{{ __('navigation')['name'][6] }}">
                            <p class="news-option flex justify-center items-center"><i
                                    class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="row">
                        @for ($i = 0; $i <= min(1, count($sixthCat) - 1); $i++)
                        <div class="col-md-6 sports-headline">
                            <a href="{{ $sixthCat[$i]->slug ? url($sixthCat[$i]->slug) : url($sixthCat[$i]->post->slug) }}"><img loading="lazy"
                                    src="{{ $sixthCat[$i]->feature_img ? asset($sixthCat[$i]->feature_img) : asset($sixthCat[$i]->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$sixthCat[$i]->title}}"></a>
                            <a href="{{ $sixthCat[$i]->slug ? url($sixthCat[$i]->slug) : url($sixthCat[$i]->post->slug) }}">
                                <h2 class="font-bold">{{$sixthCat[$i]->title}}</h2>
                            </a>
                        </div>
                        @endfor
                    </div>
                    <div class="row">
                        @for ($i = 2; $i < count($sixthCat); $i++)
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-5 col-6 sports-grid">
                                    <a href="{{ $sixthCat[$i]->slug ? asset($sixthCat[$i]->slug) : asset($sixthCat[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $sixthCat[$i]->feature_img ? asset($sixthCat[$i]->feature_img) : asset($sixthCat[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$sixthCat[$i]->title}}"></a>
                                </div>
                                <div class="col-md-7 col-6">
                                    <a href="{{ $sixthCat[$i]->slug ? asset($sixthCat[$i]->slug) : asset($sixthCat[$i]->post->slug) }}">
                                        <h4>{{$sixthCat[$i]->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                @if (isset($suggestions[0]))    
                <div class="col-md-3">
                    <div class="sports-side-grid sticky top-14 right-0 z-10">
                        <h2>{{ __('suggest') }}</h2>
                    </div>
                    @foreach ($suggestions as $post)
                    <div class="row">
                        <div class="col-md-5 col-5 sports-side-grid-img">
                            <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}"><img loading="lazy"
                                    src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                        </div>
                        <div class="col-md-7 col-7 sports-side-grid-text">
                            <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                <h4>{{$post->title}}</h4>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="ads-container">
                <a href="#"><img loading="lazy" src="{{ asset('asset/img/1230-x-100.gif') }}"
                        class="object-cover rounded-md w-full" alt="ads"></a>
            </div>
        </div>
    </section>
    @endif

    @if (isset($international[0]))
    <section class="foreign">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                        <h2 class="content-heading">{{ __('categories')['international'] }}</h2>
                        <a href="content/{{ __('categories')['international'] }}">
                            <p class="news-option"><i class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="foreign-headline">
                                <a href="{{ $international[0]->slug ? url($international[0]->slug) : url($international[0]->post->slug) }}"><img loading="lazy"
                                        src="{{ $international[0]->feature_img ? asset($international[0]->feature_img) : asset($international[0]->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$international[0]->title}}"></a>
                                <a href="{{ $international[0]->slug ? url($international[0]->slug) : url($international[0]->post->slug) }}">
                                    <h2 class="font-bold">{{$international[0]->title}}</h2>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                @for ($i = 1; $i <= min(4, count($international) - 1); $i++)
                                <div class="col-md-6 col-6 foreign-grid">
                                    <a href="{{ $international[$i]->slug ? url($international[$i]->slug) : url($international[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $international[$i]->feature_img ? asset($international[$i]->feature_img) : asset($international[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$international[$i]->title}}"></a>
                                    <a href="{{ $international[$i]->slug ? url($international[$i]->slug) : url($international[$i]->post->slug) }}">
                                        <h4 class="line-clamp-1">
                                            {{$international[$i]->title}}
                                        </h4>
                                    </a>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @for ($i = 5; $i < count($international); $i++)
                        <div class="col-md-6 col-6">
                            <div class="row foreign-bottom-grid">
                                <div class="col-md-5">
                                    <a href="{{ $international[$i]->slug ? url($international[$i]->slug) : url($international[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $international[$i]->feature_img ? asset($international[$i]->feature_img) : asset($international[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$international[$i]->title}}"></a>
                                </div>
                                <div class="col-md-7">
                                    <a href="{{ $international[$i]->slug ? url($international[$i]->slug) : url($international[$i]->post->slug) }}">
                                        <h4>{{$international[$i]->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                     @endfor
                    </div>
                </div>
                <div class="col-md-3 relative">
                    <div class="ad-grid hide-mobile sticky top-14 right-0">
                        <a href="#"><img loading="lazy"
                                src="{{ asset('asset/img/ime-super-man_300x150.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                        <a href="#"><img loading="lazy"
                                src="{{ asset('asset/img/300_125-mother-daughter_new.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($literature[0]))
    <section class="literature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                        <h2 class="content-heading">{{ __('categories')['literature'] }}</h2>
                        <a href="content/{{ __('categories')['literature'] }}">
                            <p class="news-option"><i class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="literature-headline">
                                <a href="#"><img loading="lazy"
                                        src="{{ $literature[0]->feature_img ? asset($literature[0]->feature_img) : asset($literature[0]->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$literature[0]->title}}"></a>
                                <a href="#" class="mb-0">
                                    <h2 class="font-bold text-xl m-0">{{$literature[0]->title}}</h2>
                                </a>
                                <div class="news-detail literature line-clamp-3">
                                    {!! html_entity_decode($literature[0]->content) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                @for ($i = 1; $i < count($literature); $i++)
                                <div class="col-md-6 col-6">
                                    <div class="literature-grid">
                                        <a href="{{ $literature[$i]->slug ? url($literature[$i]->slug) : url($literature[$i]->post->slug) }}"><img loading="lazy"
                                                src="{{ $literature[$i]->feature_img ? asset($literature[$i]->feature_img) : asset($literature[$i]->post->feature_img) }}"
                                                class="object-cover rounded-md w-full" alt="{{$literature[$i]->title}}"></a>
                                        <a href="{{ $literature[$i]->slug ? url($literature[$i]->slug) : url($literature[$i]->post->slug) }}">
                                            <h4 class="line-clamp-1">{{$literature[$i]->title}}</h4>
                                        </a>
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($worldsContent[0]))
    <section class="world">
        <div class="container">
            <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                <h2 class="content-heading">{{ __('categories')['intr-wrld'] }}</h2>
                <a href="content/{{ __('categories')['intr-wrld'] }}">
                    <p class="news-option"><i class="fas fa-circle-arrow-right"></i></p>
                </a>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="world-headline">
                                <a href="{{ $worldsContent[0]->slug ? url($worldsContent[0]->slug) : url($worldsContent[0]->post->slug) }}"><img loading="lazy"
                                        src="{{ $worldsContent[0]->feature_img ? asset($worldsContent[0]->feature_img) : asset($worldsContent[0]->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$worldsContent[0]->title}}"></a>
                                <div class="world-headline-text">
                                    <a href="{{ $worldsContent[0]->slug ? url($worldsContent[0]->slug) : url($worldsContent[0]->post->slug) }}">
                                        <h2 class="line-clamp-1">{{$worldsContent[0]->title}}</h2>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            @for ($i = 1; $i <= min(3, count($worldsContent) - 1); $i++)
                            <div class="row world-grid">
                                <div class="col-md-5 col-5">
                                    <a href="{{ $worldsContent[$i]->slug ? url($worldsContent[$i]->slug) : url($worldsContent[$i]->post->slug) }}"><img loading="lazy"
                                            src="{{ $worldsContent[$i]->feature_img ? asset($worldsContent[$i]->feature_img) : asset($worldsContent[$i]->post->feature_img) }}"
                                            class="object-cover rounded-md w-full" alt="{{$worldsContent[$i]->title}}"></a>
                                </div>
                                <div class="col-md-7 col-7">
                                    <a href="{{ $worldsContent[$i]->slug ? url($worldsContent[$i]->slug) : url($worldsContent[$i]->post->slug) }}">
                                        <h4>{{$worldsContent[$i]->title}}</h4>
                                    </a>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    @for ($i = 4; $i < count($worldsContent); $i++)
                    <div class="world-side-grid">
                        <a href="{{ $worldsContent[$i]->slug ? url($worldsContent[$i]->slug) : url($worldsContent[$i]->post->slug) }}">
                            <h4>{{$worldsContent[$i]->title}}</h4>
                        </a>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>
    @endif

    @if (isset($travels[0]))
    <section class="bulk-card">
        <div class="container">
            <div class="news-title sticky top-14 z-10 flex items-center justify-content-between">
                <h2 class="content-heading">{{ __('categories')['travels'] }}</h2>
                <a href="content/{{ __('categories')['travels'] }}">
                    <p class="news-option"><i class="fas fa-circle-arrow-right"></i></p>
                </a>
            </div>
            <div class="gallery">
                <div class="grid grid-cols-12 gap-3">
                    @foreach ($travels as $post)
                    <div class="max-md:col-span-12 max-lg:col-span-2 col-span-3">
                        <div class="card-grid relative">
                            <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                <img loading="lazy"
                                    src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                    class="object-cover rounded-md w-full" alt="{{$post->title}}">
                            </a>
                            <div class="img-text flex items-center">
                                @if ($post->user)    
                                <img src="{{$post->user->profile_photo_url}}"
                                    class="author-img max-h-10 w-10 object-cover rounded-full float-start me-1"
                                    alt="{{$post->user->name}}">
                                @endif
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                        <h4 class="text-justify">{{$post->title}}</h4>
                                </a>
                            </div>
                            <div class="sub-news-time absolute top-0 left-0">
                                <span>
                                    <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif
</x-app-layout>
