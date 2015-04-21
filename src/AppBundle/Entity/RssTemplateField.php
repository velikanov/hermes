<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RssTemplateField
 *
 * @ORM\Table(
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              columns={
 *                  "rss_template_id",
 *                  "rss_article_field_id"
 *              }
 *          )
 *      }
 * )
 * @ORM\Entity
 */
class RssTemplateField
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RssTemplate")
     * @ORM\JoinColumn(name="rss_template_id", referencedColumnName="id", nullable=false)
     */
    private $rssTemplate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RssArticleField")
     * @ORM\JoinColumn(name="rss_article_field_id", referencedColumnName="id", nullable=false)
     */
    private $rssArticleField;

    /**
     * @ORM\Column(name="value", type="string", length=50)
     */
    private $value;


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
     * Set value
     *
     * @param string $value
     * @return RssTemplateField
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set rssTemplate
     *
     * @param RssTemplate $rssTemplate
     * @return RssTemplateField
     */
    public function setRssTemplate(RssTemplate $rssTemplate = null)
    {
        $this->rssTemplate = $rssTemplate;

        return $this;
    }

    /**
     * Get rssTemplate
     *
     * @return RssTemplate
     */
    public function getRssTemplate()
    {
        return $this->rssTemplate;
    }

    /**
     * Set rssArticleField
     *
     * @param RssArticleField $rssArticleField
     * @return RssTemplateField
     */
    public function setRssArticleField(RssArticleField $rssArticleField = null)
    {
        $this->rssArticleField = $rssArticleField;

        return $this;
    }

    /**
     * Get rssArticleField
     *
     * @return RssArticleField
     */
    public function getRssArticleField()
    {
        return $this->rssArticleField;
    }
}
