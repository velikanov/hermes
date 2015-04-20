<?php

namespace AppBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataProvider", inversedBy="dataSources")
     * @ORM\JoinColumn(name="data_provider_id", referencedColumnName="id")
     */
    private $dataProvider;


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
     * @param \AppBundle\Entity\DataProvider $dataProvider
     * @return DataSource
     */
    public function setDataProvider(\AppBundle\Entity\DataProvider $dataProvider = null)
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    /**
     * Get dataProvider
     *
     * @return \AppBundle\Entity\DataProvider 
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }
}
