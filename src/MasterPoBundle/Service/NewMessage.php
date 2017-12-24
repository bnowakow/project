<?php

namespace SadiSam\Service;

use MasterPoBundle\Entity\User;

class NewMessage
{
    protected $twig;
    protected $mailer;

    public function __construct(\Twig_Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;

    }

    /**
     * @param Master $master
     * @param User $user
     * @param string $message
     */
    public function sendToEmailNewMessage(Master $master, User $user, string $message)
    {
        $body = $this->renderTemplate($master, $user);
        $sentMessage = (new \Swift_Message($message))
            ->setFrom('masterpo.com.ua@gmail.com')
            ->setTo($master->getEmail())
            ->setBody($body, 'text/html');

        $this->mailer->send($sentMessage);
    }

    /**
     * @param Master $master
     * @param User $user
     * @return string
     */
    public function renderTemplate(Master $master, User $user)
    {
        return $this->twig->render(
            ':master:emailNewMessage.txt.twig',
            [  
                'title' => $master->getCraft()->getTitle(),
                'masterName' => $master->getName(),
                'userId' => $user->getId(),
                'masterId' => $master->getId()
            ]);

    }
}
