<?php

namespace LireinCore\YMLParser\Offer;

class VendorModelOffer extends AMainOffer
{
    /**
     * @var string
     */
    protected $typePrefix;

    /**
     * @return string
     */
    public function getTypePrefix()
    {
        return $this->typePrefix;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTypePrefix($value)
    {
        $this->typePrefix = (string)$value;

        return $this;
    }
}