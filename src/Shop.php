<?php

namespace LireinCore\YMLParser;

class Shop
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $platform;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $agency;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var Currency[]
     */
    protected $currencies = [];

    /**
     * @var Category[]
     */
    protected $categories = [];

    /**
     * @var DeliveryOption[]
     */
    protected $deliveryOptions = [];

    /**
     * @var int
     */
    protected $cpa;

    /**
     * @var int
     */
    protected $offersCount;

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
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCompany($value)
    {
        $this->company = (string)$value;

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
     * @return string
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPlatform($value)
    {
        $this->platform = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVersion($value)
    {
        $this->version = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAgency($value)
    {
        $this->agency = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setEmail($value)
    {
        $this->email = (string)$value;

        return $this;
    }

    /**
     * @param string $id
     * @return Currency|null
     */
    public function getCurrency($id)
    {
        return array_key_exists($id, $this->currencies) ? $this->currencies[$id] : null;
    }

    /**
     * @return Currency[]
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @param Currency[] $value
     * @return $this
     */
    public function setCurrencies(array $value)
    {
        foreach ($value as $currency) {
            $this->addCurrency($currency);
        }

        return $this;
    }

    /**
     * @param Currency $value
     * @return $this
     */
    public function addCurrency(Currency $value)
    {
        $this->currencies[$value->getId()] = $value;

        return $this;
    }

    /**
     * @param int $id
     * @return Category|null
     */
    public function getCategory($id)
    {
        return array_key_exists($id, $this->categories) ? $this->categories[$id] : null;
    }

    /**
     * @return Category[]
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category[] $value
     * @return $this
     */
    public function setCategories(array $value)
    {
        foreach ($value as $category) {
            $this->addCategory($category);
        }

        return $this;
    }

    /**
     * @param Category $value
     * @return $this
     */
    public function addCategory(Category $value)
    {
        $this->categories[$value->getId()] = $value;

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
     * @return int
     */
    public function getOffersCount()
    {
        return $this->offersCount;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setOffersCount($value)
    {
        $this->offersCount = (int)$value;

        return $this;
    }
}