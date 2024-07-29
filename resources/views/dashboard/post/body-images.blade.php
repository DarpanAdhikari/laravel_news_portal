<x-dashboard-layout>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    @foreach($images as $image)
    <div class="relative group">
        <img class="h-40 rounded-lg filter group-hover:blur-md" src="{{ asset('post_img/body_img/' . $image) }}" alt="">
        <form action="{{route('delete.image')}}" method="POST" enctype="multipart/form-data" class="absolute top-0 left-0 w-full h-full flex justify-center items-center opacity-0 group-hover:opacity-100">
            @csrf
            <input type="hidden" value="{{$image}}" name="image"/>
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full whitespace-nowrap">Delete</button>
        </form>
    </div>
    @endforeach
</div>
</x-dashboard-layout>