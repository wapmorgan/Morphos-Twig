# MorphosTwig

[![Composer package](http://xn--e1adiijbgl.xn--p1acf/badge/wapmorgan/morphos-twig)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-twig/version)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![License](https://poser.pugx.org/wapmorgan/morphos-twig/license)](https://packagist.org/packages/wapmorgan/morphos-twig)

Adds a {{ plural }} and {{ name }} filters to Twig templating engine for Russian pluralization and declenation.

```twig
<div>
{{ 'новость' | plural(252) }} от {{ 'Иванов Иван Иванович'|name('genetivus') }}
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
</div>
```

- `{{ $word|plural($count) }}` - Get plural form of word. Just pass count of objects and noun.
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
