<?php

namespace AppBundle\Entity\Article;

use AppBundle\Entity\DataProvider\Rule;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * ContentPart
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ContentPart
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article\Article", inversedBy="contentParts")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataProvider\Rule")
     * @ORM\JoinColumn(name="data_provider_rule_id", referencedColumnName="id")
     */
    private $dataProviderRule;

    /**
     * @Gedmo\SortablePosition()
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @ORM\Column(name="content", type="text")
     */
    private $content;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set article
     *
     * @param Article $article
     * @return ContentPart
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ContentPart
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set dataProviderRule
     *
     * @param Rule $dataProviderRule
     * @return ContentPart
     */
    public function setDataProviderRule(Rule $dataProviderRule = null)
    {
        $this->dataProviderRule = $dataProviderRule;

        return $this;
    }

    /**
     * Get dataProviderRule
     *
     * @return Rule
     */
    public function getDataProviderRule()
    {
        return $this->dataProviderRule;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return ContentPart
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
