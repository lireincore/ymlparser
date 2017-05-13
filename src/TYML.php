<?php

namespace LireinCore\YMLParser;

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
                    if ($getValue !== null) $array[$key] = $getValue;
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
        $subarray = [];

        foreach ($value as $subkey => $subvalue) {
            if (is_object($subvalue) && method_exists($subvalue, 'getData')) {
                $subarray[$subkey] = $subvalue->getData();
            } elseif (is_array($subvalue)) {
                $subarray[$subkey] = $this->getArray($subvalue);
            } else {
                $getter = 'get' . $subkey;
                if (method_exists($this, $getter)) {
                    $getValue = $this->$getter();
                    if ($getValue !== null) $subarray[$subkey] = $getValue;
                } elseif ($subvalue !== null) {
                    $subarray[$subkey] = $subvalue;
                }
            }
        }

        return $subarray;
    }
}