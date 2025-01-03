<x-app-layout>
    @push('css')
        <link rel="stylesheet" href="{{ asset('asset/css/our_team.css') }}">
    @endpush
   <div class="container relative">
       <h1 class="section-title absolute top-0 left-0">News</h1>
       <section class="team-member-section grid grid-cols-12 gap-5">
        @foreach ($users as $user)
        <div class="profile-card shadow-md">
            <div class="card-header">
                <img class="card-avatar" src="{{$user->profile_photo_url}}" alt="avatar" />
                <h1 class="card-fullname">{{$user->name}}</h1>
                <h2 class="card-jobtitle"> @if (!empty($user->getRoleNames()))
                  @foreach ($user->getRoleNames() as $item) {{$item}}@endforeach @endif</h2>
              </div>
              <div class="card-main">
                <div class="card-section is-active" id="about">
                  <div class="card-social flex justify-center">
                    <a href="{{$user->facebook}}" target="_blank"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15.997 3.985h2.191V.169C17.81.117 16.51 0 14.996 0c-3.159 0-5.323 1.987-5.323 5.639V9H6.187v4.266h3.486V24h4.274V13.267h3.345l.531-4.266h-3.877V6.062c.001-1.233.333-2.077 2.051-2.077z" /></svg></a>
                    <a href="{{$user->twitter}}" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M512 97.248c-19.04 8.352-39.328 13.888-60.48 16.576 21.76-12.992 38.368-33.408 46.176-58.016-20.288 12.096-42.688 20.64-66.56 25.408C411.872 60.704 384.416 48 354.464 48c-58.112 0-104.896 47.168-104.896 104.992 0 8.32.704 16.32 2.432 23.936-87.264-4.256-164.48-46.08-216.352-109.792-9.056 15.712-14.368 33.696-14.368 53.056 0 36.352 18.72 68.576 46.624 87.232-16.864-.32-33.408-5.216-47.424-12.928v1.152c0 51.008 36.384 93.376 84.096 103.136-8.544 2.336-17.856 3.456-27.52 3.456-6.72 0-13.504-.384-19.872-1.792 13.6 41.568 52.192 72.128 98.08 73.12-35.712 27.936-81.056 44.768-130.144 44.768-8.608 0-16.864-.384-25.12-1.44C46.496 446.88 101.6 464 161.024 464c193.152 0 298.752-160 298.752-298.688 0-4.64-.16-9.12-.384-13.568 20.832-14.784 38.336-33.248 52.608-54.496z" /></svg></a>
                    <a href="{{$user->linkedin}}" target="_blank"><svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M23.994 24v-.001H24v-8.802c0-4.306-.927-7.623-5.961-7.623-2.42 0-4.044 1.328-4.707 2.587h-.07V7.976H8.489v16.023h4.97v-7.934c0-2.089.396-4.109 2.983-4.109 2.549 0 2.587 2.384 2.587 4.243V24zM.396 7.977h4.976V24H.396zM2.882 0C1.291 0 0 1.291 0 2.882s1.291 2.909 2.882 2.909 2.882-1.318 2.882-2.909A2.884 2.884 0 002.882 0z" /></svg></a>
                  </div>
                </div>
              </div>
           </div>
           @endforeach
    </section>
   </div>
</x-app-layout>