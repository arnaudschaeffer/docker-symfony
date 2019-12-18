<?php
namespace App\Twig;

use App\Entity\AnnotationType;
use App\Entity\Facet;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Solarium\Component\Result\Highlighting\Result as HighlightResult;

class AppExtension extends AbstractExtension
{
    /**
     * @return array|TwigFilter[]
     */
    public function getFilters()
    {
        return [
        ];
    }
}