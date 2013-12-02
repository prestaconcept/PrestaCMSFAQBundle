<?php
/**
 * This file is part of the PrestaCMSFAQBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSFAQBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Presta\SonataGedmoDoctrineExtensionsBundle\Admin\AbstractTranslatableAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class FAQCategoryAdmin extends Admin
{
    /**
     * The translation domain to be used to translate messages
     *
     * @var string
     */
    protected $translationDomain = 'PrestaCMSFAQBundle';

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with($this->trans('form.fieldset.label_general'))
                ->add('title', 'text', array('required' => true, 'attr' => array('class' => 'sonata-medium locale')))
                ->add('enabled', null, array('label' => 'form.label.enabled', 'required' => false))
                ->add('position', null, array('label' => 'form.label.position'))
            ->end();
    }

    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->with($this->trans('form.fieldset.label_general'))
                ->add('title')
                ->add('enabled')
                ->add('position')
            ->end();
    }


    /**
     * {@inheritdoc}
     */
    protected function configureSideMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ($id > 0) {
            $menu->addChild(
                $this->trans('sidemenu.link_faq_category_edit'),
                array('uri' => $admin->generateUrl('edit', array('id' => $id)))
            );
            $menu->addChild(
                $this->trans('sidemenu.link_faq_list'),
                array('uri' => $admin->generateUrl('presta_cms_faq.admin.faq.list', array('id' => $id)))
            );
        }
    }
}
