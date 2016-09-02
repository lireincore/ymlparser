<?php

namespace LireinCore\YMLParser;

class Currency
{
    const CURRENCY_RUR = 'RUR';
    const CURRENCY_RUB = 'RUB';
    const CURRENCY_UAH = 'UAH';
    const CURRENCY_BYN = 'BYN';
    const CURRENCY_KZT = 'KZT';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';

    const EXCHANGE_RATE_CBRF = 'CBRF';
    const EXCHANGE_RATE_NBU = 'NBU';
    const EXCHANGE_RATE_NBK = 'NBK';
    const EXCHANGE_RATE_CB = 'CB';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var float|string
     */
    protected $rate;

    /**
     * @var int
     */
    protected $plus = 0;

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $value) {
            $setter = 'set' . str_replace(['-', '_'], '', $name);
            if (method_exists($this, $setter)) {
                $this->$setter($value);
            }
        }

        return $this;
    }

    /**
     * @return string
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
        $this->id = (string)$value;

        return $this;
    }

    /**
     * @return float|string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float|string $value
     * @return $this
     */
    public function setRate($value)
    {
        $this->rate = is_numeric($value) ? (float)$value : (string)$value;

        return $this;
    }

    /**
     * @return int
     */
    public function getPlus()
    {
        return $this->plus;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setPlus($value)
    {
        $this->plus = (int)$value;

        return $this;
    }
}