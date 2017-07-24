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
     * @var string
     */
    protected $isPremiere;

    /**
     * @var string
     */
    protected $isKids;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subNodes
            'name', 'place', 'hall', 'hall_part', 'date', 'is_premiere', 'is_kids'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->name === null) {
            $this->addError("Offer: missing required attribute 'name'");
        }

        if ($this->place === null) {
            $this->addError("Offer: missing required attribute 'place'");
        }

        if ($this->date === null) {
            $this->addError("Offer: missing required attribute 'date'");
        }

        if ($this->isPremiere !== null && $this->isPremiere !== '0' && $this->isPremiere !== '1') {
            $this->addError("Offer: incorrect value in attribute 'is_premiere'");
        }

        if ($this->isKids !== null && $this->isKids !== '0' && $this->isKids !== '1') {
            $this->addError("Offer: incorrect value in attribute 'is_kids'");
        }

        return $isValid && empty($this->errors);
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
        $this->place = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->hall = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->hallPart = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->date = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsPremiere()
    {
        return $this->isPremiere === null ? null : (bool)$this->isPremiere;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setIsPremiere($value)
    {
        $this->isPremiere = $value;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsKids()
    {
        return $this->isKids === null ? null : (bool)$this->isKids;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setIsKids($value)
    {
        $this->isKids = $value;

        return $this;
    }
}