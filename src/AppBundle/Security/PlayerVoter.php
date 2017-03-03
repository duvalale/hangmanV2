<?php

namespace AppBundle\Security;

use AppBundle\Entity\Player;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PlayerVoter extends Voter
{
    const AGE_MIN=21;

    protected function supports($attribute, $subject)
    {
        return 'PLAY_GAME' === $attribute;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof Player) {
            return false;
        }

        $age = $user->getBirthday()->diff(new \DateTime())->y;

        return self::AGE_MIN < $age;
    }
}