<?php
/**
 * @param string $str
 * @param string $allowedSeparators
 * @return float
 */
function stringToNum($str, $allowedSeparators = ",.")
{
    if ($str === "") {
        throw new ParseError('Cannot parse empty string into number.');
    }
    $convertedStr = $str;
    foreach (str_split($allowedSeparators) as $separator) {
        $convertedStr = str_replace($separator, '.', $convertedStr);
    }
    if (!is_numeric($convertedStr)) {
        throw new ParseError('Cannot parse "' . $str . '" into number.');
    }
    return (float)$convertedStr;
}
