<?php

namespace App\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyCustumTwigExtention extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('defaultImg', [$this, 'defaultImage'])
        ];
    }

    public function defaultImage(string $path): string
    {
        if (strlen(trim($path)) == 0) {
            return 'm2.jpg';
        }

        return $path;
    }
}