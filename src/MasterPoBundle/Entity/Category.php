<?php

namespace MasterPoBundle\Entity;

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
    private $name;

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
     * Set name
     *
     * @param string $name
     *
     * @return Category
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
}

