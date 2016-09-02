<?php

namespace LireinCore\YMLParser\Offer;

use LireinCore\YMLParser\DeliveryOption;

abstract class ABaseOffer extends AOffer
{
    /**
     * @var int
     */
    protected $fee;

    /**
     * @var string
     */
    protected $marketCategory;

    /**
     * @var DeliveryOption[]
     */
    protected $deliveryOptions = [];

    /**
     * @var bool
     */
    protected $manufacturerWarranty;

    /**
     * @var bool
     */
    protected $adult;

    /**
     * age[unit]
     * @var string
     */
    protected $unit;

    /**
     * @var int
     */
    protected $age;

    /**
     * @var bool
     */
    protected $downloadable;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), ['fee']);
    }

    /**
     * @return array
     */
    public function getFiledsList()
    {
        return array_merge(parent::getFiledsList(), [
            'market_category', 'delivery-options', 'manufacturer_warranty', 'adult', 'age', 'downloadable'
        ]);
    }

    /**
     * @return int
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setFee($value)
    {
        $this->fee = (int)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getMarketCategory()
    {
        return $this->marketCategory;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMarketCategory($value)
    {
        $this->marketCategory = (string)$value;

        return $this;
    }

    /**
     * @return DeliveryOption[]
     */
    public function getDeliveryOptions()
    {
        return $this->deliveryOptions;
    }

    /**
     * @param DeliveryOption[] $value
     * @return $this
     */
    public function setDeliveryOptions(array $value)
    {
        foreach ($value as $deliveryOption) {
            $this->addDeliveryOption($deliveryOption);
        }

        return $this;
    }

    /**
     * @param DeliveryOption $value
     * @return $this
     */
    public function addDeliveryOption(DeliveryOption $value)
    {
        $this->deliveryOptions[] = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getManufacturerWarranty()
    {
        return $this->manufacturerWarranty;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setManufacturerWarranty($value)
    {
        $this->manufacturerWarranty = $value === 'false' ? false : (bool)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAdult()
    {
        return $this->adult;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setAdult($value)
    {
        $this->adult = $value === 'false' ? false : (bool)$value;

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
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setAge($value)
    {
        $this->age = (int)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDownloadable()
    {
        return $this->downloadable;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setDownloadable($value)
    {
        $this->downloadable = $value === 'false' ? false : (bool)$value;

        return $this;
    }
}