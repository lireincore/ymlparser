<?php

namespace LireinCore\YMLParser\Offer;

abstract class AMainOffer extends AExtOffer
{
    const DEFAULT_FROM = false;

    /**
     * @var string
     */
    protected $minQuantity;

    /**
     * @var string
     */
    protected $stepQuantity;

    /**
     * @var string
     */
    protected $groupId;

    /**
     * @var string
     */
    protected $rec;

    /**
     * price[from]
     *
     * @var string
     */
    protected $from;

    /**
     * @var string
     */
    protected $vendor;

    /**
     * @var string
     */
    protected $vendorCode;

    /**
     * @var string
     */
    protected $model;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'min-quantity', 'step-quantity', 'group_id', 'rec', 'vendor', 'vendorCode', 'model'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->minQuantity !== null && (!is_numeric($this->minQuantity) || (int)$this->minQuantity <= 0))
            $this->setError("Offer: incorrect value in attribute 'min-quantity'");

        if ($this->stepQuantity !== null && (!is_numeric($this->stepQuantity) || (int)$this->stepQuantity <= 0))
            $this->setError("Offer: incorrect value in attribute 'step-quantity'");

        if ($this->groupId !== null && !is_numeric($this->groupId))
            $this->setError("Offer: incorrect value in attribute 'group_id'");

        if ($this->from !== null && $this->from !== 'true' && $this->from !== 'false')
            $this->setError("Price: incorrect value in attribute 'from'");

        return $isValid && empty($this->errors);
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    /*public function setAttribute(array $attrNode)
    {
        //if ($attrNode['name'] == 'price') {
        //    if (isset($attrNode['attributes']['from'])) $this->setField('from', $attrNode['attributes']['from']);
        //}

        parent::setAttribute($attrNode);

        return $this;
    }*/

    /**
     * @return int|null
     */
    public function getMinQuantity()
    {
        return $this->minQuantity === null ? null : (int)$this->minQuantity;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMinQuantity($value)
    {
        $this->minQuantity = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStepQuantity()
    {
        return $this->stepQuantity === null ? null : (int)$this->stepQuantity;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setStepQuantity($value)
    {
        $this->stepQuantity = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId()
    {
        return $this->groupId === null ? null : (int)$this->groupId;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setGroupId($value)
    {
        $this->groupId = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRec()
    {
        return $this->rec;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRec($value)
    {
        $this->rec = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getFrom()
    {
        return $this->from === null ? null : ($this->from === 'false' ? false : (bool)$this->from);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setFrom($value)
    {
        $this->from = $value;

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

    /**
     * @return string|null
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setModel($value)
    {
        $this->model = $value;

        return $this;
    }
}