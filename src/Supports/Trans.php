<?php

namespace Phpno1\Dictionaries\Supports;


trait Trans
{

    /**
     * find data key value mapping dictionary to string.
     *
     * @param string $fields
     * @param string $separator
     * @return string
     */
    public function mapping(string $fields, string $separator = ',') :string
    {
        if (object_get($this, $fields)) {
            return implode(",", $this->getDictionaries($fields, $separator));
        }
        return "";
    }

    /**
     * find data key value mapping dictionary to array.
     *
     * @param string $fields
     * @param string $separator
     * @return array
     */
    public function mappingArray(string $fields, string $separator = ',') :array
    {
        if (object_get($this, $fields)) {
            return $this->getDictionaries($fields, $separator);
        }
        return "";
    }

    /**
     * get object key value format array
     *
     * @param string $fields
     * @param string $separator
     * @return array
     */
    protected function getDictionaries(string $fields, string $separator = ',') :array
    {
        return array_only(config('dictionaries.' . $fields), str_key_array($this, $fields, $separator));
    }
}