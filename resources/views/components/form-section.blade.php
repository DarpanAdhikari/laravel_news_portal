@props(['submit'])

<div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}>

    <div class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit="{{ $submit }}">
            <div class="px-4 py-5 bg-white sm:p-6 shadow dark:bg-gray-800 dark:text-gray-400">
                <div class="grid grid-cols-6 gap-6">
                    {{ $form }}
                </div>
            </div>

            @if (isset($actions))
                <div class="flex items-center justify-between px-4 py-3 bg-gray-200 text-end sm:px-6 shadow dark:bg-gray-900">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
