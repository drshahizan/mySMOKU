<?php

function transformBracketsToUppercase($inputString) {
    return preg_replace_callback('/\((.*?)\)/', function($matches) {
        return strtoupper($matches[0]);
    }, $inputString);
}

function transformBracketsToCapital($inputString) {
    return preg_replace_callback('/\((.*?)\)/', function($matches) {
        $insideBrackets = ucwords(strtolower($matches[1])); // Convert text inside brackets to capital case
        return '(' . $insideBrackets . ')';
    }, $inputString);
}

function formatNamaPemohon($nama) {
    if (!$nama) {
        return '';
    }

    $conjunctionsLower = ['bin', 'binti'];
    $conjunctionsUpper = ['a/l', 'a/p'];

    $words = preg_split('/\s+/', strtolower(trim($nama)));

    return collect($words)->map(function ($word) use ($conjunctionsLower, $conjunctionsUpper) {
        if (in_array($word, $conjunctionsLower, true)) {
            return $word;
        }

        if (in_array($word, $conjunctionsUpper, true)) {
            return strtoupper($word);
        }

        if (str_starts_with($word, "'")) {
            return "'" . strtoupper(substr($word, 1, 1)) . substr($word, 2);
        }

        return strtoupper(substr($word, 0, 1)) . substr($word, 1);
    })->implode(' ');
}
