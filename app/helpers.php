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
