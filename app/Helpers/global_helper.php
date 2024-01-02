<?php

use Illuminate\Support\Str;

/** Create Unique SLUG*/
if (!function_exists('generateUniqueSlug')){
    function generateUniqueSlug($model, $name) : string
    {
        $modelClass = "App\\Models\\$model";
        if (!class_exists($modelClass)){
            throw new \InvalidArgumentException("Model $model Not Found.");
        }

        $slug = Str::slug($name);
        $count = 2;
        while($modelClass::where('slug', $slug)->exists()){
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }
        return $slug;
    }
}

if (!function_exists('replaceSpace')){
    function  replaceSpace($str) : string
    {
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ');
        $replace = array('c','c','g','g','i','I','O','o','S','s','U','u','');
        $str = str_replace($search,$replace,$str);
        return trim(strtolower($str));
    }

}

if (!function_exists('currencyPosition')){
    function currencyPosition($price) : string
    {
        if (config('settings.site_currency_icon_position') === 'left'){
            return config('settings.site_currency_icon') . $price;
        }else{
            return  $price . config('settings.site_currency_icon');
        }
    }
}
