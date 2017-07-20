<?php

namespace LireinCore\YMLParser\Offer;

class BookOffer extends ABookOffer
{
    /**
     * @var string
     */
    protected $binding;

    /**
     * @var string
     */
    protected $pageExtent;

    /**
     * @return array
     */
    public function getAttributesList()
    {
        return array_merge(parent::getAttributesList(), [
            //subNodes
            'binding', 'page_extent'
        ]);
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        $isValid = parent::isValid();

        if ($this->pageExtent !== null && (!is_numeric($this->pageExtent) || (int)$this->volume <= 0)){
            $this->addError("Offer: incorrect value in attribute 'page_extent'");
        }

        return $isValid && empty($this->errors);
    }

    /**
     * @return string|null
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
        $this->binding = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPageExtent()
    {
        return $this->pageExtent === null ? null : (int)$this->pageExtent;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPageExtent($value)
    {
        $this->pageExtent = $value;

        return $this;
    }
}