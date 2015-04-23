<?php

namespace AdminBundle\Admin;

use Pix\SortableBehaviorBundle\Services\PositionHandler;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class DataProviderRuleAdmin extends Admin
{
    public $last_position = 0;

    /** @var PositionHandler $positionService */
    private $positionService;

    public function setPositionService(PositionHandler $positionHandler)
    {
        $this->positionService = $positionHandler;
    }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_order' => 'ASC',
        '_sort_by' => 'position',
    );

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('move', $this->getRouterIdParameter() . '/move/{position}');
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('dataProvider')
            ->add('contentCssSelector')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $this->last_position = $this->positionService->getLastPosition($this->getRoot()->getClass());

        $listMapper
            ->add('id')
            ->add('dataProvider')
            ->add('title')
            ->add('contentCssSelector')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'move' => array('template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'),
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
            ->add('dataProvider')
            ->add('title')
            ->add('contentCssSelector')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('dataProvider')
            ->add('title')
            ->add('contentCssSelector')
        ;
    }
}
