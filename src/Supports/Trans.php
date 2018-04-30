<?php

namespace Phpno1\Dictionaries\Supports;

trait Trans
{
    protected $string;
    protected $array;
    protected $collection;

    /**
     * find data dictionary trans form.
     *
     */
    public function tagTrans(string $fields, string $separator = ',') :string
    {
        if ($this->object_key_string($this,$fields)) {
            $value = array_only(config('dictionaries.' . $fields), explode($separator, $this->{$fields}));
            return is_array($value) ? implode($separator, $value) : "";
        }
        return "";
    }



    /**
     * data all dictionary trans form.
     *
     */
    public function tagsTrans(string $fields, string $dictionary, string $separator = ',')
    {

    }
}