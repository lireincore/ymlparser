<?php

namespace LireinCore\YMLParser\Offer;

class VendorModelOffer extends AMainOffer
{
    /**
     * @var string
     */
    protected $typePrefix;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subNodes
            'typePrefix'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->model === null){
            $this->addError("Offer: missing required attribute 'model'");
        }
        if ($this->vendor === null){
            $this->addError("Offer: missing required attribute 'vendor'");
        }

        return $isValid && empty($this->errors);
    }

    /**
     * @return string|null
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
        $this->typePrefix = $value;

        return $this;
    }
}