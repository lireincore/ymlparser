<?php

namespace LireinCore\YMLParser\Offer;

use \LireinCore\YMLParser\TYML;
use \LireinCore\YMLParser\TError;

class Age
{
    use TYML;
    use TError;

    /**
     * @var string
     */
    protected $unit;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->unit === null){
            $this->addError("Age: missing required attribute 'unit'");
        } elseif ($this->unit !== 'year' && $this->unit !== 'month') {
            $this->addError("Age: incorrect value in attribute 'unit'");
        }

        if ($this->unit === 'year' && !in_array((string)$this->value, ['0', '6', '12', '16', '18'],true)){
            $this->addError('Age: incorrect value');
        } elseif ($this->unit === 'month' && !in_array((string)$this->value, ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],true)){
            $this->addError('Age: incorrect value');
        }


        return empty($this->errors);
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function addAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->addField($name, $value);
        }

        return $this;
    }

    /**
     * @return string|null
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
        $this->unit = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getValue()
    {
        return $this->value === null ? null : (int)$this->value;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}