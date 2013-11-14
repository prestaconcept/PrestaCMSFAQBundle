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
     * @var int
     *
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
     * @var string $answer
     *
     * @Gedmo\Translatable
     * @ORM\Column(name="answer", type="text", nullable=true)
     */
    protected $answer;

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

    public function __toString()
    {
        return (string) $this->getQustion();
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param FAQCategory $category
     */
    public function setCategory(FAQCategory $category)
    {
        $this->category = $category;
    }

    /**
     * @return FAQCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
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
}
