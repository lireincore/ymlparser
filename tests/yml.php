<?php
namespace LireinCore\YMLParser\Test;

class YMLTest extends \PHPUnit_Framework_TestCase
{
    public function testParse()
    {
        $offers = [];
        $yml = new \LireinCore\YMLParser\YML;

        $yml->parse(__DIR__ . DIRECTORY_SEPARATOR . 'example.xml');

        $shop = $yml->getShop();
        
        /**@var \LireinCore\YMLParser\Offer\AOffer[] $offers*/
        foreach ($yml->getOffers() as $offer) {
            $offers[$offer->getId()] = $offer;
        }

        $this->assertCount(2, $shop->getCurrencies());
        $this->assertCount(5, $shop->getCategories());
        $this->assertCount(2, $shop->getDeliveryOptions());
        $this->assertEquals(2, $shop->getOffersCount());
        $this->assertCount(2, $offers);
        $this->assertEquals('7564756475648', $offers[0]->getBarcodes[0]);
        $this->assertCount(7, $offers[0]->getParams());
        $this->assertEquals((float)3045.5, $offers[1]->getPrice());
        $this->assertEquals('http://www.abc.ru/1591.jpg', $offers[1]->getPictures()[1]);
        $this->assertCount(3, $offers[1]->getOutlets());
        $this->assertEquals(20, $offers[1]->getOutlets()[1]->getInstock());
    }
}