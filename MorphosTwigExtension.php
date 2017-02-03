<?php
namespace morphos;

use morphos\Russian\nameCase;
use morphos\Russian\Plurality;

class MorphosTwigExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('plural', array($this, 'pluralFilter')),
            new \Twig_SimpleFilter('name', array($this, 'nameFilter')),
        );
    }

    public function pluralFilter($count, $word) {
        return Plurality::pluralize($word, $count);
    }

    public function nameFilter($name, $gender, $case) {
        return nameCase($name, $case, $gender);
    }

    public function getName() {
        return 'morphos_twig_extension';
    }
}
