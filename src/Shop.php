<?php

namespace LireinCore\YMLParser;

class Shop
{
    use TYML;
    use TError;

    const DEFAULT_CPA = 1;

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
     * Attribute is deprecated
     * @var string
     */
    protected $localDeliveryCost;

    /**
     * @var string
     */
    protected $cpa;

    /**
     * @var int
     */
    protected $offersCount = 0;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return [
            //subnodes
            'name', 'company', 'url', 'platform', 'version', 'agency', //offers,
            'email', 'currencies', 'categories', 'delivery-options',
            'local_delivery_cost', 'cpa',
        ];
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->offersCount == 0)
            $this->setError("Shop: no offers");

        if ($this->name === null)
            $this->setError("Shop: missing required attribute 'name'");
        elseif (!$this->name)
            $this->setError("Shop: incorrect value in attribute 'name'");

        if ($this->company === null)
            $this->setError("Shop: missing required attribute 'company'");
        elseif (!$this->company)
            $this->setError("Shop: incorrect value in attribute 'company'");

        if ($this->url === null)
            $this->setError("Shop: missing required attribute 'url'");
        elseif (!$this->url)
            $this->setError("Shop: incorrect value in attribute 'url'");

        if (!$this->currencies)
            $this->setError("Shop: missing required attribute 'currencies'");

        if (!$this->categories)
            $this->setError("Shop: missing required attribute 'categories'");

        if ($this->localDeliveryCost !== null && (!is_numeric($this->localDeliveryCost) || ((int)$this->localDeliveryCost) < 0))
            $this->setError("Shop: incorrect value in attribute 'local_delivery_cost'");

        $subIsValid = true;
        if ($this->currencies) {
            foreach ($this->currencies as $currency) {
                if (!$currency->isValid()) $subIsValid = false;
            }
        }
        if ($this->categories) {
            foreach ($this->categories as $category) {
                if (!$category->isValid()) $subIsValid = false;
            }
        }
        if ($this->deliveryOptions) {
            foreach ($this->deliveryOptions as $deliveryOption) {
                if (!$deliveryOption->isValid()) $subIsValid = false;
            }
        }

        return empty($this->errors) && $subIsValid;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = $this->errors;

        if ($this->currencies) {
            foreach ($this->currencies as $currency) {
                $errors = array_merge($errors, $currency->getErrors());
            }
        }
        if ($this->categories) {
            foreach ($this->categories as $category) {
                $errors = array_merge($errors, $category->getErrors());
            }
        }
        if ($this->deliveryOptions) {
            foreach ($this->deliveryOptions as $deliveryOption) {
                $errors = array_merge($errors, $deliveryOption->getErrors());
            }
        }

        return $errors;
    }

    /**
     * @param array $shopNode
     * @return $this
     */
    public function setShop(array $shopNode)
    {
        foreach ($shopNode['nodes'] as $attrNode) {
            $this->setAttribute($attrNode);
        }

        return $this;
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    public function setAttribute(array $attrNode)
    {
        if ($attrNode['name'] == 'currencies') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addCurrency((new Currency())->setAttributes($subNode['attributes']));
            }
        } elseif ($attrNode['name'] == 'categories') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addCategory((new Category())->setAttributes($subNode['attributes'] + ['name' => $subNode['value']]));
            }
        } elseif ($attrNode['name'] == 'delivery-options') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addDeliveryOption((new DeliveryOption())->setAttributes($subNode['attributes']));
            }
        } else {
            if (!is_null($attrNode['value'])) $this->setField($attrNode['name'], $attrNode['value']);
            if (!empty($attrNode['attributes'])) {
                foreach ($attrNode['attributes'] as $name => $value) {
                    $this->setField($name, $value);
                }
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        $data = $this->toArray();
        unset($data['errors']);
        unset($data['offersCount']);

        return $data;
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
        $this->company = $value;

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
     * @return string|null
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
        $this->platform = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->version = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->agency = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->email = $value;

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
     * @return Currency[]|null
     */
    public function getCurrencies()
    {
        return $this->currencies ? $this->currencies : null;
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
     * @param string $id
     * @return Category|null
     */
    public function getCategory($id)
    {
        return array_key_exists($id, $this->categories) ? $this->categories[$id] : null;
    }

    /**
     * @param string $id
     * @return Category|null
     */
    public function getCategoryParent($id)
    {
        if (array_key_exists($id, $this->categories)
            && !is_null($parentId = $this->categories[$id]->getParentId())
            && array_key_exists($parentId, $this->categories)) {
            return $this->categories[$parentId];
        }

        return null;
    }

    /**
     * @param string $id
     * @return Category[]|null
     */
    public function getCategoryHierarchy($id)
    {
        $parents = [];

        if (array_key_exists($id, $this->categories)) {
            $parents[$id] = $this->categories[$id];
            $pid = $id;

            while (($parent = $this->getCategoryParent($pid)) !== null) {
                $pid = $parent->getId();
                array_unshift($parents, $parent);
            }
        }

        return $parents;
    }

    /**
     * @return Category[]|null
     */
    public function getCategories()
    {
        return $this->categories ? $this->categories : null;
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
     * @return DeliveryOption[]|null
     */
    public function getDeliveryOptions()
    {
        return $this->deliveryOptions ? $this->deliveryOptions : null;
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
     * @return bool|null
     */
    public function getCpa()
    {
        return $this->cpa === null ? null : ($this->cpa === '1' ? true : false);
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
        $this->offersCount = $value;

        return $this;
    }
}