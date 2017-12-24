<?php

namespace MasterPoBundle\Entity;

/**
 * Client
 */
class Client
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $refresh_tokens;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $access_tokens;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $auth_codes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->refresh_tokens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->access_tokens = new \Doctrine\Common\Collections\ArrayCollection();
        $this->auth_codes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add refreshToken
     *
     * @param \MasterPoBundle\Entity\RefreshToken $refreshToken
     *
     * @return Client
     */
    public function addRefreshToken(\MasterPoBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refresh_tokens[] = $refreshToken;

        return $this;
    }

    /**
     * Remove refreshToken
     *
     * @param \MasterPoBundle\Entity\RefreshToken $refreshToken
     */
    public function removeRefreshToken(\MasterPoBundle\Entity\RefreshToken $refreshToken)
    {
        $this->refresh_tokens->removeElement($refreshToken);
    }

    /**
     * Get refreshTokens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRefreshTokens()
    {
        return $this->refresh_tokens;
    }

    /**
     * Add accessToken
     *
     * @param \MasterPoBundle\Entity\AccessToken $accessToken
     *
     * @return Client
     */
    public function addAccessToken(\MasterPoBundle\Entity\AccessToken $accessToken)
    {
        $this->access_tokens[] = $accessToken;

        return $this;
    }

    /**
     * Remove accessToken
     *
     * @param \MasterPoBundle\Entity\AccessToken $accessToken
     */
    public function removeAccessToken(\MasterPoBundle\Entity\AccessToken $accessToken)
    {
        $this->access_tokens->removeElement($accessToken);
    }

    /**
     * Get accessTokens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccessTokens()
    {
        return $this->access_tokens;
    }

    /**
     * Add authCode
     *
     * @param \MasterPoBundle\Entity\AuthCode $authCode
     *
     * @return Client
     */
    public function addAuthCode(\MasterPoBundle\Entity\AuthCode $authCode)
    {
        $this->auth_codes[] = $authCode;

        return $this;
    }

    /**
     * Remove authCode
     *
     * @param \MasterPoBundle\Entity\AuthCode $authCode
     */
    public function removeAuthCode(\MasterPoBundle\Entity\AuthCode $authCode)
    {
        $this->auth_codes->removeElement($authCode);
    }

    /**
     * Get authCodes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthCodes()
    {
        return $this->auth_codes;
    }
}

