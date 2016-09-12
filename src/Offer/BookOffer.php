<?php

namespace LireinCore\YMLParser\Offer;

class BookOffer extends ABookOffer
{
    /**
     * @var string
     */
    protected $binding;

    /**
     * @var int
     */
    protected $pageExtent;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subnodes
            'binding', 'page_extent'
        ]);
    }

    /**
     * @return string
     */
    public function getBinding()
    {
        return $this->binding;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setBinding($value)
    {
        $this->binding = (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPageExtent()
    {
        return $this->pageExtent;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setPageExtent($value)
    {
        $this->pageExtent = (int)$value;

        return $this;
    }
}