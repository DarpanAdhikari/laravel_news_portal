<x-dashboard-layout>
    @push('script')
        <script src="{{ asset('asset/tinymce/tinymce.min.js') }}"></script>
        <script>
            tinymce.init({
                selector: 'textarea#page-description-nepali',
                plugins: 'table fullscreen image link media',
                toolbar: 'undo redo | formatselect | bold italic underline forecolor table link image| alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | hr | media | spellchecker | fullscreen',
                spellchecker_language: 'en',
                images_upload_url: "{{ route('upload.image') }}",
                automatic_uploads: true,
                file_picker_types: 'image',
            });
        </script>
    @endpush
    <div class="container mx-auto px-4 py-8 w-full flex items-center justify-center">
        <div class="w-[90%]">
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 mb-8 h-fit">
                <h2 class="text-xl font-bold mb-4">नेपाली पोस्ट</h2>
                <form action="{{ url('post/nepalipost') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nepali-navigation" class="block text-sm font-bold text-gray-700 dark:text-gray-300"><i
                                class="text-red-700">*</i>Title
                            (नेपाली)</label>
                        <input type="text" name="title" value="{{old('title')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full focus-visible:border-none @error('title') focus:outline-red-500 border-red-500 @enderror"
                            placeholder="शीर्षक लेख्नुहोस्.." autofocus>
                            @error('title')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <label class="inline-flex items-center mb-5 cursor-pointer">
                        <span class="me-5 text-sm font-bold text-gray-900 dark:text-gray-300"><i
                                class="text-red-700">*</i>Already has post in english</span>
                        <input type="checkbox" value="" class="sr-only peer" id="switchSlug" @if (!$errors->any(['slug','feature_img'])) checked @endif>
                        <div
                            class="relative w-9 h-5 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after: after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                    </label>
                    <div class="mb-4 hidden" id="attached">
                        <label for="" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                class="text-red-700">*</i>English Post Link
                            (English)</label>
                        <input type="text" name="post_id" value="{{old('post_id')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full slug-field  focus-visible:border-none @error('post_id') focus:outline-red-500 border-red-500 @enderror"
                            placeholder="Paste post link/post slug (format:example-mine-post)">
                            @error('post_id')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <div class="mb-4" id="not-attached">
                        <label for="" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                class="text-red-700">*</i>Slug
                            (english)</label>
                        <input type="text" name="slug" value="{{old('slug')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full slug-field  focus-visible:border-none @error('slug') focus:outline-red-500 border-red-500 @enderror"
                            placeholder="(format:example-mine-post)/you can paste title too">
                            @error('slug')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <div class="mb-4" id="nepali-featureImg">
                        <label class="block mb-2 text-sm font-bold text-gray-900 dark:text-white" for="file_input"><i
                                class="text-red-700">*</i>Feature image</label>
                        <img class="image-preview max-h-44 shadow-md mb-3 rounded-lg" src="">
                        <input
                            class="block w-full text-sm text-gray-900 border  rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" name="feature_img" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">jpg,jpeg,png
                            (MAX. 1250x500px).</p>
                            @error('feature_img')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label for="" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                class="text-red-700">*</i>Keywords
                            (नेपाली)</label>
                        <input type="text" name="keywords" value="{{old('keywords')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full  focus-visible:border-none @error('keywords') focus:outline-red-500 border-red-500 @enderror"
                            placeholder="किवर्ड लेख्नुहोस्" >
                            @error('keywords')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label for="" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Tags
                            (नेपाली)</label>
                        <input type="text" name="tags" value="{{old('tags')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full"
                            placeholder="tags">
                            @error('tags')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label for="" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                class="text-red-700">*</i>Meta Description
                            (नेपाली)</label>
                        <input type="text" name="meta_description" value="{{old('meta_description')}}"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full  focus-visible:border-none @error('meta_description') focus:outline-red-500 border-red-500 @enderror"
                            placeholder="Meta Description">
                            @error('meta_description')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>
                    <hr>
                    <h2 class="font-bold"><i class="text-red-700">*</i>लेख्या बस्तुको क्षेत्र छान्नु होस्</h2>
                    <div class="mb-4 flex justify-around flex-wrap">
                        @php
                            $jsonData = json_decode(file_get_contents(base_path('lang/np.json')), true);
                            $mergedItems = array_merge(
                                $jsonData['categories'],
                                $jsonData['footerNav']['0'],
                                $jsonData['footerNav']['1'],
                                $jsonData['footerNav']['2'],
                                $jsonData['footerNav']['3'],
                            );
                            $uniqueItems = array_unique($mergedItems);
                        @endphp
                        <div class="select w-full">
                            <label for="nepali-navigation"
                                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                    class="text-red-700">*</i>Category
                                (English)</label>
                            <select
                                class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 focus-visible:border-none @error('category') focus:outline-red-500 border-red-500 @enderror"
                                name="category">
                                 <option value="">Select category</option>
                                @for ($i = 1; $i < count($jsonData['navigation']['name']); $i++)
                                    <option value="{{ $i }}" {{ old('category') == $i ? 'selected' : '' }}>{{ $jsonData['navigation']['name'][$i] }}
                                    </option>
                                @endfor
                            </select>
                            @error('category')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="select w-full">
                            <label for=""
                                class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Sub
                                categories</label>
                            <select
                                class="bg-gray-50 border  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500  focus-visible:border-none @error('sub_category') focus:outline-red-500 border-red-500 @enderror"
                                name="sub_category" >
                                 <option value="">Select sub-category</option>
                                 @foreach ($uniqueItems as $item)
                                    <option value="{{ $item }}" {{ old('sub_category') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                @endforeach
                            </select>
                            @error('sub_category')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="mb-4">
                        <label for="page-description-nepali"
                            class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2"><i
                                class="text-red-700">*</i>Content
                            (नेपाली)</label>
                            @error('content')
                            <span class="text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        <textarea id="page-description-nepali" name="content" rows="3"
                            class="border  dark:border-gray-600 rounded-md px-3 py-2 w-full"
                            placeholder="लेख्नुहोस्..">{{old('content')}}</textarea>
                    </div>
                    @error('status')
                    <span class="text-red-500">{{$message}}</span>
                    @enderror
                    <div class="flex gap-5 justify-between">
                        <button type="submit" name="status" value="1"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">Post</button>
                        <button type="submit" name="status" value="0"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">Draft</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-dash-btm-nav.upload-post />
</x-dashboard-layout>
