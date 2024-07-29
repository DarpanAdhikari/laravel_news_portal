<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('slug_format', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value);
        });

        Validator::extend('np_sub_category', function ($attribute, $value, $parameters, $validator) {
            $jsonData = json_decode(file_get_contents(base_path('lang/np.json')), true);
            $mergedItems = array_merge(
                $jsonData['categories'],
                $jsonData['footerNav']['0'],
                $jsonData['footerNav']['1'],
                $jsonData['footerNav']['2'],
                $jsonData['footerNav']['3']
            );
            $uniqueItems = array_unique($mergedItems);
            return in_array($value, $uniqueItems);
        });
        Validator::extend('en_sub_category', function ($attribute, $value, $parameters, $validator) {
            $jsonData = json_decode(file_get_contents(base_path('lang/en.json')), true);
            $mergedItems = array_merge(
                $jsonData['categories'],
                $jsonData['footerNav']['0'],
                $jsonData['footerNav']['1'],
                $jsonData['footerNav']['2'],
                $jsonData['footerNav']['3']
            );
            $uniqueItems = array_unique($mergedItems);
            return in_array($value, $uniqueItems);
        });

        Validator::extend('english_only', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*$/', $value);
        });    

        Validator::extend('max_words', function ($attribute, $value, $parameters, $validator) {
            $maxWords = $parameters[0] ?? 0; // Default to 0 if $parameters[0] is null
            $words = preg_split('/\s+/u', $value, -1, PREG_SPLIT_NO_EMPTY); // Use -1 instead of null
            if (count($words) <= $maxWords) {
                return true;
            } else {
                $validator->errors()->add($attribute, "The $attribute must not exceed {$maxWords} words.");
                return false;
            }
        });

        Str::macro('shortNumber', function ($value) {
            $abbreviations = [
                12 => 'T',
                9 => 'B',
                6 => 'M',
                3 => 'K',
                0 => '',
            ];
        
            foreach ($abbreviations as $factor => $abbreviation) {
                if ($value >= pow(10, $factor)) {
                    return round($value / pow(10, $factor), 1) . $abbreviation;
                }
            }
        
            return $value;
        });
    }
}
