<?php

namespace Phpno1\Dictionaries\Supports;

trait Trans
{

    /**
     * find data dictionary trans form.
     *
     * @param string $fields
     * @param string $separator
     * @return string
     */
    public function tagTrans(string $fields, string $separator = ',') :string
    {
        if (object_get($this, $fields)) {
            return implode(",",$this->getValueArray($fields, $separator));
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
    protected function getValueArray(string $fields, string $separator = ',') :array
    {
        $dictionKeys = $this->{$fields};
        $record = is_array($dictionKeys) ? $dictionKeys : explode($separator, $dictionKeys);
        return array_only(config('dictionaries.' . $fields), $record);
    }

    /**
     * data all dictionary trans form.
     * @param string $fields
     * @param string $dictionary
     * @param string $separator
     */
    public function tagsTrans(string $fields, string $dictionary, string $separator = ',')
    {
        if(!empty($this->getCollection())){

        }
    }
}