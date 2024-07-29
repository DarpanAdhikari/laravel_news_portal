<x-dashboard-layout>
    
    <a href="{{ url('roles/create') }}"><button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"><i class="fas fa-plus"></i> Add More</button></a>
 <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
     <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
         <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
             <tr>
                 <th scope="col" class="px-6 py-3">
                     Role name
                 </th>
                 <th scope="col" class="px-6 py-3">
                    Role Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Role Has permission
                </th>
                 <th scope="col" class="px-6 py-3">
                     <span class="sr-only">Edit</span>
                 </th>
             </tr>
         </thead>
         <tbody>
             @foreach ($roles as $role)
             <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                 <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                     {{$role->name}}
                 </td>
                 <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                    {{$role->description}}
                </td>
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                    @foreach ($role->getPermissionNames() as $item)
                    <span class="bg-blue-100 text-blue-800 m- text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300 whitespace-nowrap">{{$item}},</span>
                    @endforeach
                </td>
                <td class="px-6 py-4 text-right flex">
                    @can('manage role')
                    <a href="{{url('roles/'.$role->id.'/edit')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">Edit</a>
                    <a href="{{url('roles/'.$role->id.'/add-permission')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">Add Permission</a>
                    @endcan
                    @can('delete role')
                     <form action="{{ url('roles/'.$role->id) }}" method="POST" class="inline">
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
    <a href="{{ url('permissions') }}"><button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Go to permission</button></a>
 </x-dashboard-layout>