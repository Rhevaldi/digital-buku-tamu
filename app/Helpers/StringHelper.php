<?php

if (!function_exists('mask_identity')) {
    function mask_identity($value, $visibleStart = 4, $visibleEnd = 4)
    {
        if (!$value) return null;
        $len = strlen($value);
        if ($len <= $visibleStart + $visibleEnd) return $value;

        $start = substr($value, 0, $visibleStart);
        $end = substr($value, -$visibleEnd);
        $masked = str_repeat('*', $len - ($visibleStart + $visibleEnd));

        return $start . $masked . $end;
    }
}
