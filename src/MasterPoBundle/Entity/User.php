<?php

namespace MasterPoBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $blogPosts;


    /**
     * Add blogPost
     *
     * @param \MasterPoBundle\Entity\BlogPost $blogPost
     *
     * @return User
     */
    public function addBlogPost(\MasterPoBundle\Entity\BlogPost $blogPost)
    {
        $this->blogPosts[] = $blogPost;

        return $this;
    }

    /**
     * Remove blogPost
     *
     * @param \MasterPoBundle\Entity\BlogPost $blogPost
     */
    public function removeBlogPost(\MasterPoBundle\Entity\BlogPost $blogPost)
    {
        $this->blogPosts->removeElement($blogPost);
    }

    /**
     * Get blogPosts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBlogPosts()
    {
        return $this->blogPosts;
    }
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
     * Add refreshToken
     *
     * @param \MasterPoBundle\Entity\RefreshToken $refreshToken
     *
     * @return User
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
     * @return User
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
     * @return User
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
