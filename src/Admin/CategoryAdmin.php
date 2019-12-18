<?php

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CategoryareaType;
use Symfony\Component\Form\Extension\Core\Type\CategoryType;

final class CategoryAdmin extends AbstractAdmin
{
    protected $datagridValues = [
        '_page' => 1,
        '_sort_order' => 'DESC',
        '_sort_by' => 'updated_at',
    ];

    protected function configureRoutes(RouteCollection $collection)
    {
//        $collection
//            ->remove('create')
//            ->remove('delete')
//            ->remove('edit')
//        ;
    }

    protected function configureShowFields(ShowMapper $showMapper)
    {
//        $showMapper
//            ->with('Général', [
//                'class'       => 'col-xs-12 col-lg-6',
//                'box_class'   => 'box box-solid box-info',
//            ])
//            ->add('id', CategoryType::class, ['label' => 'ID', ])
//            ->add('title', CategoryType::class, ['label' => 'Titre', ])
//            ->add('author', CategoryareaType::class, ['label' => 'Auteur', ])
//            ->add('publicationDate', null, ['label' => 'Date de publication',  'widget' => 'single_text',])
//            ->add('createdAt', null, ['label' => 'Crée le',  'widget' => 'single_text',])
//            ->add('updatedAt', null, ['label' => 'Modifié le',  'widget' => 'single_text',])
//            ->add('indexed', null, ['label' => 'Indexé', ])
//        ->end();
//
//        $showMapper->add('body', CategoryareaType::class, ['label' => 'Categorye', ]);
    }

    protected function configureListFields(ListMapper $listMapper)
    {
//        $listMapper
//            ->addIdentifier('title', null, ['label' => 'Titre', 'route' => ['name' => 'show']])
//            ->add('author', null, ['label' => 'Auteur'])
//            ->add('createdAt', 'date', [
//                'label' => 'Créé le',
//                'pattern' => 'dd MMM y G',
//                'locale' => 'fr',
//                'timezone' => 'Europe/Paris',
//            ])
//            ->add('updatedAt', 'date', [
//                'label' => 'Modifié le',
//                'pattern' => 'dd MMM y G',
//                'locale' => 'fr',
//                'timezone' => 'Europe/Paris',
//            ]);
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
//        $datagridMapper->add('title');
//        $datagridMapper->add('status');
    }
}