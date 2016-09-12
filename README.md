# YML (Yandex Market Language) parser

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## About

[YML (Yandex Market Language)](https://yandex.ru/support/partnermarket/yml/about-yml.xml) parser for PHP.

## Install

Add the `lireincore/ymlparser` package to your `require` section in the `composer.json` file.

``` bash
$ composer require lireincore/ymlparser
```

## Usage

```php
use LireinCore\YMLParser\YML;

$yml = new YML();
try {
    $yml->parse($filepath);
    $date = $yml->getDate();
    $shop = $yml->getShop();
    /**@var \LireinCore\YMLParser\Offer\AOffer $offer*/
    foreach ($yml->getOffers() as $offer) {
        $offerCategoryHierarchy = $shop->getCategoryHierarchy($offer->getCategoryId);
        //...
    }
} catch (\Exception $e) {
    //...
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.