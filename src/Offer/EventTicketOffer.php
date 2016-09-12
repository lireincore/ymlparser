<?php

namespace LireinCore\YMLParser\Offer;

class EventTicketOffer extends AExtOffer
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $place;

    /**
     * @var string
     */
    protected $hall;

    /**
     * @var string
     */
    protected $hallPart;

    /**
     * @var string
     */
    protected $date;

    /**
     * @var bool
     */
    protected $isPremiere;

    /**
     * @var bool
     */
    protected $isKids;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'name', 'place', 'hall', 'hall_part', 'date', 'is_premiere', 'is_kids'
        ]);
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
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPlace($value)
    {
        $this->place = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setHall($value)
    {
        $this->hall = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getHallPart()
    {
        return $this->hallPart;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setHallPart($value)
    {
        $this->hallPart = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDate($value)
    {
        $this->date = (string)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPremiere()
    {
        return $this->isPremiere;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setIsPremiere($value)
    {
        $this->isPremiere = (bool)$value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsKids()
    {
        return $this->isKids;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setIsKids($value)
    {
        $this->isKids = (bool)$value;

        return $this;
    }
}