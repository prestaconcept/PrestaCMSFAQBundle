<?php
/**
 * This file is part of the PrestaCMSFAQBundle.
 *
 * (c) PrestaConcept <http://www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSFAQBundle\Block;

use Presta\CMSCoreBundle\Block\BaseModelBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class FAQBlockService extends BaseModelBlockService
{
    /**
     * @var string
     */
    protected $template = 'PrestaCMSFAQBundle:Block:block_faq.html.twig';

    /**
     * @var string
     */
    protected $settingsRoute = 'admin_presta_cmsfaq_faqcategory_list';

    /**
     * @return EntityRepository
     */
    public function getRepository()
    {
        return $this->adminPool->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository('PrestaCMSFAQBundle:FAQCategory');
    }

    /**
     * {@inheritdoc}
     */
    protected function getAdditionalViewParameters(BlockInterface $block)
    {
        $settings = array_merge(
            $this->getDefaultSettings(),
            $block->getSettings()
        );

        return array(
            'faqCategories' => $this->getRepository()->findAll(),
        );
    }
}
