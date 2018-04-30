<?php

/**
 * object key is string
 * @param $data
 * @param $key
 * @return bool
 */
if (function_exists('object_key_string')) {
    function object_key_string($data, $key)
    {
        return !empty(isset($data->{$key}) && is_string($data->{$key})) ? true : false;
    }
}