<?php

namespace AppBundle\Entity\DataProvider;

use AppBundle\Entity\DataSource;
use AppBundle\Entity\RssTemplate;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * DataProvider
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class DataProvider
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DataSource", mappedBy="dataProvider")
     */
    private $dataSources;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RssTemplate")
     * @ORM\JoinColumn(name="rss_template_id", referencedColumnName="id", nullable=false)
     */
    private $rssTemplate;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DataProvider\Rule", mappedBy="dataProvider")
     * @ORM\OrderBy({"position" = "ASC"})
     */
    private $rules;


    public function __construct()
    {
        $this->dataSources = new ArrayCollection();
        $this->rules = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->title;
    }

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
     * Set title
     *
     * @param string $title
     * @return DataProvider
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return DataProvider
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Add dataSources
     *
     * @param DataSource $dataSources
     * @return DataProvider
     */
    public function addDataSource(DataSource $dataSources)
    {
        $this->dataSources[] = $dataSources;

        return $this;
    }

    /**
     * Remove dataSources
     *
     * @param DataSource $dataSources
     */
    public function removeDataSource(DataSource $dataSources)
    {
        $this->dataSources->removeElement($dataSources);
    }

    /**
     * Get dataSources
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDataSources()
    {
        return $this->dataSources;
    }

    /**
     * Set rssTemplate
     *
     * @param RssTemplate $rssTemplate
     * @return DataProvider
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
     * Add rules
     *
     * @param Rule $rules
     * @return DataProvider
     */
    public function addRule(Rule $rules)
    {
        $this->rules[] = $rules;

        return $this;
    }

    /**
     * Remove rules
     *
     * @param Rule $rules
     */
    public function removeRule(Rule $rules)
    {
        $this->rules->removeElement($rules);
    }

    /**
     * Get rules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRules()
    {
        return $this->rules;
    }
}
