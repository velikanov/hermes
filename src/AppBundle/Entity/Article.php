<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(uniqueConstraints={
 *      @ORM\UniqueConstraint(
 *          columns={
 *              "url_hash"
 *          }
 *      )
 * }, indexes={
 *      @ORM\Index(
 *          columns={
 *              "date_time"
 *          }
 *      )
 * })
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Article
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DataSource")
     * @ORM\JoinColumn(name="data_source_id", referencedColumnName="id")
     */
    private $dataSource;

    /**
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="url", type="text")
     */
    private $url;

    /**
     * @ORM\Column(name="url_hash", type="string", length=32)
     */
    private $urlHash;

    /**
     * @ORM\Column(name="date_time", type="datetime")
     */
    private $dateTime;

    /**
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


    /**
     * @ORM\PrePersist()
     */
    public function generateUrlHash()
    {
        $this->urlHash = md5($this->url);
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
     * @return Article
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
     * Set description
     *
     * @param string $description
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Article
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
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Article
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime 
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Set dataSource
     *
     * @param DataSource $dataSource
     * @return Article
     */
    public function setDataSource(DataSource $dataSource = null)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * Get dataSource
     *
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Set urlHash
     *
     * @param string $urlHash
     * @return Article
     */
    public function setUrlHash($urlHash)
    {
        $this->urlHash = $urlHash;

        return $this;
    }

    /**
     * Get urlHash
     *
     * @return string 
     */
    public function getUrlHash()
    {
        return $this->urlHash;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Article
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
