<?php
/**
 * This file is part of the PrestaCMSFAQBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSFAQBundle\Entity\FAQ;

use Doctrine\ORM\Mapping as ORM;
use Presta\SonataGedmoDoctrineExtensionsBundle\Entity\AbstractTranslation;

/**
 * @ORM\Entity
 * @ORM\Table(name="presta_cms_faq_translation",
 *     uniqueConstraints={@ORM\UniqueConstraint(name="lookup_unique_faq_translation_idx", columns={
 *         "locale", "object_id", "field"
 *     })}
 * )
 *
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
class Translation extends AbstractTranslation
{
    /**
     * @ORM\ManyToOne(targetEntity="Presta\CMSFAQBundle\Entity\FAQ", inversedBy="translations")
     * @ORM\JoinColumn(name="object_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $object;
}
