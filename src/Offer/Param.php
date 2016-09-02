<?php

namespace LireinCore\YMLParser\Offer;

class Param
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @var string
     */
    protected $value;

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $setter = 'set' . str_replace(['-', '_'], '', $name);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setName($value)
    {
        $this->name = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUnit($value)
    {
        $this->unit = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = (string)$value;

        return $this;
    }
}