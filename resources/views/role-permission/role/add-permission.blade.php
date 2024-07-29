<x-dashboard-layout>

    <div
        class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        
        <h1 class="text-center font-bold text-md">Role : {{ $roles->name }}</h1>
        <hr>
        <legend class="font-bold text-sm">Permissions</legend>
        <form class="space-y-6 flex flex-wrap gap-5 justify-between"
            action="{{ url('roles/' . $roles->id . '/add-permission') }}" method="POST">
            @csrf
            @error('permission')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
            @foreach ($permissions as $permission)
                <fieldset>
                    <label class="flex cursor-pointer">
                        <div class="flex items-center h-5">
                            <input id="helper-checkbox" name="permission[]" aria-describedby="helper-checkbox-text"
                                type="checkbox" value="{{ $permission->name }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                {{ in_array($permission->id, $RoleHasPermission) ? 'checked' : '' }} />
                        </div>
                        <div class="ms-2 text-sm">
                            <span for="helper-checkbox"
                                class="font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                            @if ($permission->description !== '')
                                <details id="helper-checkbox-text"
                                    class="text-xs font-normal text-gray-500 dark:text-gray-400">
                                    {{ $permission->description }}</details>
                            @endif
                        </div>
                    </label>
                </fieldset>
            @endforeach
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Give
                Permission</button>
                <a href="{{ url('roles') }}"><button type="button" class="float-right text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button></a>
        </form>
    </div>
</x-dashboard-layout>
