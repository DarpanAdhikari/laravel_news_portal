<x-dashboard-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Slug
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Feature
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Sub Category
                    </th>
                    <th scope="col" class="px-3 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-3 py-3 sr-only">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 1;
                @endphp
                @foreach ($posts as $post)
                <div data-popover id="popover-post-info-{{$count}}" role="tooltip" class="absolute z-30 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">{{$post->created_at}}</h3>
                    </div>
                    <div class="px-3 py-2">
                        <span class="text-sm text-gray-400 flex w-full justify-around">
                            <div>
                                {{$post->views->count()}} <i class="fas fa-eye text-sm"></i>
                            </div>  
                            <div>
                                {{$post->likes->count()}} <i class="fas fa-thumbs-up"></i>
                            </div>
                            <div>
                                {{$post->comments->count()}} <i class="fas fa-comments"></i>
                            </div>
                        </span>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                    <tr data-popover-target="popover-post-info-{{$count}}"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 relative">
                        <td class="px-3 py-4 text-black relative">
                            <small
                                class="absolute top-0 left-5 z-10 text-gray-300">{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small>
                            <a href="{{ url($post->slug ? $post->slug : $post->post->slug) }}" class="hover:underline">{{ $post->title }}
                        </td>
                        <td class="px-3 py-4 relative">
                            <small class="absolute top-0 left-5 z-10 text-gray-300 max-md:hidden">{{ $post->en_post_id ? 'Connected-'.$post->post->title : 'sigle' }}</small>
                            {{$post->slug ? $post->slug : $post->post->slug }}
                        </td>
                        <td class="px-3 py-4">
                            <img src="{{ $post->feature_img ? asset($post->feature_img) : asset($post->post->feature_img) }}" class="h-20 rounded" alt="">
                        </td>
                        <td class="px-3 py-4">
                            @php
                                $jsonData = json_decode(file_get_contents(base_path('lang/np.json')), true);
                            @endphp
                            {{ $jsonData['navigation']['name'][$post->category] }}
                        </td>
                        <td class="px-3 py-4">
                            {{ $post->sub_category }}
                        </td>
                        <td class="px-3 py-4">
                            @if ($post->status == 1)
                                <span
                                    class="bg-green-500 text-white font-bold py-1 px-2 rounded-full whitespace-nowrap text-center">Post</span>
                            @else
                                <span
                                    class="bg-yellow-500 text-white font-bold py-1 px-2 rounded-full whitespace-nowrap text-center">Draft</span>
                            @endif
                        </td>
                        <td class="px-3 py-4 grid gap-3 border-l">
                            <a href="{{ url('post/nepalipost/' . $post->id . '/edit') }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap text-center">Edit</a>
                            <form action="{{ url('post/nepalipost/' . $post->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $count +=1;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
    <x-dash-btm-nav.manage-post />
</x-dashboard-layout>
