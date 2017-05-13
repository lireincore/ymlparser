<?php

namespace LireinCore\YMLParser;

class DeliveryOption
{
    use TYML;
    use TError;

    const DEFAULT_ORDER_BEFORE = 24;

    /**
     * @var string
     */
    protected $cost;

    /**
     * @var string
     */
    protected $days;

    /**
     * @var string
     */
    protected $orderBefore;

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->cost === null)
            $this->addError("DeliveryOption: missing required attribute 'cost'");
        elseif (!is_numeric($this->cost) || ((int)$this->cost) < 0)
            $this->addError("DeliveryOption: incorrect value in attribute 'cost'");

        if ($this->days === null)
            $this->addError("DeliveryOption: missing required attribute 'days'");

        if ($this->orderBefore !== null && (!is_numeric($this->orderBefore) || (int)$this->orderBefore < 0 || (int)$this->orderBefore > 24))
            $this->addError("DeliveryOption: incorrect value in attribute 'order-before'");

        return empty($this->errors);
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function addAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->addField($name, $value);
        }

        return $this;
    }

    /**
     * @return int|null
     */
    public function getCost()
    {
        return $this->cost === null ? null : (int)$this->cost;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCost($value)
    {
        $this->cost = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDays($value)
    {
        $this->days = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getOrderBefore()
    {
        return $this->orderBefore === null ? null : (int)$this->orderBefore;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOrderBefore($value)
    {
        $this->orderBefore = $value;

        return $this;
    }
}