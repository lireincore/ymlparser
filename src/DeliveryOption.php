<?php

namespace LireinCore\YMLParser;

class DeliveryOption
{
    use TYML;

    /**
     * @var int
     */
    protected $cost;

    /**
     * @var string
     */
    protected $days;

    /**
     * @var int
     */
    protected $orderBefore;

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->setField($name, $value);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setCost($value)
    {
        $this->cost = (int)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->days = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrderBefore()
    {
        return $this->orderBefore;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setOrderBefore($value)
    {
        $this->orderBefore = (int)$value;

        return $this;
    }
}