<x-dashboard-layout>

    <div
        class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('user.table') }}"><button type="button"
                class="float-right text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button></a>
        <h1 class="text-center font-bold text-md">User : {{ $user->name }} / <small>{{ $user->email }}</small></h1>
        <hr>
        <legend class="font-bold text-sm">Roles</legend>
        @error('user')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        @error('role')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <form class="space-y-6 flex flex-wrap gap-5 justify-between" action="{{route('change-role')}}" method="POST">
            <input type="hidden" name="user" value="{{$user->id}}"/>
            @csrf
            @foreach ($roles as $role)
                <fieldset>
                    <label class="flex cursor-pointer">
                        <div class="flex items-center h-5">
                            <input id="helper-checkbox" name="role[]" aria-describedby="helper-checkbox-text"
                                type="checkbox" value="{{ $role->name }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" {{in_array($role->name,$userRole)?'checked':''}}/>
                        </div>
                        <div class="ms-2 text-sm">
                            <span for="helper-checkbox"
                                class="font-medium text-gray-900 dark:text-gray-300">{{ $role->name }}</span>
                            @if ($role->description !== '')
                                <details id="helper-checkbox-text"
                                    class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                    {{ $role->description }}</details>
                            @endif
                            <tt class="font-bold">Has permissions</tt>
                            <ul class="space-y-1 text-left text-gray-500 dark:text-gray-400">
                                @foreach ($role->getPermissionNames() as $item)
                                    <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                        <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 16 12">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5" />
                                        </svg>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </label>
                </fieldset>
            @endforeach
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Give
                Role</button>
        </form>
    </div>
</x-dashboard-layout>
