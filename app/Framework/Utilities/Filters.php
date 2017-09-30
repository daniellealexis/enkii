<?php

namespace App\Framework\Utilities;


use App\CommentFilter;


class Filters
{
    private const letter_subs = [
        'a' => '(?:a|a\.|a\-|4|@|Á|á|À|Â|à|Â|â|Ä|ä|Ã|ã|Å|å|α|Δ|Λ|λ)',
        'b' => '(?:b|b\.|b\-|8|\|3|ß|β|i3|13|l3)',
        'c' => '(?:c|c\.|c\-|Ç|ç|¢|€|<|\(|{|©|k)',
        'd' => '(?:d|d\.|d\-|&part,|\|\)|Þ|þ|Ð|ð)',
        'e' => '(?:e|e\.|e\-|3|€|È|è|É|é|Ê|ê|∑)',
        'f' => '(?:f|f\.|f\-|ƒ|ph)',
        'g' => '(?:g|g\.|g\-|6|9)',
        'h' => '(?:h|h\.|h\-)',
        'i' => '(?:i|i\.|i\-|!|\||\]\[|]|1|∫|Ì|Í|Î|Ï|ì|í|î|ï|l)',
        'j' => '(?:j|j\.|j\-)',
        'k' => '(?:k|k\.|k\-|κ|c)',
        'l' => '(?:l|1\.|l\-|!|\||\]\[|]|£|∫|Ì|Í|Î|Ï|1)',
        'm' => '(?:m|m\.|m\-)',
        'n' => '(?:n|n\.|n\-|η|Ν|Π)',
        'o' => '(?:o|o\.|o\-|0|Ο|ο|Φ|¤|°|ø)',
        'p' => '(?:p|p\.|p\-|ρ|Ρ|¶|þ)',
        'q' => '(?:q|q\.|q\-|9)',
        'r' => '(?:r|r\.|r\-|®)',
        's' => '(?:s|s\.|s\-|5|\$|§)',
        't' => '(?:t|t\.|t\-|τ|7)',
        'u' => '(?:u|u\.|u\-|υ|µ|v)',
        'v' => '(?:v|v\.|v\-|υ|ν|u)',
        'w' => '(?:w|w\.|w\-|ω|ψ|Ψ|vv)',
        'x' => '(?:x|x\.|x\-|χ)',
        'y' => '(?:y|y\.|y\-|¥|γ|ÿ|ý|Ÿ|Ý)',
        'z' => '(?:z|z\.|z\-|2)',
    ];

    public static function generateFilter($plainText)
    {
        $filter = str_ireplace(array_keys(Filters::letter_subs),
            array_values(Filters::letter_subs),
            $plainText);

        return "/\\b{$filter}\\b/i";
    }

    public static function runFilter($text)
    {
        static $filters = null;
        if ($filters == null)
            $filters = CommentFilter::pluck('filter')->all();

        $emojis = config('emojis');
        $indexCount = count($emojis) - 1;

        return preg_replace_callback($filters, function() use($indexCount, $emojis) {
            return $emojis[rand(0, $indexCount)];
        }, $text);
    }
}