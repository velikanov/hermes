<?php

namespace AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ArticleAdmin extends Admin
{
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'dateTime',
    ];

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('url')
            ->add('dateTime')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('title', 'string', [
                    'template' => 'AdminBundle:Article:field/title.html.twig',
                ])
            ->add('dateTime')
            ->add('isRawContentLoaded', 'boolean', [
                    'template' => 'AdminBundle:Article:field/isRawContentLoaded.html.twig',
                ])
            ->add('isContentNormalized', 'boolean', [
                    'template' => 'AdminBundle:Article:field/hasContentParts.html.twig',
                ])
            ->add('hasTranslations', 'boolean', [
                    'template' => 'AdminBundle:Article:field/hasTranslations.html.twig',
                ])
            ->add('hasPublishedTranslations', 'boolean', [
                    'template' => 'AdminBundle:Article:field/hasPublishedTranslations.html.twig',
                ])
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('url')
            ->add('dateTime')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('url')
            ->add('urlHash')
            ->add('dateTime')
            ->add('rawContent')
            ->add('content')
        ;
    }
}
