<?php

namespace LireinCore\YMLParser\Offer;

use \LireinCore\YMLParser\TYML;
use \LireinCore\YMLParser\TError;

abstract class AOffer
{

    use TYML;
    use TError;

    const DEFAULT_CPA = 1;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $bid;

    /**
     * @var string
     */
    protected $cbid;

    /**
     * @var string
     */
    protected $available;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $price;

    /**
     * @var string
     */
    protected $oldprice;

    /**
     * @var string
     */
    protected $vat;

    /**
     * @var string
     */
    protected $currencyId;

    /**
     * @var string
     */
    protected $categoryId;

    /**
     * @var string[]
     */
    protected $pictures = [];

    /**
     * @var string
     */
    protected $store;

    /**
     * @var string
     */
    protected $pickup;

    /**
     * @var string
     */
    protected $delivery;

    /**
     * @var Outlet[]
     */
    protected $outlets = [];

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $salesNotes;

    /**
     * @var string
     */
    protected $countryOfOrigin;

    /**
     * @var string[]
     */
    protected $barcodes = [];

    /**
     * @var string
     */
    protected $cpa;

    /**
     * @var string
     */
    protected $expiry;

    /**
     * @var string
     */
    protected $weight;

    /**
     * @var string
     */
    protected $dimensions;

