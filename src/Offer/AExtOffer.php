<?php

namespace LireinCore\YMLParser\Offer;

use LireinCore\YMLParser\DeliveryOption;

abstract class AExtOffer extends AOffer
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
     * Attribute is deprecated
     * @var int
     */
    protected $localDeliveryCost;

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
    protected $downloadable;

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
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //attributes
            'fee',
            //subnodes
            'market_category', 'delivery-options', 'local_delivery_cost', 'manufacturer_warranty', 'adult', 'age', 'downloadable'
        ]);
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    public function setAttribute(array $attrNode)
    {
        if ($attrNode['name'] == 'delivery-options') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addDeliveryOption((new DeliveryOption())->setAttributes($subNode['attributes']));
            }
        }
        else {
            /*if ($attrNode['name'] == 'age') {
                if (isset($attrNode['attributes']['unit'])) $this->setField('unit', $attrNode['attributes']['unit']);
            }*/

            parent::setAttribute($attrNode);
        }

        return $this;
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
     * @return int
     */
    public function getLocalDeliveryCost()
    {
        return $this->localDeliveryCost;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setLocalDeliveryCost($value)
    {
        $this->localDeliveryCost = (int)$value;

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
}