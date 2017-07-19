<?php

namespace LireinCore\YMLParser\Offer;

use LireinCore\YMLParser\DeliveryOption;

abstract class AExtOffer extends AOffer
{
    /**
     * @var string
     */
    protected $fee;

    /**
     * @var string
     */
    protected $marketCategory;

    /**
     * Attribute is deprecated
     * @var string
     */
    protected $localDeliveryCost;

    /**
     * @var DeliveryOption[]
     */
    protected $deliveryOptions = [];

    /**
     * @var string
     */
    protected $manufacturerWarranty;

    /**
     * @var string
     */
    protected $downloadable;

    /**
     * @var string
     */
    protected $adult;

    /**
     * @var Age
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
            //subNodes
            'market_category', 'delivery-options', 'local_delivery_cost', 'manufacturer_warranty', 'adult', 'age', 'downloadable'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->fee !== null && (!is_numeric($this->fee) || (int)$this->fee <= 0)) {
            $this->addError("Offer: incorrect value in attribute 'fee'");
        }
        if ($this->localDeliveryCost !== null && (!is_numeric($this->localDeliveryCost) || ((int)$this->localDeliveryCost) < 0)) {
            $this->addError("Offer: incorrect value in attribute 'local_delivery_cost'");
        }
        if ($this->delivery === true && !$this->deliveryOptions && $this->localDeliveryCost == null) {
            $this->addError("Offer: attribute 'delivery-options' is required when 'delivery' is true");
        }
        if ($this->manufacturerWarranty !== null && $this->manufacturerWarranty !== 'true' && $this->manufacturerWarranty !== 'false') {
            $this->addError("Offer: incorrect value in attribute 'manufacturer_warranty'");
        }
        if ($this->downloadable !== null && $this->downloadable !== 'true' && $this->downloadable !== 'false') {
            $this->addError("Offer: incorrect value in attribute 'downloadable'");
        }
        if ($this->adult !== null && $this->adult !== 'true' && $this->adult !== 'false') {
            $this->addError("Offer: incorrect value in attribute 'adult'");
        }
        $subIsValid = true;
        if ($this->deliveryOptions) {
            foreach ($this->deliveryOptions as $deliveryOption) {
                if (!$deliveryOption->isValid()) {
                    $subIsValid = false;
                }
            }
        }
        if ($this->age && !$this->age->isValid()) {
            $subIsValid = false;
        }
        return $isValid && empty($this->errors) && $subIsValid;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors[] = parent::getErrors();

        if ($this->deliveryOptions) {
            foreach ($this->deliveryOptions as $deliveryOption) {
                $errors[] = $deliveryOption->getErrors();
            }
        }
        if ($this->age) {
            $errors[] = $this->age->getErrors();
        }

        return 1 !== count($errors) ? call_user_func_array('array_merge', $errors) : $errors[0];
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    public function addAttribute(array $attrNode)
    {
        if ($attrNode['name'] === 'delivery-options') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addDeliveryOption((new DeliveryOption())->addAttributes($subNode['attributes']));
            }
        } elseif ($attrNode['name'] === 'age') {
            $this->setAge((new Age())->addAttributes($attrNode['attributes'] + ['value' => $attrNode['value']]));
        } else {
            parent::addAttribute($attrNode);
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFee()
    {
        return $this->fee === null ? null : (int)$this->fee;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFee($value)
    {
        $this->fee = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->marketCategory = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getLocalDeliveryCost()
    {
        return $this->localDeliveryCost === null ? null : (int)$this->localDeliveryCost;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setLocalDeliveryCost($value)
    {
        $this->localDeliveryCost = $value;

        return $this;
    }

    /**
     * @return DeliveryOption[]|null
     */
    public function getDeliveryOptions()
    {
        return $this->deliveryOptions ?: null;
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
     * @return bool|null
     */
    public function getManufacturerWarranty()
    {
        $result = $this->manufacturerWarranty === null ? null : ($this->manufacturerWarranty === 'false' ? false : (bool)$this->manufacturerWarranty);

        return $result;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setManufacturerWarranty($value)
    {
        $this->manufacturerWarranty = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDownloadable()
    {
        return $this->downloadable === null ? null : ($this->downloadable === 'false' ? false : (bool)$this->downloadable);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDownloadable($value)
    {
        $this->downloadable = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAdult()
    {
        return $this->adult === null ? null : ($this->adult === 'false' ? false : (bool)$this->adult);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAdult($value)
    {
        $this->adult = $value;

        return $this;
    }

    /**
     * @return Age|null
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param Age $value
     * @return $this
     */
    public function setAge(Age $value)
    {
        $this->age = $value;

        return $this;
    }
}