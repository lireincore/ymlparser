<?php

namespace LireinCore\YMLParser\Offer;

class Outlet
{
    use \LireinCore\YMLParser\TYML;
    use \LireinCore\YMLParser\TError;

    const DEFAULT_INSTOCK = 0;
    const DEFAULT_BOOKING = true;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $instock;

    /**
     * @var string
     */
    protected $booking;

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->id === null)
            $this->addError("Outlet: missing required attribute 'id'");
        elseif (!$this->id)
            $this->addError("Outlet: incorrect value in attribute 'id'");

        if ($this->instock !== null && (!is_numeric($this->instock) || (int)$this->instock < 0))
            $this->addError("Outlet: incorrect value in attribute 'instock'");

        if ($this->booking !== null && $this->booking !== 'true' && $this->booking !== 'false')
            $this->addError("Outlet: incorrect value in attribute 'booking'");

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
     * @return string|null //todo: int?
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
    public function getInstock()
    {
        return $this->instock === null ? null : (int)$this->instock;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setInstock($value)
    {
        $this->instock = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getBooking()
    {
        return $this->booking === null ? null : ($this->booking === 'false' ? false : (bool)$this->booking);
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setBooking($value)
    {
        $this->booking = $value;

        return $this;
    }
}