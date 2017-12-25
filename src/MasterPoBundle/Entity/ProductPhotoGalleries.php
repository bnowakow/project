<?php

namespace MasterPoBundle\Entity;

/**
 * ProductPhotoGalleries
 */
class ProductPhotoGalleries
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \MasterPoBundle\Entity\Product
     */
    private $product;


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
     * Set name
     *
     * @param string $name
     *
     * @return ProductPhotoGalleries
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
     * Set product
     *
     * @param \MasterPoBundle\Entity\Product $product
     *
     * @return ProductPhotoGalleries
     */
    public function setProduct(\MasterPoBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \MasterPoBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}

