# MorphosTwig

[![Composer package](http://xn--e1adiijbgl.xn--p1acf/badge/wapmorgan/morphos-twig)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-twig/version)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![License](https://poser.pugx.org/wapmorgan/morphos-twig/license)](https://packagist.org/packages/wapmorgan/morphos-twig)

Adds a {{ plural }} and {{ name }} filters to Twig templating engine for Russian pluralization and declenation.

```twig
<div>
{{ 'новость' | plural(252) }} от {{ 'Иванов Иван Иванович'|name('genetivus') }}
{{ 'рубль'|numeral(5678) }} и {{ 'копейка'|numeral(30) }}
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
пять тысяч шестьсот семьдесят восемь рублей и тридцать копеек
</div>
```

- `{{ $word|plural($count) }}` - Get plural form of word. Just pass count of objects and noun.
- `{{ $number|plural }}` - Get numeral of a number. Just pass number.
- `{{ $number|plural($gender) }}` - Get numeral of a number. Just pass number and gender (m or f or n).
- `{{ $word|plural($number) }}` - Get numeral with a pluralized word. Just pass number and noun.
- `{{ $word|plural($number, $gender) }}` - Get numeral with a pluralized word. Just pass number, noun and gender (m or f or n).
- `{{ $name|name($case) }}` - Get any case of fullname with gender detection.
- `{{ $name|name($gender, $case) }}` - Get any case of fullname. Just pass name, gender (m or w or null) and case (genetivus, dativus, accusative, ablativus, praepositionalis).

## Installation

### Get the Package

```
composer require wapmorgan/morphos-twig
```

### Register the Service
Open up your `services.php` in your `app/config` folder, and add the following lines:

```php
$container
    ->register('morphos.twig_extension', morphos\MorphosTwigExtension::class)
    ->setPublic(false)
    ->addTag('twig.extension');
```

or if you using Twig separately from Symfony

```php
$twig = new Twig_Environment($loader);
$twig->addExtension(new morphos\MorphosTwigExtension());
```
