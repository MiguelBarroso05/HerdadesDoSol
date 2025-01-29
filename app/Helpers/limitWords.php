<?php

use Illuminate\Support\Str;

if (!function_exists('limit_word')){
    function limit_word($word, $limit, $preserveWords): \Illuminate\Support\Stringable
    {
        return Str::of($word)->limit($limit, preserveWords: $preserveWords);
    }
}
