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
     * @var int
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
     * @var float
     */
    protected $priceMin;

    /**
     * @var float
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
     * @return string
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
        $this->worldRegion = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->country = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->region = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setDays($value)
    {
        $this->days = (int)$value;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getDataTours()
    {
        return $this->dataTours;
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
        $this->dataTours[] = (string)$value;

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
        $this->hotelStars = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->room = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->meal = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->included = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->transport = (string)$value;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceMin()
    {
        return $this->priceMin;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setPriceMin($value)
    {
        $this->priceMin = (float)$value;

        return $this;
    }

    /**
     * @return float
     */
    public function getPriceMax()
    {
        return $this->priceMax;
    }

    /**
     * @param float $value
     * @return $this
     */
    public function setPriceMax($value)
    {
        $this->priceMax = (float)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->options = (string)$value;

        return $this;
    }
}