    /**
     * @var Param[]
     */
    protected $params = [];

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return [
            //attributes
            'id', 'cbid', 'bid', 'available', //type,
            //subNodes
            'price', 'oldprice', 'vat', 'currencyId', 'categoryId', 'picture', 'delivery',
            'pickup', 'store', 'outlets', 'description', 'sales_notes', 'country_of_origin',
            'barcode', 'cpa', 'param', 'expiry', 'weight', 'dimensions'
        ];
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->id === null) {
            $this->addError("Offer: missing required attribute 'id'");
        } elseif (!$this->id) {
            $this->addError("Offer: incorrect value in attribute 'id'");
        }

        if ($this->bid !== null && (!is_numeric($this->bid) || (int)$this->bid <= 0)) {
            $this->addError("Offer: incorrect value in attribute 'bid'");
        }

        if ($this->cbid !== null && (!is_numeric($this->cbid) || (int)$this->cbid <= 0)) {
            $this->addError("Offer: incorrect value in attribute 'cbid'");
        }

        if ($this->available === null) {
            if ($this->getPickup()) {
                $this->addError("Offer: attribute 'available' is required when 'pickup' is true");
            }
        } elseif ($this->available !== 'true' && $this->available !== 'false') {
            $this->addError("Offer: incorrect value in attribute 'available'");
        }

        if ($this->price === null) {
            $this->addError("Offer: missing required attribute 'price'");
        } elseif (!is_numeric($this->price) || (float)$this->price <= 0) {
            $this->addError("Offer: incorrect value in attribute 'price'");
        }

        if ($this->oldprice !== null && (!is_numeric($this->oldprice) || (float)$this->oldprice <= (float)$this->price)) {
            $this->addError("Offer: incorrect value in attribute 'oldprice'");
        }

        if ($this->vat !== null && !in_array($this->vat, [
                '1', '2', '3', '4', '5', '6', 'VAT_18', 'VAT_18_118', 'VAT_10', 'VAT_10_110', 'VAT_0', 'NO_VAT'
            ], true))
        {
            $this->addError("Offer: incorrect value in attribute 'vat'");
        }

        if ($this->currencyId === null) {
            $this->addError("Offer: missing required attribute 'currencyId'");
        } elseif (!$this->currencyId) {
            $this->addError("Offer: incorrect value in attribute 'currencyId'");
        }

        if ($this->categoryId === null) {
            $this->addError("Offer: missing required attribute 'categoryId'");
        } elseif (!$this->categoryId) {
            $this->addError("Offer: incorrect value in attribute 'categoryId'");
        }

        if ($this->store !== null && !$this->isValidBoolean($this->store)) {
            $this->addError("Offer: incorrect value in attribute 'store'");
        }

        if ($this->pickup !== null && !$this->isValidBoolean($this->pickup)) {
            $this->addError("Offer: incorrect value in attribute 'pickup'");
        }

        if ($this->delivery !== null && !$this->isValidBoolean($this->delivery)) {
            $this->addError("Offer: incorrect value in attribute 'delivery'");
        }

        if ($this->weight !== null && (!is_numeric($this->weight) || (float)$this->weight <= 0)) {
            $this->addError("Offer: incorrect value in attribute 'weight'");
        }

        $subIsValid = true;
        if ($this->outlets) {
            foreach ($this->outlets as $outlet) {
                if (!$outlet->isValid()) {
                    $subIsValid = false;
                }
            }
        }
        if ($this->params) {
            foreach ($this->params as $param) {
                if (!$param->isValid()) {
                    $subIsValid = false;
                }
            }
        }

        return empty($this->errors) && $subIsValid;
    }

    private function isValidBoolean($attribute)
    {
        $lc_attr = lcfirst($attribute);
        return $lc_attr === 'true' || $lc_attr === 'false';
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors[] = $this->errors;

        if ($this->outlets) {
            foreach ($this->outlets as $outlet) {
                $errors[] = $outlet->getErrors();
            }
        }
        if ($this->params) {
            foreach ($this->params as $param) {
                $errors[] = $param->getErrors();
            }
        }

        return 1 === count($errors) ? $errors[0] : call_user_func_array('array_merge', $errors);
    }

    /**
     * @param array $offerNode
     * @return $this
     */
    public function fillOffer(array $offerNode)
    {
        foreach ($offerNode['attributes'] as $name => $value) {
            $this->addField($name, $value);
        }

        foreach ($offerNode['nodes'] as $attrNode) {
            $this->addAttribute($attrNode);
        }

        return $this;
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    public function addAttribute(array $attrNode)
    {
        if ($attrNode['name'] === 'outlets') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addOutlet((new Outlet())->addAttributes($subNode['attributes']));
            }
        } elseif ($attrNode['name'] === 'picture') {
            $this->addPicture($attrNode['value']);
        } elseif ($attrNode['name'] === 'barcode') {
            $this->addBarcode($attrNode['value']);
        } elseif ($attrNode['name'] === 'param') {
            $this->addParam((new Param())->addAttributes($attrNode['attributes'] + ['value' => $attrNode['value']]));
        } else {
            if (!is_null($attrNode['value'])) {
                $this->addField($attrNode['name'], $attrNode['value']);
            }
            if (!empty($attrNode['attributes'])) {
                foreach ($attrNode['attributes'] as $name => $value) {
                    $this->addField($name, $value);
                }
            }
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getBid()
    {
        return $this->bid === null ? null : (int)$this->bid;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setBid($value)
    {
        $this->bid = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCbid()
    {
        return $this->cbid === null ? null : (int)$this->cbid;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCbid($value)
    {
        $this->cbid = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getAvailable()
    {
        return $this->available === null ? null : ($this->available === 'false' ? false : (bool)$this->available);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAvailable($value)
    {
        $this->available = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setUrl($value)
    {
        $this->url = $value;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice()
    {
        return $this->price === null ? null : (float)$this->price;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPrice($value)
    {
        $this->price = $value;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getOldprice()
    {
        return $this->oldprice === null ? null : (float)$this->oldprice;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOldprice($value)
    {
        $this->oldprice = $value;

        return $this;
    }

    /**
     * @return int|string|null
     */
    public function getVat()
    {
        return is_numeric($this->vat) ? (int)$this->vat : $this->vat;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVat($value)
    {
        $this->vat = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCurrencyId($value)
    {
        $this->currencyId = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCategoryId()
    {
        return $this->categoryId === null ? null : (int)$this->categoryId;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCategoryId($value)
    {
        $this->categoryId = $value;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getPictures()
    {
        return $this->pictures ?: null;
    }

    /**
     * @param string[] $value
     * @return $this
     */
    public function setPictures(array $value)
    {
        foreach ($value as $picture) {
            $this->addPicture($picture);
        }

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function addPicture($value)
    {
        $this->pictures[] = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getStore()
    {
        return $this->store === null ? null : ($this->store === 'false' ? false : (bool)$this->store);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setStore($value)
    {
        $this->store = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getPickup()
    {
        return $this->pickup === null ? null : ($this->pickup === 'false' ? false : (bool)$this->pickup);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPickup($value)
    {
        $this->pickup = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getDelivery()
    {
        return $this->delivery === null ? null : ($this->delivery === 'false' ? false : (bool)$this->delivery);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDelivery($value)
    {
        $this->delivery = $value;

        return $this;
    }

    /**
     * @return Outlet[]|null
     */
    public function getOutlets()
    {
        return $this->outlets ?: null;
    }

    /**
     * @param Outlet[] $value
     * @return $this
     */
    public function setOutlets(array $value)
    {
        foreach ($value as $outlet) {
            $this->addOutlet($outlet);
        }

        return $this;
    }

    /**
     * @param Outlet $value
     * @return $this
     */
    public function addOutlet(Outlet $value)
    {
        $this->outlets[] = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDescription($value)
    {
        $this->description = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalesNotes()
    {
        return $this->salesNotes;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSalesNotes($value)
    {
        $this->salesNotes = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountryOfOrigin()
    {
        return $this->countryOfOrigin;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCountryOfOrigin($value)
    {
        $this->countryOfOrigin = $value;

        return $this;
    }

    /**
     * @return string[]|null
     */
    public function getBarcodes()
    {
        return $this->barcodes ?: null;
    }

    /***
     * @param string[] $value
     * @return $this
     */
    public function setBarcodes(array $value)
    {
        foreach ($value as $barcode) {
            $this->addBarcode($barcode);
        }

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function addBarcode($value)
    {
        $this->barcodes[] = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getCpa()
    {
        return $this->cpa === null ? null : ($this->cpa === '1');
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCpa($value)
    {
        $this->cpa = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getExpiry()
    {
        return $this->expiry;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setExpiry($value)
    {
        $this->expiry = $value;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getWeight()
    {
        return $this->weight === null ? null : (float)$this->weight;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setWeight($value)
    {
        $this->weight = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDimensions($value)
    {
        $this->dimensions = $value;

        return $this;
    }

    /**
     * @return Param[]|null
     */
    public function getParams()
    {
        return $this->params ?: null;
    }

    /**
     * @param Param[] $value
     * @return $this
     */
    public function setParams(array $value)
    {
        foreach ($value as $param) {
            $this->addParam($param);
        }

        return $this;
    }

    /**
     * @param Param $value
     * @return $this
     */
    public function addParam(Param $value)
    {
        $this->params[] = $value;

        return $this;
    }
}