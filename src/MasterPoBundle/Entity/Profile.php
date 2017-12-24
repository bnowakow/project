<?php

namespace MasterPoBundle\Entity;

/**
 * Profile
 */
class Profile
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $contact_person;

    /**
     * @var integer
     */
    private $phone;

    /**
     * @var boolean
     */
    private $active = true;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var \MasterPoBundle\Entity\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $products;

    /**
     * @var \MasterPoBundle\Entity\City
     */
    private $city;

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
     * Set contactPerson
     *
     * @param string $contactPerson
     *
     * @return Profile
     */
    public function setContactPerson($contactPerson)
    {
        $this->contact_person = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string
     */
    public function getContactPerson()
    {
        return $this->contact_person;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Profile
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Profile
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
     * @return Profile
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
     * Set user
     *
     * @param \MasterPoBundle\Entity\User $user
     *
     * @return Profile
     */
    public function setUser(\MasterPoBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MasterPoBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add product
     *
     * @param \MasterPoBundle\Entity\Product $product
     *
     * @return Profile
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
     * Set city
     *
     * @param \MasterPoBundle\Entity\City $city
     *
     * @return Profile
     */
    public function setCity(\MasterPoBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \MasterPoBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }
}

