<?php

namespace LireinCore\YMLParser\Offer;

class TourOffer extends AExtOffer
{
    /**
     * @var string
     */
    protected $worldRegion;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $days;

    /**
     * @var string[]
     */
    protected $dataTours;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $hotelStars;

    /**
     * @var string
     */
    protected $room;

    /**
     * @var string
     */
    protected $meal;

    /**
     * @var string
     */
    protected $included;

    /**
     * @var string
     */
    protected $transport;

    /**
     * @var string
     */
    protected $priceMin;

    /**
     * @var string
     */
    protected $priceMax;

    /**
     * @var string
     */
    protected $options;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'name', 'worldRegion', 'country', 'region', 'days', 'dataTour',
            'hotel_stars', 'room', 'meal', 'included', 'transport',
            'price_min', 'price_max', 'options'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->name === null)
            $this->setError("Offer: missing required attribute 'name'");

        if ($this->days === null)
            $this->setError("Offer: missing required attribute 'days'");
        elseif (!is_numeric($this->days) || (int)$this->days <= 0)
            $this->setError("Offer: incorrect value in attribute 'days'");

        if ($this->included === null)
            $this->setError("Offer: missing required attribute 'included'");

        if ($this->transport === null)
            $this->setError("Offer: missing required attribute 'transport'");

        if ($this->priceMin !== null && (!is_numeric($this->priceMin) || (float)$this->priceMin <= 0))
            $this->setError("Offer: incorrect value in attribute 'price_min'");

        if ($this->priceMax !== null && (!is_numeric($this->priceMax) || ((float)$this->priceMax <= 0
            || ($this->priceMin !== null && (float)$this->priceMin >= (float)$this->priceMax))))
            $this->setError("Offer: incorrect value in attribute 'price_max'");

        return $isValid && empty($this->errors);
    }

    /**
     * @param array $attrNode
     * @return $this
     */
    public function setAttribute(array $attrNode)
    {
        if ($attrNode['name'] == 'dataTour') {
            $this->addDataTour($attrNode['value']);
        }
        else {
            parent::setAttribute($attrNode);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWorldRegion()
    {
        return $this->worldRegion;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setWorldRegion($value)
    {
        $this->worldRegion = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setCountry($value)
    {
        $this->country = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRegion($value)
    {
        $this->region = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDays()
    {
        return $this->days === null ? null : (int)$this->days;
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
     * @return string[]|null
     */
    public function getDataTours()
    {
        return $this->dataTours ? $this->dataTours : null;
    }

    /**
     * @param string[] $value
     * @return $this
     */
    public function setDataTours(array $value)
    {
        foreach ($value as $dataTour) {
            $this->addDataTour($dataTour);
        }

        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function addDataTour($value)
    {
        $this->dataTours[] = $value;

        return $this;
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
    public function getHotelStars()
    {
        return $this->hotelStars;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setHotelStars($value)
    {
        $this->hotelStars = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRoom($value)
    {
        $this->room = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMeal()
    {
        return $this->meal;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMeal($value)
    {
        $this->meal = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getIncluded()
    {
        return $this->included;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setIncluded($value)
    {
        $this->included = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTransport($value)
    {
        $this->transport = $value;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceMin()
    {
        return $this->priceMin === null ? null : (float)$this->priceMin;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPriceMin($value)
    {
        $this->priceMin = $value;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceMax()
    {
        return $this->priceMax === null ? null : (float)$this->priceMax;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPriceMax($value)
    {
        $this->priceMax = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOptions($value)
    {
        $this->options = $value;

        return $this;
    }
}