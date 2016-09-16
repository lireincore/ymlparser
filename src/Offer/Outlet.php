<?php

namespace LireinCore\YMLParser\Offer;

use LireinCore\YMLParser\TYML;

class Outlet
{
    use TYML;

    /**
     * @var string //todo: int?
     */
    protected $id;

    /**
     * @var int //todo: out of range?
     */
    protected $instock = 0;

    /**
     * @var bool
     */
    protected $booking = true;

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
    public function getInstock()
    {
        return $this->instock;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setInstock($value)
    {
        $this->instock = (int)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setBooking($value)
    {
        $this->booking = $value === 'false' ? false : (bool)$value;

        return $this;
    }
}