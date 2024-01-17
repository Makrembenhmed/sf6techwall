<?php

namespace testExtention;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TestFilter extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('testimagefilter', [$this, 'defaultImageTest'])
        ];
    }

    public function defaultImageTest(string $path): string
    {
        if (strlen(trim($path)) == 0) {
            return 'm2.jpg';
        }

        return $path;
    }
}