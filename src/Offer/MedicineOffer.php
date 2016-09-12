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
     * @var bool
     */
    protected $delivery = false;

    /**
     * @var bool
     */
    protected $pickup = true;

    /**
     * @var int
     */
    protected $cpa = 0;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'name', 'vendor', 'vendorCode'
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

    /**
     * @return string
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
        $this->vendor = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->vendorCode = (string)$value;

        return $this;
    }
}