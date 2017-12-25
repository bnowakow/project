<?php
/**
 * Created by PhpStorm.
 * User: home
 * Date: 14.12.17
 * Time: 23:50
 */

namespace MasterPoBundle\Security;

use MasterPoBundle\Entity\Product;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use MasterPoBundle\Entity\User;

class ProductVoter extends Voter
{
    // these strings are just invented: you can use anything
    const EDIT = 'edit';
    const DELETE = 'delete';
    const CREATE = 'create';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }


    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::DELETE, self::EDIT, self::CREATE))) {
            return false;
        }

        // only vote on BlogPost objects inside this voter
        if (!$subject instanceof Product) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Post object, thanks to supports
        /** @var Product $product*/
        $product = $subject;

        // ROLE_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, ['ROLE_ADMIN'])) {
            return true;
        }

        switch ($attribute) {
            case self::DELETE:
                return $this->canDelete($product , $user);
            case self::EDIT:
                return $this->canEdit($product , $user);
            case self::CREATE:
                return $this->canCreate($product , $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canDelete(Product $product, User $user)
    {
        // if they can edit, they can delete
        if ($this->canEdit($product, $user)) {
            return true;
        }

        // the Post object could have, for example, a method isPrivate()
        // that checks a boolean $private property
        return false;
    }

    private function canCreate(Product $product, User $user)
    {
        // if they can edit, they can Create
        if ($this->canEdit($product, $user)) {
            return true;
        }

        return false;
    }

    private function canEdit(Product $product, User $user)
    {
        return $user === $product->getProfile()->getUser();
    }
}