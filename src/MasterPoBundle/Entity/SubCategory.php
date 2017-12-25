<?php

namespace MasterPoBundle\Entity;

/**
 * SubCategory
 */
class SubCategory
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $product_count = 0;

    /**
     * @var string
     */
    private $name_ru;

    /**
     * @var string
     */
    private $name_ua;

    /**
     * @var boolean
     */
    private $active = true;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \MasterPoBundle\Entity\Category
     */
    private $category;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set productCount
     *
     * @param integer $productCount
     *
     * @return SubCategory
     */
    public function setProductCount($productCount)
    {
        $this->product_count = $productCount;

        return $this;
    }

    /**
     * Get productCount
     *
     * @return integer
     */
    public function getProductCount()
    {
        return $this->product_count;
    }

    /**
     * Set nameRu
     *
     * @param string $nameRu
     *
     * @return SubCategory
     */
    public function setNameRu($nameRu)
    {
        $this->name_ru = $nameRu;

        return $this;
    }

    /**
     * Get nameRu
     *
     * @return string
     */
    public function getNameRu()
    {
        return $this->name_ru;
    }

    /**
     * Set nameUa
     *
     * @param string $nameUa
     *
     * @return SubCategory
     */
    public function setNameUa($nameUa)
    {
        $this->name_ua = $nameUa;

        return $this;
    }

    /**
     * Get nameUa
     *
     * @return string
     */
    public function getNameUa()
    {
        return $this->name_ua;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return SubCategory
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
     * Set slug
     *
     * @param string $slug
     *
     * @return SubCategory
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
     * Add product
     *
     * @param \MasterPoBundle\Entity\Product $product
     *
     * @return SubCategory
     */
    public function addProduct(\MasterPoBundle\Entity\Product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \MasterPoBundle\Entity\Product $product
     */
    public function removeProduct(\MasterPoBundle\Entity\Product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set category
     *
     * @param \MasterPoBundle\Entity\Category $category
     *
     * @return SubCategory
     */
    public function setCategory(\MasterPoBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MasterPoBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        switch(($GLOBALS['request'])->getLocale())
        {
            case 'ru':
                return $this->getNameRu();
            case 'ua':
                return $this->getNameUa();
            default:
                return $this->getNameRu();
        }
    }
}

