<?php

namespace LireinCore\YMLParser;

use LireinCore\YMLParser\Offer\Outlet;
use LireinCore\YMLParser\Offer\Param;

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
     * @var array
     */
    protected $pathLog = [];

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
    public function parse($file = __DIR__ . '/../example.xml')
    {
        $this->open($file);

        $this->file = $file;

        /*$this->XMLReader->setParserProperty(\XMLReader::VALIDATE, true);
        if (!$this->XMLReader->isValid()) {
            throw new \Exception('Invalid XML file');
        }*/

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
     * @return \Generator
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
        $attributes = [];
        $shop = new Shop();

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/currencies') {
                while ($this->read()) {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'currency') {
                        $node = $this->parseSimpleNode('yml_catalog/shop/currencies');
                        $shop->addCurrency((new Currency())->setAttributes($node['attributes']));
                    }
                    elseif ($this->path == 'yml_catalog/shop') {
                        break;
                    }
                }
            }
            elseif ($this->path == 'yml_catalog/shop/categories') {
                while ($this->read()) {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'category') {
                        $node = $this->parseSimpleNode('yml_catalog/shop/categories');
                        $shop->addCategory((new Category())->setAttributes($node['attributes'] + ['name' => $node['value']]));
                    }
                    elseif ($this->path == 'yml_catalog/shop') {
                        break;
                    }
                }
            }
            elseif ($this->path == 'yml_catalog/shop/delivery-options') {
                while ($this->read()) {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'option') {
                        $node = $this->parseSimpleNode('yml_catalog/shop/delivery-options');
                        $shop->addDeliveryOption((new DeliveryOption())->setAttributes($node['attributes']));
                    }
                    elseif ($this->path == 'yml_catalog/shop') {
                        break;
                    }
                }
            }
            elseif ($this->path == 'yml_catalog/shop/offers') {
                $shop->setOffersCount($this->parseOffersCount());
            }
            elseif ($this->path == "yml_catalog/shop/{$xml->name}") {
                $node = $this->parseSimpleNode('yml_catalog/shop');
                $attributes[$node['name']] = $node['value'];
            }
            elseif ($this->path == 'yml_catalog') {
                break;
            }
        }

        $shop->setAttributes($attributes);

        return $shop;
    }

    /**
     * @return \LireinCore\YMLParser\Offer\AOffer
     */
    protected function parseOffer()
    {
        $xml = $this->XMLReader;
        $attributes = $this->parseAttributes();
        $type = isset($attributes['type']) ? $attributes['type'] : null;
        $offer = $this->createOffer($type);

        while ($this->read()) {
            if ($this->path == 'yml_catalog/shop/offers/offer/delivery-options') {
                while ($this->read()) {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'option') {
                        $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer/delivery-options');
                        $offer->addDeliveryOption((new DeliveryOption())->setAttributes($node['attributes']));
                    }
                    elseif ($this->path == 'yml_catalog/shop/offers/offer') {
                        break;
                    }
                }
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/outlets') {
                while ($this->read()) {
                    if ($xml->nodeType == \XMLReader::ELEMENT && $xml->name == 'outlet') {
                        $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer/outlets');
                        $offer->addOutlet((new Outlet())->setAttributes($node['attributes']));
                    }
                    elseif ($this->path == 'yml_catalog/shop/offers/offer') {
                        break;
                    }
                }
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/picture') {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $offer->addPicture($node['value']);
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/barcode') {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $offer->addBarcode($node['value']);
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/param') {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $offer->addParam((new Param())->setAttributes($node['attributes'] + ['value' => $node['value']]));
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/price') {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $attributes[$node['name']] = $node['value'];
                if (isset($node['attributes']['from'])) $attributes['from'] = $node['attributes']['from'];
            }
            elseif ($this->path == 'yml_catalog/shop/offers/offer/age') {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $attributes[$node['name']] = $node['value'];
                if (isset($node['attributes']['unit'])) $attributes['unit'] = $node['attributes']['unit'];
            }
            elseif ($this->path == "yml_catalog/shop/offers/offer/{$xml->name}") {
                $node = $this->parseSimpleNode('yml_catalog/shop/offers/offer');
                $attributes[$node['name']] = $node['value'];
            }
            elseif ($this->path == 'yml_catalog/shop/offers') {
                break;
            }
        }

        $offer->setAttributes($attributes);

        return $offer;
    }

    /*protected function parseCompositeNode($basePath)
    {

    }*/

    /**
     * @param string $basePath
     * @return array
     */
    protected function parseSimpleNode($basePath)
    {
        $xml = $this->XMLReader;
        $name = $xml->name;
        $value = null;

        $attributes = $this->parseAttributes();

        if (!$xml->isEmptyElement) {
            while ($this->read()) {
                if ($xml->nodeType == \XMLReader::TEXT && $xml->hasValue) {
                    $value = $xml->value;
                }
                elseif ($this->path == $basePath) {
                    break;
                }
            }
        }

        return ['name' => $name, 'attributes' => $attributes, 'value' => $value];
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
            throw new \Exception("File {$file} not found");
        }

        if (!$this->XMLReader->open($file)) {
            throw new \Exception('Failed to open file');
        }
    }

    /**
     *
     */
    protected function close()
    {
        $this->pathArr = [];
        $this->path = '';
        $this->pathLog = [];
        $this->XMLReader->close();
    }

    /**
     * @return bool
     */
    protected function read()
    {
        $xml = $this->XMLReader;

        if ($xml->read()) {
            if ($xml->nodeType == \XMLReader::ELEMENT && !$xml->isEmptyElement) {
                array_push($this->pathArr, $xml->name);
                $this->path = implode('/', $this->pathArr);
                $this->pathLog[] = $this->path;
            } elseif ($xml->nodeType == \XMLReader::END_ELEMENT) {
                array_pop($this->pathArr);
                $this->path = implode('/', $this->pathArr);
                $this->pathLog[] = $this->path;
            }

            return true;
        }

        return false;
    }

    /**
     * @param $type
     * @return \LireinCore\YMLParser\Offer\AOffer
     */
    protected function createOffer($type)
    {
        switch ($type) {
            case 'vendor.model':
                return new \LireinCore\YMLParser\Offer\VendorModelOffer();
            case 'book':
                return new \LireinCore\YMLParser\Offer\BookOffer();
            case 'audiobook':
                return new \LireinCore\YMLParser\Offer\AudioBookOffer();
            case 'artist.title':
                return new \LireinCore\YMLParser\Offer\ArtistTitleOffer();
            case 'medicine':
                return new \LireinCore\YMLParser\Offer\MedicineOffer();
            default:
                return new \LireinCore\YMLParser\Offer\SimpleOffer();
        }
    }
}