<?php
function stringToNum(string $str, string $allowedSeparators = ",.")
{
    $convertedStr = $str;
    foreach ($allowedSeparators as $separator) {
        $convertedStr= str_replace($convertedStr, $separator, '.');
    }
    if (!is_numeric($convertedStr)) {
        throw new ParseError('Cannot parse ' . $str . ' into number.');
    }
    return (float)$convertedStr;
}
