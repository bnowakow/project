<?php

namespace MasterPoBundle\Entity;
use Symfony\Component\HttpFoundation\Request;


/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $slug;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sub_categories;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sub_categories = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Category
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
     * Set nameRu
     *
     * @param string $nameRu
     *
     * @return Category
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
     * @return Category
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
     * @return Category
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
     * Add subCategory
     *
     * @param \MasterPoBundle\Entity\SubCategory $subCategory
     *
     * @return Category
     */
    public function addSubCategory(\MasterPoBundle\Entity\SubCategory $subCategory)
    {
        $this->sub_categories[] = $subCategory;

        return $this;
    }

    /**
     * Remove subCategory
     *
     * @param \MasterPoBundle\Entity\SubCategory $subCategory
     */
    public function removeSubCategory(\MasterPoBundle\Entity\SubCategory $subCategory)
    {
        $this->sub_categories->removeElement($subCategory);
    }

    /**
     * Get subCategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubCategories()
    {
        return $this->sub_categories;
    }


    public function getName()
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

