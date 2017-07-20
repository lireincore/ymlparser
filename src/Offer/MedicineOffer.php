<?php

namespace LireinCore\YMLParser\Offer;

class MedicineOffer extends AOffer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $vendorCode;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subNodes
            'name', 'vendor', 'vendorCode'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->name === null){
            $this->addError("Offer: missing required attribute 'name'");
        }

        if ($this->delivery === null){
            $this->addError("Offer: missing required attribute 'delivery'");
        } elseif ($this->delivery !== 'false'){
            $this->addError("Offer: incorrect value in attribute 'delivery'");
        }

        if ($this->pickup === null){
            $this->addError("Offer: missing required attribute 'pickup'");
        } elseif ($this->pickup !== 'true'){
            $this->addError("Offer: incorrect value in attribute 'pickup'");
        }

        if ($this->cpa !== null && $this->cpa !== '0'){
            $this->addError("Offer: incorrect value in attribute 'cpa'");
        }

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

    /**
     * @return string|null
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVendor($value)
    {
        $this->vendor = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getVendorCode()
    {
        return $this->vendorCode;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVendorCode($value)
    {
        $this->vendorCode = $value;

        return $this;
    }
}