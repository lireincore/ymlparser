<?php

namespace LireinCore\YMLParser\Offer;

class ArtistTitleOffer extends AExtOffer
{
    /**
     * @var string
     */
    protected $artist;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $year;

    /**
     * @var string
     */
    protected $media;

    /**
     * @var string
     */
    protected $starring;

    /**
     * @var string
     */
    protected $director;

    /**
     * @var string
     */
    protected $originalName;

    /**
     * @var string
     */
    protected $country;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'artist', 'title', 'year', 'media', 'starring', 'director', 'originalName', 'country'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->title === null)
            $this->setError("Offer: missing required attribute 'title'");

        if ($this->year !== null && !is_numeric($this->year))
            $this->setError("Offer: incorrect value in attribute 'year'");

        return $isValid && empty($this->errors);
    }

    /**
     * @return string|null
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setArtist($value)
    {
        $this->artist = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTitle($value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear()
    {
        return $this->year === null ? null : (int)$this->year;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setYear($value)
    {
        $this->year = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setMedia($value)
    {
        $this->media = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getStarring()
    {
        return $this->starring;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setStarring($value)
    {
        $this->starring = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setDirector($value)
    {
        $this->director = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getOriginalName()
    {
        return $this->originalName;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setOriginalName($value)
    {
        $this->originalName = $value;

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
}