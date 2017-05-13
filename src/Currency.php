<?php

namespace LireinCore\YMLParser;

class Currency
{
    use TYML;
    use TError;

    const DEFAULT_PLUS = 0;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $rate;

    /**
     * @var string
     */
    protected $plus;

    /**
     * @return bool
     */
    public function isValid()
    {
        if ($this->id === null)
            $this->addError("Currency: missing required attribute 'id'");
        elseif (!in_array($this->id, ['RUR', 'RUB', 'UAH', 'BYN', 'BYR', 'KZT', 'USD', 'EUR']))
            $this->addError("Currency: incorrect value in attribute 'id'");

        if ($this->rate === null)
            $this->addError("Currency: missing required attribute 'rate'");
        elseif (!(in_array($this->rate, ['CBRF', 'NBU', 'NBK', 'CB']) || (is_numeric($this->rate) && (float)$this->rate > 0)))
            $this->addError("Currency: incorrect value in attribute 'rate'");

        if ($this->plus !== null && (!is_numeric($this->rate) || (int)$this->plus < 0))
            $this->addError("Currency: incorrect value in attribute 'plus'");

        return empty($this->errors);
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function addAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->addField($name, $value);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;

        return $this;
    }

    /**
     * @return float|string|null
     */
    public function getRate()
    {
        return is_numeric($this->rate) ? (float)$this->rate : $this->rate;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setRate($value)
    {
        $this->rate = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPlus()
    {
        return $this->plus === null ? null : (int)$this->plus;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setPlus($value)
    {
        $this->plus = $value;

        return $this;
    }
}