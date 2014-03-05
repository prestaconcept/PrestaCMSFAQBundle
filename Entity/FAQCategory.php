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

use Sonata\TranslationBundle\Model\Gedmo\AbstractTranslatable;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\TranslationBundle\Model\TranslatableInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 *
 * @ORM\Table(name="presta_cms_faq_category")
 * @ORM\Entity(repositoryClass="Presta\CMSFAQBundle\Entity\FAQCategory\Repository")
 * @Gedmo\TranslationEntity(class="Presta\CMSFAQBundle\Entity\FAQCategory\Translation")
 */
class FAQCategory extends AbstractTranslatable implements TranslatableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $title
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var boolean $enabled
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=false)
     */
    private $enabled = false;

    /**
     * @var integer $position
     *
     * @ORM\Column(name="position", type="integer", length=2, nullable=true)
     */
    private $position;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Presta\CMSFAQBundle\Entity\FAQCategory\Translation",
     *     mappedBy="object",
     *     cascade={"persist", "remove"}
     * )
     */
    protected $translations;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(
     *     targetEntity="Presta\CMSFAQBundle\Entity\FAQ",
     *     mappedBy="category",
     *     cascade={"persist", "remove"}
     * )
     */
    private $faqs;

    public function __construct()
    {
        parent::__construct();
        $this->faqs  = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }

    /**
     * Returns the user unique id.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param boolean $enabled
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }

    /**
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param ArrayCollection $faqs
     */
    public function setFaqs($faqs)
    {
        $this->faqs = $faqs;
    }

    /**
     * @return ArrayCollection
     */
    public function getFaqs()
    {
        return $this->faqs;
    }

    /**
     * @param FAQ $faq
     */
    public function addFaq(FAQ $faq)
    {
        $faq->setCategory($this);
        $this->faqs->add($faq);
    }

    /**
     * @param FAQ $faq
     */
    public function removeFaq(FAQ $faq)
    {
        $this->faqs->removeElement($faq);
    }
}
