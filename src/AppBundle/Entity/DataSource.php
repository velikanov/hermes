<?php

namespace AppBundle\Entity;

use AppBundle\Entity\DataProvider\DataProvider;
use Doctrine\ORM\Mapping as ORM;

/**
 * DataSource
 *
 * @ORM\Table()
 * @ORM\Entity()
 */
class DataSource
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
     * @var DataProvider
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataProvider\DataProvider", inversedBy="dataSources")
     * @ORM\JoinColumn(name="data_provider_id", referencedColumnName="id")
     */
    private $dataProvider;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RssTemplate")
     * @ORM\JoinColumn(name="rss_template_id", referencedColumnName="id")
     */
    private $rssTemplate;


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
     * @return DataSource
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
     * @return DataSource
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
     * Set dataProvider
     *
     * @param DataProvider $dataProvider
     * @return DataSource
     */
    public function setDataProvider(DataProvider $dataProvider = null)
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    /**
     * Get dataProvider
     *
     * @return DataProvider
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * Set rssTemplate
     *
     * @param RssTemplate $rssTemplate
     * @return DataSource
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
}
