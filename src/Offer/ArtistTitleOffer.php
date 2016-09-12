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
     * @var int
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
     * @return string
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
        $this->artist = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->title = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setYear($value)
    {
        $this->year = (int)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->media = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->starring = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->director = (string)$value;

        return $this;
    }

    /**
     * @return string
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
        $this->originalName = (string)$value;

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
}