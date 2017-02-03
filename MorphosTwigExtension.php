<?php
namespace morphos;

use morphos\NumeralCreation;
use morphos\Russian\CardinalNumeral;
use morphos\Russian\Plurality;

class MorphosTwigExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('plural', array($this, 'pluralFilter')),
            new \Twig_SimpleFilter('numeral', array($this, 'numeralFilter')),
            new \Twig_SimpleFilter('name', array($this, 'nameFilter')),
        );
    }

    public function pluralFilter($word, $count) {
        return $count.' '.Plurality::pluralize($word, $count);
    }

    public function numeralFilter($word, $count = null, $gender = NumeralCreation::MALE) {
        if ($count === null) {
            return CardinalNumeral::generate($word);
        } else if (in_array($count, array('m', 'f', 'n'))) {
            return CardinalNumeral::generate($word, $count);
        } else {
            return CardinalNumeral::generate($count, $gender).' '.Plurality::pluralize($word, $count);
        }
    }

    public function nameFilter($name, $gender = null, $case = null) {
        if ($case === null)
            return \morphos\Russian\nameCase($name, $gender);
        else
            return \morphos\Russian\nameCase($name, $case, $gender);
    }

    public function getName() {
        return 'morphos_twig_extension';
    }
}
