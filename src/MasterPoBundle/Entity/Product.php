<?php

namespace MasterPoBundle\Entity;

/**
 * Product
 */
class Product
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var integer
     */
    private $page_viewed = 0;

    /**
     * @var integer
     */
    private $phone_viewed = 0;

    /**
     * @var boolean
     */
    private $active = true;

    /**
     * @var boolean
     */
    private $top = false;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $price;

    /**
     * @var boolean
     */
    private $exchange = false;

    /**
     * @var boolean
     */
    private $vip = false;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $product_photo_galleries;

    /**
     * @var \MasterPoBundle\Entity\Profile
     */
    private $profile;

    /**
     * @var \MasterPoBundle\Entity\SubCategory
     */
    private $sub_category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product_photo_galleries = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Product
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Product
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set pageViewed
     *
     * @param integer $pageViewed
     *
     * @return Product
     */
    public function setPageViewed($pageViewed)
    {
        $this->page_viewed = $pageViewed;

        return $this;
    }

    /**
     * Get pageViewed
     *
     * @return integer
     */
    public function getPageViewed()
    {
        return $this->page_viewed;
    }

    /**
     * Set phoneViewed
     *
     * @param integer $phoneViewed
     *
     * @return Product
     */
    public function setPhoneViewed($phoneViewed)
    {
        $this->phone_viewed = $phoneViewed;

        return $this;
    }

    /**
     * Get phoneViewed
     *
     * @return integer
     */
    public function getPhoneViewed()
    {
        return $this->phone_viewed;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set top
     *
     * @param boolean $top
     *
     * @return Product
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * Get top
     *
     * @return boolean
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
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
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set exchange
     *
     * @param boolean $exchange
     *
     * @return Product
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;

        return $this;
    }

    /**
     * Get exchange
     *
     * @return boolean
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * Set vip
     *
     * @param boolean $vip
     *
     * @return Product
     */
    public function setVip($vip)
    {
        $this->vip = $vip;

        return $this;
    }

    /**
     * Get vip
     *
     * @return boolean
     */
    public function getVip()
    {
        return $this->vip;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add productPhotoGallery
     *
     * @param \MasterPoBundle\Entity\ProductPhotoGalleries $productPhotoGallery
     *
     * @return Product
     */
    public function addProductPhotoGallery(ProductPhotoGalleries $productPhotoGallery)
    {
        $this->product_photo_galleries[] = $productPhotoGallery;

        return $this;
    }

    /**
     * Remove productPhotoGallery
     *
     * @param \MasterPoBundle\Entity\ProductPhotoGalleries $productPhotoGallery
     */
    public function removeProductPhotoGallery( ProductPhotoGalleries $productPhotoGallery)
    {
        $this->product_photo_galleries->removeElement($productPhotoGallery);
    }

    /**
     * Get productPhotoGalleries
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductPhotoGalleries()
    {
        return $this->product_photo_galleries;
    }

    /**
     * Set profile
     *
     * @param \MasterPoBundle\Entity\Profile $profile
     *
     * @return Product
     */
    public function setProfile(\MasterPoBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \MasterPoBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set subCategory
     *
     * @param \MasterPoBundle\Entity\SubCategory $subCategory
     *
     * @return Product
     */
    public function setSubCategory(\MasterPoBundle\Entity\SubCategory $subCategory = null)
    {
        $this->sub_category = $subCategory;

        return $this;
    }

    /**
     * Get subCategory
     *
     * @return \MasterPoBundle\Entity\SubCategory
     */
    public function getSubCategory()
    {
        return $this->sub_category;
    }
}

