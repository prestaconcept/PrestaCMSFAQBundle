<?php
/**
 * This file is part of the PrestaCMSFAQBundle
 *
 * (c) PrestaConcept <www.prestaconcept.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Presta\CMSFAQBundle\Entity;

use Presta\SonataGedmoDoctrineExtensionsBundle\Entity\AbstractTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Presta\SonataGedmoDoctrineExtensionsBundle\Entity\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * @ORM\Table(name="presta_cms_faq")
 * @ORM\Entity(repositoryClass="Presta\CMSFAQBundle\Entity\FAQ\Repository")
 * @Gedmo\TranslationEntity(class="Presta\CMSFAQBundle\Entity\FAQ\Translation")
 */
class FAQ extends AbstractTranslatable implements TranslatableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var FAQCategory
     *
     * @ORM\ManyToOne(targetEntity="Presta\CMSFAQBundle\Entity\FAQ", inversedBy="faqs")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $category;

    /**
     * @var string $question
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="question", type="string", length=255, nullable=true)
     */
    protected $question;

    /**
     * @var string $description
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    protected $enabled = false;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="integer", length=2, nullable=true)
     */
    protected $position;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Presta\CMSFAQBundle\Entity\FAQ\Translation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;
}