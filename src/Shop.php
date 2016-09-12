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
     * Attribute is deprecated
     * @var int
     */
    protected $localDeliveryCost;

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
        }
        elseif ($attrNode['name'] == 'categories') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addCategory((new Category())->setAttributes($subNode['attributes'] + ['name' => $subNode['value']]));
            }
        }
        elseif ($attrNode['name'] == 'delivery-options') {
            foreach ($attrNode['nodes'] as $subNode) {
                $this->addDeliveryOption((new DeliveryOption())->setAttributes($subNode['attributes']));
            }
        }
        else {
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
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setField($name, $value)
    {
        $setter = 'set' . str_replace(['-', '_'], '', $name);
        if (method_exists($this, $setter)) {
            $this->$setter($value);
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
     * @param int $id
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
     * @param int $id
     * @return Category[]
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