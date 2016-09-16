<?php
namespace LireinCore\YMLParser;

trait TYML
{
    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setField($name, $value)
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
    public function getData()
    {
        $array = [];

        foreach ($this as $key => $value) {
            if (!is_null($value)) {
                if (is_object($value) && method_exists($value, 'getData')) {
                    $array[$key] = $value->getData();
                }
                elseif (is_array($value)) {
                    if (!empty($value)) {
                        $array[$key] = $this->getArray($value);
                    }
                }
                else {
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
    private function getArray($value)
    {
        $subarray = [];

        foreach ($value as $subkey => $subvalue) {
            if (is_object($subvalue) && method_exists($subvalue, 'getData')) {
                $subarray[$subkey] = $subvalue->getData();
            }
            elseif (is_array($subvalue)) {
                $subarray[$subkey] = $this->getArray($subvalue);
            }
            else {
                $subarray[$subkey] = $subvalue;
            }
        }

        return $subarray;
    }
}