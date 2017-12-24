<?php

namespace MasterPoBundle\Security\Core\User;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;


class FOSUBUserProvider extends BaseClass
{
    private $em;

    public function __construct(UserManagerInterface $userManager, array $properties, EntityManager $em)
    {
        $this->em = $em;

        parent::__construct($userManager, $properties);
    }

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        $property = $this->getProperty($response);
        $username = $response->getUsername();
        //on connect - get the access token and the user ID
        $service = $response->getResourceOwner()->getName();

        $setter = 'set' . ucfirst($service);
        $setter_id = $setter . 'Id';
        $setter_token = $setter . 'AccessToken';

        //we "disconnect" previously connected users
        if (null !== $previousUser = $this->userManager->findUserBy([$property => $username])) {
            $previousUser->$setter_id(null);
            $previousUser->$setter_token(null);
            $this->userManager->updateUser($previousUser);
        }

        //we connect current user
        $user->$setter_id($username);
        $user->$setter_token($response->getAccessToken());

        $this->userManager->updateUser($user);
    }


    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $username = $response->getUsername();
        $userEmail = $response->getEmail() !== null ? $response->getEmail() : $username;
        $realName = $response->getRealName();

//        $picture = $response->getProfilePicture();

        $findEmail = $this->userManager->findUserByEmail($userEmail);
        $user = $this->userManager->findUserByUsername($username);
        
        //when the user is registrating
        if ($user === null and $findEmail === null) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($username);
            $user->setEmail($userEmail);
            $user->setPassword($username);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);

//            $master = new Master();
//            $master->setName($realName);
//            /** Can be null */
//            $master->setEmail($response->getEmail());
////            $master->setAvatar($picture);
//            $master->setUser($user);
//
//            $this->em->persist($master);
//            $this->em->flush();

            return $user;

        } elseif ($user !== null && $user->isEnabled() === false && $findEmail !== null) {
            $service = $response->getResourceOwner()->getName();
            $user->setEnabled(true);
            $setter = 'set' . ucfirst($service);
            $setter_id = $setter . 'Id';
            $setter_token = $setter . 'AccessToken';
            $user->$setter_id($username);
            $user->$setter_token($response->getAccessToken());
            $this->userManager->updateUser($user);

            return $user;
        }
        // else update access token of existing user
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        $user->$setter($response->getAccessToken());//update access token

        return $user;

    }
}

