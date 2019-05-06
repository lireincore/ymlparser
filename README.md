# YML (Yandex Market Language) parser

This is the fork of [lirencore\ymlparser](https://github.com/lireincore/ymlparser) with some fixes not merged with main library for the this moment:
- node value "0" should not be replaced with "null",
- the fix for the boolean uppercase-value attribute validation.

## About

[YML (Yandex Market Language)](https://yandex.ru/support/partnermarket/yml/about-yml.xml) streaming parser with validation.
Based on XMLReader. Suitable for large files.

## Install

Add in the `composer.json` file the 
```php
"lireincore/ymlparser": "^3.2"
```
package to your `require` section and 
```php
{
    "type": "git",
    "url": "https://github.com/citysites/ymlparser"
},
```
in `repositories` section

## Usage

```php
use LireinCore\YMLParser\YML;

$yml = new YML();
try {
    $yml->parse($filepath);
    $date = $yml->getDate();
    $shop = $yml->getShop();
    if ($shop->isValid()) {
        $offersCount = $shop->getOffersCount();
        $shopData = $shop->getData();
        //...
        foreach ($yml->getOffers() as $offer) {
            if ($offer->isValid()) {
                $offerCategoryHierarchy = $shop->getCategoryHierarchy($offer->getCategoryId());
                $offerData = $offer->getData();
                //...
            } else {
                var_dump($offer->getErrors());
                //...
            }
        }
    } else {
        var_dump($shop->getErrors());
        //...
    }
} catch (\Exception $e) {
    echo $e->getMessage();
    //...
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
