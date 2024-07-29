<x-dash-btm-nav.customize-content>
    <div class="pb-20">
        <form action="{{ route('localization.update') }}" method="post" class="flex flex-wrap justify-center">
            @csrf
            <div class="content-section flex flex-wrap w-full justify-around">
                <div class="english min-w-[49%]">
                    <h1 class="text-lg font-semibold mb-4 dark:text-gray-100">English Content</h1>
                    @foreach ($editableEnContent as $key => $value)
                    <label for="{{ $key }}" class="uppercase font-bold font-mono dark:text-gray-300">{{ $key }}</label> <br>
                    <textarea name="en_content[{{ $key }}]" class="resize-none overflow-hidden min-h-[50px] block h-auto w-full bg-gray-100 text-red-600 dark:text-red-300 border border-gray-300 rounded-md py-2 px-3 placeholder-gray-400 outline-none focus:outline-none resizable-textarea json-data dark:bg-gray-700 dark:placeholder-gray-400">{{ json_encode($value, JSON_PRETTY_PRINT) }}</textarea>
                    @endforeach
                </div>
                <div class="nepali min-w-[49%]">
                    <h1 class="text-lg font-semibold mb-4 dark:text-gray-100">Nepali Content</h1>
                    @foreach ($editableNpContent as $key => $value)
                    <label for="{{ $key }}" class="uppercase font-bold font-mono dark:text-gray-300">{{ $key }}</label> <br>
                    <textarea name="np_content[{{ $key }}]" class="resize-none overflow-hidden block h-auto w-full bg-gray-100 text-red-600 dark:text-red-300 border border-gray-300 rounded-md py-2 px-3 placeholder-gray-400 outline-none focus:outline-none resizable-textarea json-data dark:bg-gray-700 dark:placeholder-gray-400">{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
                    @endforeach
                </div>
            </div>
            @can('change on page')
            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded-lg mt-4">Update Content</button>
            @endcan
        </form>
    </div>
</x-dash-btm-nav.customize-content>
