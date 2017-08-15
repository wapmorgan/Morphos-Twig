<?php
namespace morphos;

use morphos\Russian\CardinalNumeralGenerator;
use morphos\Russian\MoneySpeller;
use morphos\Russian\OrdinalNumeralGenerator;
use morphos\Russian\Plurality;

class MorphosTwigExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('plural', array($this, 'pluralFilter')),
            new \Twig_SimpleFilter('money', array($this, 'moneyFilter')),
            new \Twig_SimpleFilter('numeral', array($this, 'numeralFilter')),
            new \Twig_SimpleFilter('ordinal', array($this, 'ordinalFilter')),
            new \Twig_SimpleFilter('name', array($this, 'nameFilter')),
        );
    }

    public function pluralFilter($word, $count) {
        return \morphos\Russian\pluralize($count, $word);
    }

    public function moneyFilter($value, $currency) {
        return MoneySpeller::spell($value, $currency);
    }

    public function numeralFilter($word, $count = null, $gender = Gender::MALE) {
        if ($count === null) {
            return CardinalNumeralGenerator::getCase($word, Cases::NOMINATIVE);
        } else if (in_array($count, array('m', 'f', 'n'))) {
            return CardinalNumeralGenerator::getCase($word, Cases::NOMINATIVE, $count);
        } else {
            return CardinalNumeralGenerator::getCase($count, Cases::NOMINATIVE, $gender).' '.Plurality::pluralize($word, $count);
        }
    }

    public function ordinalFilter($number, $gender = Gender::MALE) {
        return OrdinalNumeralGenerator::getCase($number, Cases::NOMINATIVE, $gender);
    }

    public function nameFilter($name, $gender = null, $case = null) {
        if ($case === null)
            return \morphos\Russian\inflectName($name, $gender);
        else
            return \morphos\Russian\inflectName($name, $case, $gender);
    }

    public function getName() {
        return 'morphos_twig_extension';
    }
}
