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

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Presta\SonataGedmoDoctrineExtensionsBundle\Admin\AbstractTranslatableAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class FAQAdmin extends AbstractTranslatableAdmin
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
    protected $parentAssociationMapping = 'category';

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        if (!$this->isChild()) {
            $datagridMapper->add('category');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        if (!$this->isChild()) {
            $listMapper->add('category');
        }

        $listMapper
            ->add('question')
            ->add('enabled')
            ->add(
                '_action',
                'actions',
                array('actions' => array('edit' => array(), 'delete' => array(), 'show' => array()))
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $filter)
    {
        $filter
            ->add('question')
            ->add('answer')
            ->add('enabled');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $locale = $this->getTranslatableLocale();

        $formMapper
            ->with($this->trans('form.fieldset.label_general'))
                ->add('question', 'text', array(
                    'label' => 'form.label.question',
                    'required' => true,
                    'attr' => array('class' => 'sonata-medium locale locale_' . $locale))
                )
                ->add('answer', 'textarea', array(
                    'label' => 'form.label.answer',
                    'required' => true,
                    'attr' => array('class' => 'wysiwyg sonata-medium locale locale_' . $locale))
                )
                ->add('enabled', null, array('label' => 'form.label.enabled', 'required' => false))
                ->add('position', null, array('label' => 'form.label.position'))
            ->end();
    }
}
