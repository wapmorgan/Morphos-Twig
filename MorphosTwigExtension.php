<?php
namespace morphos;

use morphos\Russian\Plurality;

class MorphosTwigExtension extends \Twig_Extension {
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('plural', array($this, 'pluralFilter')),
            new \Twig_SimpleFilter('name', array($this, 'nameFilter')),
        );
    }

    public function pluralFilter($word, $count) {
        return $count.' '.Plurality::pluralize($word, $count);
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
