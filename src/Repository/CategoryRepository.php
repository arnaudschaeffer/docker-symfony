<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Class AnnotationTypeRepository
 * @package App\Repository
 */
class CategoryRepository extends NestedTreeRepository
{
    public function __construct(EntityManagerInterface $manager)
    {
        parent::__construct($manager, $manager->getClassMetadata(Category::class));
    }
}
