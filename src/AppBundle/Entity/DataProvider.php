<?php

namespace AppBundle\Entity;

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


    public function __construct()
    {
        $this->dataSources = new ArrayCollection();
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
     * @param \AppBundle\Entity\DataSource $dataSources
     * @return DataProvider
     */
    public function addDataSource(\AppBundle\Entity\DataSource $dataSources)
    {
        $this->dataSources[] = $dataSources;

        return $this;
    }

    /**
     * Remove dataSources
     *
     * @param \AppBundle\Entity\DataSource $dataSources
     */
    public function removeDataSource(\AppBundle\Entity\DataSource $dataSources)
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
}
