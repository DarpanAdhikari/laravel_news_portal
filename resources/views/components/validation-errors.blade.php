@if ($errors->any())
    <div {{ $attributes }}>
        <small class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li><small>{{ $error }}</small></li>
            @endforeach
        </small>
    </div>
@endif
