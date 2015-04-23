<?php

namespace AppBundle\Entity\DataProvider;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rule
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Rule
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataProvider\DataProvider")
     * @ORM\JoinColumn(name="data_provider_id", referencedColumnName="id", nullable=false)
     */
    private $dataProvider;

    /**
     * @ORM\Column(name="content_css_selector", type="text")
     */
    private $contentCssSelector;

    /**
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;


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
     * Set contentCssSelector
     *
     * @param string $contentCssSelector
     * @return Rule
     */
    public function setContentCssSelector($contentCssSelector)
    {
        $this->contentCssSelector = $contentCssSelector;

        return $this;
    }

    /**
     * Get contentCssSelector
     *
     * @return string 
     */
    public function getContentCssSelector()
    {
        return $this->contentCssSelector;
    }

    /**
     * Set dataProvider
     *
     * @param \AppBundle\Entity\DataProvider\DataProvider $dataProvider
     * @return Rule
     */
    public function setDataProvider(\AppBundle\Entity\DataProvider\DataProvider $dataProvider = null)
    {
        $this->dataProvider = $dataProvider;

        return $this;
    }

    /**
     * Get dataProvider
     *
     * @return \AppBundle\Entity\DataProvider\DataProvider 
     */
    public function getDataProvider()
    {
        return $this->dataProvider;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Rule
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
}
