<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('asset/css/content.css') }}">
    @endpush
    <div class="main-content max-[768px]:relative" id="content">
        <div class="wrapper section">
            <div class="container flex flex-wrap justify-center">
                <div class="">

                    @if (empty($posts) || !isset($posts[0]))
                        <x-data-not-available name="{{ $search }}" />
                    @else
                        <div class="wrapper-title sticky top-14 left-0 z-10">
                            <h2 class="border-b-2">{{ $search }}</h2>
                        </div>
                        <div
                            class="post-content flex max-sm:flex-col max-sm:justify-center max-sm:items-center relative">
                            <div class="post-img-wrap">
                                <a href="{{ $posts[0]->slug ? url($posts[0]->slug) : url($posts[0]->post->slug) }}">
                                    <img src="{{ $posts[0]->feature_img ? asset($posts[0]->feature_img) : asset($posts[0]->post->feature_img) }}"
                                        class="w-full h-full" alt="{{ $posts[0]->title }}" loading="lazy" />
                            </div>
                            <div class="post-title-wrap">
                                <h4 class="text-3xl max-md:text-xl">
                                    <a
                                        href="{{ $posts[0]->slug ? url($posts[0]->slug) : url($posts[0]->post->slug) }}">{{ $posts[0]->title }}</a>
                                </h4>
                                <p class="line-clamp-3">{{ $posts[0]->meta_description }}</p>
                                <i class="absolute bottom-0 right-2 text-sm text-blue-500">Author: {{$posts[0]->user->name}}</i>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-8">
                            @for ($i = 1; $i < count($posts); $i++)
                                @php
                                    $post = $posts[$i];
                                @endphp
                                <div class="col-span-4 max-md:col-span-6 max-sm:col-span-12">
                                    <div class="relative rounded-sm">
                                        <a href="{{ $post->slug ? url($post->slug) : url($post->post->slug) }}">
                                            <img src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}"
                                                class="grid-post-img w-full rounded-sm" alt="{{ $post->title }}"
                                                loading="lazy" />
                                            <div class="post-info">
                                                <h2 class="post-title font-bold mt-1 text-justify">{{ $post->title }}</h2>
                                                <div class="post-upload flex">
                                                    <div class="post-time absolute top-0 left-0 p-1 lowercase">
                                                        <i class="far fa-clock"></i>
                                                        <span>{{ \Carbon\Carbon::parse($post->created_at)->shortAbsoluteDiffForHumans() }} {{ __('time')['ago'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endfor
                        </div>
                        <div class="flex justify-center">
                            {{ $posts->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
