<a href="/">
    @foreach ($logoNameImageUrls as $imageUrl)
    <img loading="lazy"
        src="{{$imageUrl}}" class="object-cover h-10 select-none" alt="logo">
    @endforeach
</a>
