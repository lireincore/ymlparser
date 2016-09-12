<?php

namespace LireinCore\YMLParser\Offer;

abstract class ABookOffer extends AExtOffer
{
    /**
     * @var string
     */
    protected $author;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $publisher;

    /**
     * @var string
     */
    protected $series;

    /**
     * @var int
     */
    protected $year;

    /**
     * @var string
     */
    protected $ISBN;

    /**
     * @var int
     */
    protected $volume;

    /**
     * @var int
     */
    protected $part;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $tableOfContents;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'name', 'author', 'publisher', 'series', 'year', 'ISBN', 'volume', 'part', 'language', 'table_of_contents'
        ]);
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setAuthor($value)
    {
        $this->author = (string)$value;

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
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPublisher($value)
    {
        $this->publisher = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setSeries($value)
    {
        $this->series = (string)$value;

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
    public function getISBN()
    {
        return $this->ISBN;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setISBN($value)
    {
        $this->ISBN = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setVolume($value)
    {
        $this->volume = (int)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPart()
    {
        return $this->part;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setPart($value)
    {
        $this->part = (int)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setLanguage($value)
    {
        $this->language = (string)$value;

        return $this;
    }

    /**
     * @return string
     */
    public function getTableOfContents()
    {
        return $this->tableOfContents;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setTableOfContents($value)
    {
        $this->tableOfContents = (string)$value;

        return $this;
    }
}