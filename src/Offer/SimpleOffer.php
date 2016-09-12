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
}