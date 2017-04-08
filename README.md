# YML (Yandex Market Language) parser

[![Latest Stable Version](https://poser.pugx.org/lireincore/ymlparser/v/stable)](https://packagist.org/packages/lireincore/ymlparser)
[![Total Downloads](https://poser.pugx.org/lireincore/ymlparser/downloads)](https://packagist.org/packages/lireincore/ymlparser)
[![License](https://poser.pugx.org/lireincore/ymlparser/license)](https://packagist.org/packages/lireincore/ymlparser)

## About

[YML (Yandex Market Language)](https://yandex.ru/support/partnermarket/yml/about-yml.xml) streaming parser with validation.
Based on XMLReader. Suitable for large files.

## Install

Add the `"lireincore/ymlparser": "^3.2"` package to your `require` section in the `composer.json` file

or

``` bash
$ php composer.phar require lireincore/ymlparser
```

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
    //...
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.