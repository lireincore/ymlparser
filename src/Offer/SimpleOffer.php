<?php

namespace LireinCore\YMLParser\Offer;

class SimpleOffer extends AMainOffer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'name'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->name === null)
            $this->addError("Offer: missing required attribute 'name'");

        return $isValid && empty($this->errors);
    }

    /**
     * @return string|null
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
        $this->name = $value;

        return $this;
    }
}