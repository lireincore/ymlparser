<?php

namespace LireinCore\YMLParser;

use \LireinCore\YMLParser\Offer\VendorModelOffer;
use \LireinCore\YMLParser\Offer\BookOffer;
use \LireinCore\YMLParser\Offer\AudioBookOffer;
use \LireinCore\YMLParser\Offer\ArtistTitleOffer;
use \LireinCore\YMLParser\Offer\MedicineOffer;
use \LireinCore\YMLParser\Offer\EventTicketOffer;
use \LireinCore\YMLParser\Offer\TourOffer;
use \LireinCore\YMLParser\Offer\SimpleOffer;

class YML
{
    /**
     * @var \XMLReader
     */
    protected $XMLReader;

    /**
     * @var string
     */
    protected $file;

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
     * @param string $file
     * @throws \Exception
     */
    public function parse($file)
    {
        $this->open($file);

        $this->file = $file;

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
        $this->open($this->file);

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/offers') {
                while ($this->read()) {
                    if ($this->path == 'yml_catalog/shop/offers/offer') {
                        yield $this->parseOffer();
                    }
                    elseif ($this->path == 'yml_catalog/shop') {
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
            }
            elseif ($xml->nodeType == \XMLReader::ELEMENT) {
                $nodes[] = $this->parseNode('yml_catalog/shop');
            }
            elseif ($this->path == 'yml_catalog') {
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
        $value = null;
        $nodes = [];

        $attributes = $this->parseAttributes();

        if (!$xml->isEmptyElement) {
            while ($this->read()) {
                if ($xml->nodeType == \XMLReader::ELEMENT) {
                    $nodes[] = $this->parseNode($path);
                }
                elseif ($xml->nodeType == \XMLReader::TEXT && $xml->hasValue) {
                    $value = $xml->value;
                }
                elseif ($this->path == $basePath) {
                    break;
                }
            }
        }

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
     * @param string $file
     * @throws \Exception
     */
    protected function open($file)
    {
        if (!is_file($file)) {
            throw new \Exception("File '{$file}' not found");
        }

        if (!$this->XMLReader->open($file)) {
            throw new \Exception("Failed to open file '{$file}'");
        }
        
        $shemapath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'yml.xsd';
        if (!$this->XMLReader->setSchema($shemapath)) {
            throw new \Exception("Failed to open XML Schema file '{$shemapath}'");
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