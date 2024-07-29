<x-app-layout>
    <section class="news read-post">
        <div class="container">
            <div class="row max-[768px]:relative">
                @if (!empty($response['post']))
                    @push('title')
                        {{ $response['post']->title }}
                    @endpush
                    @push('meta')
                        <x-seo-management :title="$response['post']->title" :slug="$response['post']->slug ? $response['post']->slug : $response['post']->post->slug" :keywords="$response['post']->keywords" :tags="$response['post']->tags"
                            :image="$response['post']->feature_img ? asset($response['post']->feature_img) : asset($response['post']->post->feature_img)" :author="$response['post']->author" :metaData="$response['post']->meta_description" />
                    @endpush

                    <h2 class="font-bold md:mb-8 border-b-2 h-full bg-white article-heading" id="article-heading">
                        {{ $response['post']->title }}</h2>
                @endif
                <div class="col-md-1 flex justify-center md:relative max-md:mb-3">
                    @if (!empty($response['post']))
                        <div class ="social-share sticky top-36 left-0 max-[768px]:flex-row max-[768px]:w-[350px] max-[768px]:h-[80px]"
                            data-link="{{ $response['post']->slug ? $response['post']->slug : $response['post']->post->slug }}">
                            <a href="#facebook" class="btn">
                                <i class="fab fa-facebook-f" style="color: #3b5998;"></i>
                            </a>
                            <a href="#twitter" class="btn">
                                <i class="fab fa-twitter" style="color: #00acee;"></i>
                            </a>
                            <a href="#dribbble" class="btn">
                                <i class="fab fa-dribbble" style="color: #ea4c89;"></i>
                            </a>
                            <a href="#linkedin" class="btn">
                                <i class="fab fa-linkedin-in" style="color:#0e76a8;"></i>
                            </a>
                            <a href="#pinterest" class="btn">
                                <i class="fab fa-pinterest" style="color:#ee4056;"></i>
                            </a>
                            <a href="#email" class="btn">
                                <i class="far fa-envelope"></i>
                            </a>
                            <a onclick="share()" class="btn">
                                <i class="fas fa-share"></i>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    @if (empty($response['post']))
                        <x-data-not-available name="{{ $search }}" />
                    @else
                        <article class="flex flex-col mb-5 w-full gap-3 border-b-2 md:p-5" id="article">
                            <div class="article-content">
                                <div id="heart">
                                    <div id="liked"></div>
                                </div>
                                <picture class="w-full">
                                    <img src="{{ $response['post']->feature_img ? asset($response['post']->feature_img) : asset($response['post']->post->feature_img) }}"
                                        alt="{{ $response['post']->title }}" class="w-full object-cover">
                                </picture>
                                <div class="content mt-3 text-justify leading-8">
                                    {!! html_entity_decode($response['post']->content) !!}
                                </div>

                                @if ($response['post']->tags)
                                    <div class="inline-flex rounded-md flex-wrap gap-2 border-b-2 pb-2" role="group">
                                        @php
                                            $dataArray = explode(',', $response['post']->tags);
                                        @endphp
                                        @foreach ($dataArray as $tag)
                                            <a href="{{ url('hashtag/' . trim($tag)) }}" data-type='tag'><button
                                                    type="button"
                                                    class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                                                    {{ $tag }}
                                                </button></a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            {{-- comment section --}}
                            @livewire('comments-livewire', ['post' => $response['post']->title])
                        </article>
                    @endif
                </div>

                <div class="col-md-3 rounded-md relative">
                    <div class="ad-grid hide-mobile">
                        <a href="#"><img loading="lazy" src="{{ asset('asset/img/ime-super-man_300x150.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                        <a href="#"><img loading="lazy"
                                src="{{ asset('asset/img/300_125-mother-daughter_new.gif') }}"
                                class="object-cover rounded-md w-full" alt="ads"></a>
                    </div>
                    @if (!empty($response['post']))
                        @livewire('most-view-comment', ['post' => $response['post']->title])
                    @else
                        @livewire('most-view-comment', ['post' => 'no-post'])
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="other bulk-card">
        <div class="container bg-gray-400 p-3 rounded-sm">
            <div class="gallery">
                @if (!empty($response['post']))
                    @livewire('other-posts', ['post' => $response['post']->title])
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
