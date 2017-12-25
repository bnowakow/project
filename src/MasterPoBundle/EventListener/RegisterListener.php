<?php

namespace MasterPoBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use MasterPoBundle\Entity\Profile;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegisterListener implements EventSubscriberInterface
{
    private $em;

    private $router;

    public function __construct(EntityManager $em, UrlGeneratorInterface $router)
    {
        $this->em = $em;
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirm',
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationSuccess'

        ];
    }

    /**
     * @param UserEvent $event
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function onRegistrationSuccess(UserEvent $event)
    {
        $user = $event->getUser();
        $profile = new Profile();
        $profile->setUser($user);

        $this->em->persist($profile);
        $this->em->flush();

    }

    public function onRegistrationConfirm(GetResponseUserEvent $event)
    {

        $url = $this->router->generate('site_index');

        $event->setResponse(new RedirectResponse($url));
    }
}
