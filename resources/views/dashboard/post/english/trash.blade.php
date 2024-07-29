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
                @foreach ($posts as $post)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-3 py-4 text-black relative">
                            <small
                                class="absolute top-0 left-5 z-10 text-gray-300">{{ date('Y-m-d', strtotime($post->created_at)) }}</small>
                          {{ $post->title }}
                        </td>
                        <td class="px-3 py-4 relative">
                            <small class="absolute top-0 left-5 z-10 text-gray-300 max-md:hidden">{{ $post->np_post_id ? 'Connected-'.$post->post->title : 'sigle' }}</small>
                            {{$post->slug ? $post->slug : $post->post->slug }}
                        </td>
                        <td class="px-3 py-4">
                            <img src="{{ $post->feature_img?asset($post->feature_img):asset($post->post->feature_img) }}" class="h-20 rounded" alt="">
                        </td>
                        <td class="px-3 py-4">
                            @php
                                $jsonData = json_decode(file_get_contents(base_path('lang/en.json')), true);
                            @endphp
                            {{ $jsonData['navigation']['name'][$post->category] }}
                        </td>
                        <td class="px-3 py-4">
                            {{ $post->sub_category }}
                        </td>
                        <td class="px-3 py-4">
                            <span
                            class="bg-gray-500 text-white font-bold py-1 px-2 rounded-full whitespace-nowrap text-center">Trashed</span>
                        </td>
                        <td class="px-3 py-4 grid gap-3 border-l">
                            @canany(['add post','update post'])
                            <a href="{{ url('post/englishpost/'.$post->id.'/restore') }}"
                                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap text-center">Restore</a>
                                @endcanany
                                @can('delete post')
                                <form action="{{ url('post/englishpost/'.$post->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure delete this post ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">Delete</button>
                                </form>
                                @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-layout>