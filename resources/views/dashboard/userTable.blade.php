<x-dashboard-layout>
    @php
        $count = 1;
    @endphp
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs  uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">
                        S.N.
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Unique Id
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Email
                    </th>
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <th scope="col" class="px-4 py-3">
                            Image
                        </th>
                    @endif
                    <th scope="col" class="px-4 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-4 py-3">
                        Status
                    </th>
                    @can('block/unblock')
                        <th scope="col" class="px-4 py-3">
                            Role
                        </th>
                    @endcan
                    <th scope="col" class="px-4 py-3">
                        Activity
                    </th>
                    <th scope="col" class="sr-only">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-4">{{ $count }}</td>
                        <td class="px-4 py-4">{{ $user->name }}</td>
                        <td class="px-4 py-4">{{ $user->u_id }}</td>
                        <td class="px-4 py-4">{{ $user->email }}</td>
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <td class="px-4 py-4">
                                @if ($user->profile_photo_path)
                                    <img src="{{ $user->profile_photo_url }}"
                                        alt="{{ $user->name }}" class="rounded-full h-10 w-10">
                                @endif
                            </td>
                        @endif
                        <td class="px-4 py-4">
                            @if ($user->location)
                                <a href="https://www.google.com/maps/dir/current+location/{{ $user->location }}" target="_blank"
                                    class="hover:text-sky-700"><i class='bx bxs-map-pin'></i></a>
                            @endif
                        </td>
                        @if ($user->status == 1)
                            @can('block/unblock')
                                <td class="px-4 py-4">
                                    <a href="{{ $user->email . '/ban' }}" class="shadow-lg"
                                        onclick="return confirm('Are you sure you want to ban him/her ?')">
                                        <button type="button"
                                            class="text-white bg-red-700 hover:bg-red-900 hover:shadow-xl focus:outline-none font-medium rounded-full text-sm px-4 py-1.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Ban</button>
                                    </a>
                                </td>
                            @endcan
                        @else
                            @can('block/unblock')
                                <td class="px-4 py-4">
                                    <a href="{{ $user->email . '/unban' }}" class="shadow-lg">
                                        <button type="button"
                                            class="text-white bg-green-700 hover:bg-green-900 hover:shadow-xl focus:outline-none font-medium rounded-full text-sm px-4 py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Unban</button>
                                    </a>
                                </td>
                            @endcan
                        @endif

                        <td class="px-4 py-4 flex flex-wrap">
                           @if (!empty($user->getRoleNames()))
                             @foreach ($user->getRoleNames() as $item)
                             <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">{{$item}}</span>
                             @endforeach                               
                           @endif
                        </td>

                        @if ($user->isUserOnline())
                            <td class="px-4 py-4">
                                <button type="button"
                                    class="text-green-800 font-medium rounded-full text-sm px-5 py-1.5 text-center dark:bg-green-600">Online</button>
                            </td>
                        @else
                            <td class="px-4 py-4">
                                <button type="button"
                                    class="text-red-800 font-medium rounded-full text-sm px-5 py-1.5 text-center me-2 mb-2 dark:bg-red-600">Offline</button>
                            </td>
                        @endif
                        @can('change role')
                        <td class="px-4 py-4">
                            <a href="{{url('role/'.$user->id.'/edit')}}">
                            <button type="button"
                                            class="text-white bg-green-700 hover:bg-green-900 hover:shadow-xl focus:outline-none font-medium rounded-full text-sm px-4 py-1.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Role</button>
                                        </a>
                        </td>
                        @endcan
                    </tr>
                    @php
                        $count++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $users->onEachSide(2)->links() }}
        </div>
    </div>
</x-dashboard-layout>
