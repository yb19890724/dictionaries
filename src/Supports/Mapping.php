<?php

namespace Phpno1\Dictionaries\Supports;

/**
 * data dictionary mapping
 */

trait Mapping
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
            return implode(",", $this->getDictionary($fields, $separator));
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
            return $this->getDictionary($fields, $separator);
        }
        return [];
    }

    /**
     * get object key value format array
     *
     * @param string $fields
     * @param string $separator
     * @return array
     */
    protected function getDictionary(string $fields, string $separator = ',') :array
    {
        return array_only(config('dictionaries.' . $fields), str_key_array($this, $fields, $separator));
    }

    /**
     *
     * @param array $fields
     * @param string $separator
     */
    private function getDictionaries(array $fields, string $separator = ',', string $format = 'string')
    {
        $dictionaries = array_only(config('dictionaries'), $fields);
        if (!empty($dictionaries)) {
            foreach ($fields as $item) {
                $dictionary = array_only($dictionaries[$item], str_key_array($this, $item, $separator));
                $this->{$item . '_' . $this->setLabel()} = $this->dictionaryFormat($dictionary, $format);
            }
        }
        return $this;
    }

    /**
     * set label title
     *
     * @return string
     */
    private function setLabel() :string
    {
        return config('dictionaries.label');
    }

    /**
     * dictionary format
     * @param array $params
     * @param string $separator
     * @param string $format
     * @return array|string
     */
    private function dictionaryFormat(array $params, string $format)
    {
        if ($format == "string") {
            return implode(",", $params);
        }
        return $params;
    }


    /**
     * data key value mapping dictionary to string.
     *
     * @param array $fields
     * @param array $separator
     */
    public function mappings(array $fields, string $separator = ',')
    {
        if (array_only($this->toArray(), $fields)) {
            $this->getDictionaries($fields, $separator, 'string');
        }
        return $this;
    }

    /**
     * data key value mapping dictionary to array.
     *
     * @param array $fields
     * @param string $separator
     * @return $this
     */
    public function mappingsArray(array $fields, string $separator = ',')
    {
        if (array_only($this->toArray(), $fields)) {
            $this->getDictionaries($fields, $separator, 'array');
        }
        return $this;
    }

}