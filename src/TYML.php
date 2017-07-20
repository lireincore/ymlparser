<?php

namespace LireinCore\YMLParser;

/**
 * Trait TYML
 * @package LireinCore\YMLParser
 */
trait TYML
{
    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    protected function addField($name, $value)
    {
        $setter = 'set' . str_replace(['-', '_'], '', $name);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        }

        return $this;
    }

    /**
     * @return array
     */
    protected function toArray()
    {
        $array = [];

        foreach ($this as $key => $value) {
            if (is_object($value) && method_exists($value, 'getData')) {
                $array[$key] = $value->getData();
            } elseif (is_array($value)) {
                if (!empty($value)) {
                    $array[$key] = $this->getArray($value);
                }
            } else {
                $getter = 'get' . $key;
                if (method_exists($this, $getter)) {
                    $getValue = $this->$getter();
                    if ($getValue !== null) {
                        $array[$key] = $getValue;
                    }
                } elseif ($value !== null) {
                    $array[$key] = $value;
                }
            }
        }

        return $array;
    }

    /**
     * @param array $value
     * @return array
     */
    protected function getArray($value)
    {
        $subArray = [];

        foreach ($value as $subKey => $subValue) {
            if (is_object($subValue) && method_exists($subValue, 'getData')) {
                $subArray[$subKey] = $subValue->getData();
            } elseif (is_array($subValue)) {
                $subArray[$subKey] = $this->getArray($subValue);
            } else {
                $getter = 'get' . $subKey;
                if (method_exists($this, $getter)) {
                    $getValue = $this->$getter();
                    if ($getValue !== null) {
                        $subArray[$subKey] = $getValue;
                    }
                } elseif ($subValue !== null) {
                    $subArray[$subKey] = $subValue;
                }
            }
        }

        return $subArray;
    }
}