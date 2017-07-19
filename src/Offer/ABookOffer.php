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
     * @var string
     */
    protected $year;

    /**
     * @var string
     */
    protected $ISBN;

    /**
     * @var string
     */
    protected $volume;

    /**
     * @var string
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
            //subNodes
            'name', 'author', 'publisher', 'series', 'year', 'ISBN', 'volume', 'part', 'language', 'table_of_contents'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->name === null){
            $this->addError("Offer: missing required attribute 'name'");
        }
        if ($this->year !== null && !is_numeric($this->year)){
            $this->addError("Offer: incorrect value in attribute 'year'");
        }
        if ($this->volume !== null && (!is_numeric($this->volume) || (int)$this->volume <= 0)){
            $this->addError("Offer: incorrect value in attribute 'volume'");
        }
        if ($this->part !== null && (!is_numeric($this->part) || (int)$this->part <= 0)){
            $this->addError("Offer: incorrect value in attribute 'part'");
        }
        return $isValid && empty($this->errors);
    }

    /**
     * @return string|null
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
        $this->author = $value;

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
        $this->publisher = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->series = $value;

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
        $this->ISBN = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getVolume()
    {
        return $this->volume === null ? null : (int)$this->volume;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setVolume($value)
    {
        $this->volume = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPart()
    {
        return $this->part === null ? null : (int)$this->part;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPart($value)
    {
        $this->part = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->language = $value;

        return $this;
    }

    /**
     * @return string|null
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
        $this->tableOfContents = $value;

        return $this;
    }
}