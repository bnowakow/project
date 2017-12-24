<?php

namespace MasterPoBundle\Entity;

use FOS\OAuthServerBundle\Entity\AuthCode as BaseAuthCode;
use FOS\OAuthServerBundle\Model\ClientInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * AuthCode
 */
class AuthCode extends BaseAuthCode
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \MasterPoBundle\Entity\Client
     */
    protected $client;

    /**
     * @var \MasterPoBundle\Entity\User
     */
    protected $user;

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
     * @param ClientInterface|null $client
     * @return $this|void
     */
    public function setClient(ClientInterface $client = null)
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
     * @param UserInterface|null $user
     * @return $this|void
     */
    public function setUser(UserInterface $user = null)
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
