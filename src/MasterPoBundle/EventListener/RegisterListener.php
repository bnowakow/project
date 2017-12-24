<?php

namespace MasterPoBundle\EventListener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use TopBundle\Entity\Master;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegisterListener implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegistrationSuccess'
        ];
    }

    /**
     * @param UserEvent $event
     * @return string
     */
    public function onRegistrationSuccess(UserEvent $event)
    {
        $request = $event->getRequest();
        $registrationForm = $request->request->get('fos_user_registration_form');
//        $user = $event->getUser();
//        $master = new Master();
//        $master->setUser($user);
//        $master->setEmail($registrationForm['email']);
//        $master->setName($registrationForm['username']);

        $this->em->persist($master);
        $this->em->flush();
    }
}
