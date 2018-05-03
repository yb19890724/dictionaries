<?php


if (!function_exists("str_key_array")) {
    /**
     * data key value to array
     *
     * @param $data
     * @param string $fields
     * @param string $separator
     * @return array
     */
    function str_key_array($data, string $fields, string $separator = ',') :array
    {
        if (isset($data[$fields])) {
            return is_array($data[$fields]) ? $data[$fields] : explode($separator, $data[$fields]);
        }
        return [];
    }
}
