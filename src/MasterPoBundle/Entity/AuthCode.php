<?php

namespace MasterPoBundle\Entity;

/**
 * AuthCode
 */
class AuthCode
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \MasterPoBundle\Entity\Client
     */
    private $client;

    /**
     * @var \MasterPoBundle\Entity\User
     */
    private $user;


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
     * Set client
     *
     * @param \MasterPoBundle\Entity\Client $client
     *
     * @return AuthCode
     */
    public function setClient(\MasterPoBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \MasterPoBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set user
     *
     * @param \MasterPoBundle\Entity\User $user
     *
     * @return AuthCode
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
}
