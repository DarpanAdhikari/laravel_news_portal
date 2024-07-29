<x-app-layout>
    @push('title')
    {{__('navigation')['name'][$position]}}
    @endpush
    <section class="news">
        <div class="container">
            <div class="row">
                <div class="col-md-9 items-center justify-center">
                    <div class="flex items-center justify-content-between mb-5 w-full border-b-2">
                        <h2 class="content-heading text-blue-500">{{__('navigation')['name'][$position]}}</h2>
                    </div>
                    @if(empty($response['posts']) || !isset($response['posts'][0]))
                    <x-data-not-available name="{{__('navigation')['name'][$position]}}" />
                   @else
                    <div class="row news-headline">
                        <div class="col-md-7 news-img">
                            <a href="{{$response['posts'][0]->slug ? $response['posts'][0]->slug : $response['posts'][0]->post->slug}}"><img loading="lazy"
                                    src="{{$response['posts'][0]->feature_img ? asset($response['posts'][0]->feature_img) : asset($response['posts'][0]->post->feature_img)}}"
                                    class="object-cover rounded-md w-full max-h-full mb-3" alt="{{$response['posts'][0]->title}}"></a>
                        </div>
                        <div class="col-md-5">
                            <div class="sub-news-time">
                                <span>
                                <i class="far fa-calendar-alt"></i>
                                    {{ \Carbon\Carbon::parse($response['posts'][0]->created_at)->shortAbsoluteDiffForHumans() }}
                                </span>
                            </div>
                            <div class="news-detail">
                                {!! html_entity_decode($response['posts'][0]->content) !!}
                            </div>
                        </div>
                        <div class="news-main mt-3">
                            <a href="{{$response['posts'][0]->slug ? $response['posts'][0]->slug : $response['posts'][0]->post->slug}}">
                                <h2>{{$response['posts'][0]->title}}</h2>
                            </a>
                        </div>
                    </div>
                
                    <div class="row news-grid">
                        @for ($i = 1; $i < count($response['posts']); $i++)
                            @php
                                $post = $response['posts'][$i];
                            @endphp
                            <div class="col-md-4 col-6">
                                <a href="{{$post->slug ? $post->slug : $post->post->slug }}"><img loading="lazy" src="{{$post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img)}}" class="object-cover rounded-md w-full" alt="{{ $post->title }}"></a>
                                <a href="{{$post->slug ? $post->slug : $post->post->slug }}">
                                    <h4>{{ $post->title }}</h4>
                                </a>
                                <div class="sub-news-time lowercase">
                                    <span>
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}
                                    </span>
                                </div>
                            </div>
                        @endfor
                    </div>
                    <div class="flex justify-center">
                        {{ $response['posts']->links() }}
                    </div>
                @endif
                
                </div>

                <div class="col-md-3 rounded-md h-full sticky top-16 right-0">
                @if(isset($response['recomends'][0]))
                    <div class="flex items-center justify-content-between bg-blue-300 p-3">
                        <h2 class="content-heading">Recomended</h2>
                    </div>
                    @foreach ($response['recomends'] as $post)     
                    <div class="people-grid1">
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                    <h5 class="line-clamp-2">{{$post->title}}</h5>
                                </a>
                                @if ($post->user)
                                <p>{{$post->user->name}}</p>
                                @endif
                            </div>
                            <div class="col-md-4 col-4 p-0 flex justify-center items-center">
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}"><img loading="lazy" src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                        class="object-cover rounded-md w-full" alt="{{$post->title}}"></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                @if (isset($response['nextCat'][0]))
                    <div class="blog flex items-center justify-content-between">
                        @php
                            $arrayLength = count(__('navigation')['name']);
                            $nextPosition = ($position + 1) % $arrayLength;
                            $nextPosition = $nextPosition == 0 ? 1 : $nextPosition;
                            $nextValue = __('navigation')['name'][$nextPosition];
                        @endphp
                        <h2 class="content-heading">{{ $nextValue }}
                        </h2>
                        <a href="{{ $nextValue }}">
                            <p class="news-option flex justify-center items-center"><i
                                    class="fas fa-circle-arrow-right"></i></p>
                        </a>
                    </div>
                    @foreach ($response['nextCat'] as $post)    
                    <div class="people-grid1">
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                    <h5>{{$post->title}}</h5>
                                </a>
                                @if ($post->user)
                                <p>{{$post->user->name}}</p>
                                @endif
                            </div>
                            <div class="col-md-4 col-4 p-0 flex items-center justify-center">
                                <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}"><img loading="lazy"
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
    </section>

</x-app-layout>
