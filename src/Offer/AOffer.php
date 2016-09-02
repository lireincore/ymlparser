<?php

namespace LireinCore\YMLParser\Offer;

abstract class AOffer
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $cbid;

    /**
     * @var int
     */
    protected $bid;

    /**
     * @var bool
     */
    protected $available;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var float
     */
    protected $price;

    /**
     * @var float
     */
    protected $oldPrice;

    /**
     * @var string
     */
    protected $currencyId;

    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var string[]
     */
    protected $pictures = [];

    /**
     * @var bool
     */
    protected $delivery;

    /**
     * @var bool
     */
    protected $pickup;

    /**
     * @var bool
     */
    protected $store;

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
     * @var int
     */
    protected $cpa;

    /**
     * @var Param[]
     */
    protected $params = [];

    /**
     * @var string
     */
    protected $expiry;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @var string
     */
    protected $dimensions;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return ['id', 'cbid', 'bid', 'available'];
    }

    /**
     * @return array
     */
    public function getFiledsList()
    {
        return [
            'price', 'oldPrice', 'currencyId', 'categoryId', 'picture', 'delivery',
            'pickup', 'store', 'outlets', 'description', 'sales_notes', 'country_of_origin',
            'barcode', 'cpa', 'param', 'expiry', 'weight', 'dimensions'
        ];
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $setter = 'set' . str_replace(['-', '_'], '', $name);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * @return string
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
        $this->id = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getCbid()
    {
        return $this->cbid;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setCbid($value)
    {
        $this->cbid = (int)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getBid()
    {
        return $this->bid;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setBid($value)
    {
        $this->bid = (int)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setAvailable($value)
    {
        $this->available = $value === 'false' ? false : (bool)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->url = (string)$value;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setPrice($value)
    {
        $this->price = (float)$value;

        return $this;
    }

    /**
     * @return float
     */
    public function getOldPrice()
    {
        return $this->oldPrice;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setOldPrice($value)
    {
        $this->oldPrice = (float)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->currencyId = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setCategoryId($value)
    {
        $this->categoryId = (int)$value;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getPictures()
    {
        return $this->pictures;
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
        $this->pictures[] = (string)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setDelivery($value)
    {
        $this->delivery = $value === 'false' ? false : (bool)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getPickup()
    {
        return $this->pickup;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setPickup($value)
    {
        $this->pickup = $value === 'false' ? false : (bool)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setStore($value)
    {
        $this->store = $value === 'false' ? false : (bool)$value;

        return $this;
    }

    /**
     * @return Outlet[]
     */
    public function getOutlets()
    {
        return $this->outlets;
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
     * @return string
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
        $this->description = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->salesNotes = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->countryOfOrigin = (string)$value;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getBarcodes()
    {
        return $this->barcodes;
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
        $this->barcodes[] = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getCpa()
    {
        return $this->cpa;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setCpa($value)
    {
        $this->cpa = (int)$value;

        return $this;
    }

    /**
     * @return Param[]
     */
    public function getParams()
    {
        return $this->params;
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

    /**
     * @return string
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
        $this->expiry = (string)$value;

        return $this;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setWeight($value)
    {
        $this->weight = (float)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->dimensions = (string)$value;

        return $this;
    }
}