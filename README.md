# MorphosTwig

[![Composer package](http://composer.network/badge/wapmorgan/morphos-twig)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![Latest Stable Version](https://poser.pugx.org/wapmorgan/morphos-twig/version)](https://packagist.org/packages/wapmorgan/morphos-twig)
[![License](https://poser.pugx.org/wapmorgan/morphos-twig/license)](https://packagist.org/packages/wapmorgan/morphos-twig)

Adds {{ plural }}, {{ name }}, {{ numeral }}, {{ ordinal }} and {{ money }} filters to Twig templating engine for Russian pluralization and declenation.

```twig
<div>
{{ 'новость'|plural(252) }} от {{ 'Иванов Иван Иванович'|name('родительный') }}
{{ 'сообщение'|numeral(565, 'n') }} и {{ 123.50|money('₽') }} за Ваше отсутствие
Это Ваше {{ 351|ordinal('n') }} посещение нашего сайта за сегодня!
</div>
```

Will be compiled in

```html
<div>
252 новости от Иванова Ивана Ивановича
пятьсот шестьдесят пять сообщений и 123 рубля 50 копеек за Ваше отсутствие
Это Ваше триста пятьдесят первое посещение нашего сайта за сегодня!
</div>
```

Most popular filters:
- `{{ $word|plural($count) }}` - Get plural form of word. Just pass count of objects and noun.
    ```twig
    {{ 'новость'|plural(251) }}
    ```

- `{{ $value|money($currency) }}` - Get money formatted as text string. Just pass value and currency (₽ or $ or € or ₴ or £).
    ```twig
    {{ 123.50|money('р') }}
    ```

- `{{ $number|numeral }}` - Get cardinal of a number. Just pass number.
    ```twig
    {{ 565|numeral }}
    ```

- `{{ $number|ordinal }}` - Get ordinal of a number. Just pass number.
    ```twig
    {{ 132|ordinal }}
    ```

- `{{ $name|name($case) }}` - Get any case of fullname with gender detection.
    ```twig
    {{ 'Иванов Иван Иванович'|name('родительный') }}
    ```

Additional filters:
- `{{ $name|name($gender, $case) }}` - Get any case of fullname. Just pass name, gender (`m` or `f` or null) and case (именительный, родительный, дательный, винительный, творительный, предложный).
    ```twig
    {{ 'Филимонов Игорь|name('m', 'дательный') }}
    ```

- `{{ $number|numeral($gender) }}` - Get numeral of a number. Just pass number and gender (`m` or `f` or `n`) to use correct form of gender-dependent words (один/одно/одна, два/две).
    ```twig
    {{ 565|numeral('n') }}
    ```

- `{{ $word|numeral($number) }}` - Get numeral with a pluralized word. Just pass number and noun.
    ```twig
    {{ 'дом'|numeral(221) }}
    ```

- `{{ $word|numeral($number, $gender) }}` - Get numeral with a pluralized word. Just pass number, noun and gender (`m` or `f` or `n`) to use correct form of gender-dependent words (один/одно/одна, два/две).
    ```twig
    {{ 'сообщение'|numeral(565, 'n') }}
    ```

- `{{ $number|ordinal($gender) }}` - Get ordinal of a number. Just pass number and gender (`m` or `f` or `n`) to use correct form of gender-dependent words (первый/первое/первая, второй/второе/вторая, etc).
    ```twig
    {{ 'сообщение'|ordinal('n') }}
    ```



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
