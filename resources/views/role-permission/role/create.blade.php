<x-dashboard-layout>
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700"> 
        <a href="{{ url('roles') }}"><button type="button" class="float-right text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancel</button></a>
        <form class="space-y-6" action="{{url('roles')}}" method="POST">
            @csrf
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">New role</h5>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Name</label>
                <input type="text" name="name" value="{{old('name')}}" id="name" class="bg-gray-50 border ]text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('name') border-red-300 @enderror" placeholder="" required />
                @error('name')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role Description</label>
                <input type="text" name="description" id="description" value="{{old('description')}}" class="bg-gray-50 border ]text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white @error('description') border-red-300 @enderror" placeholder="" required />
                @error('description')
                <span class="text-red-500">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Role</button>
        </form>
    </div>    
</x-dashboard-layout>