<?php

namespace LireinCore\YMLParser;

use LireinCore\YMLParser\Offer\VendorModelOffer;
use LireinCore\YMLParser\Offer\BookOffer;
use LireinCore\YMLParser\Offer\AudioBookOffer;
use LireinCore\YMLParser\Offer\ArtistTitleOffer;
use LireinCore\YMLParser\Offer\MedicineOffer;
use LireinCore\YMLParser\Offer\EventTicketOffer;
use LireinCore\YMLParser\Offer\TourOffer;
use LireinCore\YMLParser\Offer\SimpleOffer;

class YML
{
    /**
     * @var \XMLReader
     */
    protected $XMLReader;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $schema;

    /**
     * @var array
     */
    protected $pathArr = [];

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $date;

    /**
     * @var Shop
     */
    protected $shop;

    /**
     * YML constructor.
     */
    public function __construct()
    {
        $this->XMLReader = new \XMLReader();
    }

    /**
     * @param string $uri
     * @param string|bool $schema
     * @throws \Exception
     */
    public function parse($uri, $schema = true)
    {
        $this->uri = $uri;
        if ($schema === true) {
            $this->schema = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'yml.xsd';
        } elseif (is_string($schema)) {
            $this->schema = $schema;
        }

        $this->open();

        while ($this->read()) {
            if ($this->path == 'yml_catalog') {
                $this->date = $this->XMLReader->getAttribute('date');
                while ($this->read()) {
                    if ($this->path == 'yml_catalog/shop') {
                        $this->shop = $this->parseShop();
                        break;
                    }
                }
                break;
            }
        }

        $this->close();
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @return \Generator|SimpleOffer[]|VendorModelOffer[]|BookOffer[]|AudioBookOffer[]|ArtistTitleOffer[]|MedicineOffer[]|EventTicketOffer[]|TourOffer[]
     * @throws \Exception
     */
    public function getOffers()
    {
        $this->open();

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/offers') {
                while ($this->read()) {
                    if ($this->path == 'yml_catalog/shop/offers/offer') {
                        yield $this->parseOffer();
                    } elseif ($this->path == 'yml_catalog/shop') {
                        break;
                    }
                }
                break;
            }
        }

        $this->close();
    }

    /**
     * @return Shop
     */
    protected function parseShop()
    {
        $xml = $this->XMLReader;
        $shop = new Shop();
        $nodes = [];

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/offers') {
                $shop->setOffersCount($this->parseOffersCount());
            } elseif ($xml->nodeType == \XMLReader::ELEMENT) {
                $nodes[] = $this->parseNode('yml_catalog/shop');
            } elseif ($this->path == 'yml_catalog') {
                break;
            }
        }

        $shop->setShop(['name' => 'shop', 'attributes' => [], 'value' => null, 'nodes' => $nodes]);

        return $shop;
    }

    /**
     * @return SimpleOffer|VendorModelOffer|BookOffer|AudioBookOffer|ArtistTitleOffer|MedicineOffer|EventTicketOffer|TourOffer
     */
    protected function parseOffer()
    {
        $offerNode = $this->parseNode('yml_catalog/shop/offers');

        $type = isset($offerNode['attributes']['type']) ? $offerNode['attributes']['type'] : null;
        $offer = $this->createOffer($type)->setOffer($offerNode);

        return $offer;
    }

    /**
     * @param string $basePath
     * @return array
     */
    protected function parseNode($basePath)
    {
        $xml = $this->XMLReader;
        $name = $xml->name;
        $path = $basePath . '/' . $name;
        $value = '';
        $nodes = [];

        $attributes = $this->parseAttributes();

        if (!$xml->isEmptyElement) {
            while ($this->read()) {
                if ($xml->nodeType == \XMLReader::ELEMENT) {
                    $nodes[] = $this->parseNode($path);
                } elseif (($xml->nodeType == \XMLReader::TEXT || $xml->nodeType == \XMLReader::CDATA) && $xml->hasValue) {
                    $value .= $xml->value;
                } elseif ($this->path == $basePath) {
                    break;
                }
            }
        }
        $value = (trim($value)) ? $value : null;

        return ['name' => $name, 'attributes' => $attributes, 'value' => $value, 'nodes' => $nodes];
    }

    /**
     * @return array
     */
    protected function parseAttributes()
    {
        $xml = $this->XMLReader;
        $attributes = [];

        if ($xml->hasAttributes) {
            while ($xml->moveToNextAttribute()) {
                $attributes[$xml->name] = $xml->value;
            }
        }

        return $attributes;
    }

    /**
     * @return int
     */
    protected function parseOffersCount()
    {
        $xml = $this->XMLReader;
        $count = 0;

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/offers/offer') {
                $count++;
                break;
            }
        }

        while ($xml->next($xml->localName)) {
            $count++;
        }

        return $count;
    }

    /**
     * @throws \Exception
     */
    protected function open()
    {
        $uri = (string)$this->uri;
        if (!$this->XMLReader->open($uri)) {
            throw new \Exception("Failed to open XML file '{$uri}'");
        }

        if (!empty($this->schema)) {
            $schema = $this->schema;
            if (!$this->XMLReader->setSchema($schema)) {
                throw new \Exception("Failed to open XML Schema file '{$schema}'");
            }
        }
    }
    
    protected function close()
    {
        $this->pathArr = [];
        $this->path = '';
        $this->XMLReader->close();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    protected function read()
    {
        $xml = $this->XMLReader;

        if ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && !$xml->isEmptyElement) {
                array_push($this->pathArr, $xml->name);
                $this->path = implode('/', $this->pathArr);
            } elseif ($xml->nodeType == \XMLReader::END_ELEMENT) {
                array_pop($this->pathArr);
                $this->path = implode('/', $this->pathArr);
            }

            return true;
        }

        return false;
    }

    /**
     * @param $type
     * @return SimpleOffer|VendorModelOffer|BookOffer|AudioBookOffer|ArtistTitleOffer|MedicineOffer|EventTicketOffer|TourOffer
     */
    protected function createOffer($type)
    {
        switch ($type) {
            case 'vendor.model':
                return new VendorModelOffer();
            case 'book':
                return new BookOffer();
            case 'audiobook':
                return new AudioBookOffer();
            case 'artist.title':
                return new ArtistTitleOffer();
            case 'medicine':
                return new MedicineOffer();
            case 'event-ticket':
                return new EventTicketOffer();
            case 'tour':
                return new TourOffer();
            default:
                return new SimpleOffer();
        }
    }
}