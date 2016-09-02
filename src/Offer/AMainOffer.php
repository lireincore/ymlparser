<?php

namespace LireinCore\YMLParser\Offer;

abstract class AMainOffer extends ABaseOffer
{
    /**
     * price[from]
     * @var bool
     */
    protected $from = false;

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
     * @var int
     */
    protected $groupId;

    /**
     * @return array
     */
    public function getFiledsList()
    {
        return array_merge(parent::getFiledsList(), [
            'vendor', 'vendorCode', 'model', 'group_id'
        ]);
    }

    /**
     * @return bool
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setFrom($value)
    {
        $this->from = $value === 'false' ? false : (bool)$value;

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

    /**
     * @return string
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
        $this->model = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setGroupId($value)
    {
        $this->groupId = (int)$value;

        return $this;
    }
}