<x-dashboard-layout>
    <div class="mb-4">
        <tt class="text-xl font-bold">Test CSS</tt>
    </div>
    {{-- make element for testing --}}
    <div class="flex w-full relative">
        <div contenteditable="true"
            class="mb-4 min-h-10 w-full bg-gray-50 border-2 border-gray-300 font-mono outline-none rounded-lg flex justify-start items-start"
            id="custom-element">
            // Create or paste Custom HTML Element here
        </div>
        <button
            class="bg-blue-500 text-white h-max px-4 py-2 hover:bg-blue-600 focus:outline-none focus:bg-blue-600 rounded-full absolute top-0 right-0"
            id="addElementBtn"><i class="fas fa-plus"></i></button>
    </div>
    Note: click on element to delete them
    <div class="p-5 mb-4 min-h-10 bg-blue-300 rounded-xl flex flex-col gap-2" id="elements"></div>
    <!-- CSS Code Editor -->
    <div class="relative">
        <div id="editor" contenteditable="true"
            class="mb-4 min-h-48 bg-gray-50 border-2 border-gray-300 font-mono outline-none rounded-lg px-5 flex justify-start items-start">
            <style contenteditable class="block h-full">
                /* check css here */
            </style>
        </div>
        <button
            class="absolute right-0 top-5 -translate-y-1/2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 inline-flex items-center justify-center"
            id="copy-code">
            <span id="default-icon">
                <svg class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 18 20">
                    <path
                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z" />
                </svg>
            </span>
        </button>
    </div>
    <button type="button" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" data-modal-target="open-css-code" data-modal-toggle="open-css-code">Ready to Change</button>

    <div id="open-css-code" class="absolute top-0 left-0 w-full h-[90vh] bg-white z-50 hidden" tabindex="-1" aria-hidden="true">
        <div class="w-full h-full flex justify-center items-center">
            <div class="bg-gray-100 rounded-lg p-8 w-full h-full mt-16">
                <h2 class="text-2xl mb-2 font-semibold">Change/Add Css</h2>
                <form action="{{route('customize.style.upload')}}" method="POST" class="space-y-4 h-full flex flex-col">
                    @csrf
                    <div class="flex-1">
                        <label for="message" class="block">Css Code Here</label>
                        <textarea id="message" name="css_content" class="form-textarea resizable-textarea w-full h-full rounded border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 resize-none" oninput="autoResize(this)">{{$css_content}}</textarea>
                    </div>
                    <div class="flex justify-around">
                        <button type="submit" class="w-max p-3 bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Submit</button>
                    <button type="button" class="w-max p-3 bg-red-500 text-white py-2 rounded hover:bg-red-600" data-modal-hide="open-css-code">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard-layout>
