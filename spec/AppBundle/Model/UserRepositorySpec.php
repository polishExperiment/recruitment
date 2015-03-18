<?php
/**
 * Created by PhpStorm.
 * User: zwolin
 * Date: 3/18/15
 * Time: 12:57 AM
 */

namespace spec\AppBundle\Model;

use AppBundle\Model\User;
use AppBundle\Model\UserRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserRepositorySpec extends ObjectBehavior
{

    function it_is_initializable()
    {
        $this->shouldHaveType(UserRepository::class);
    }

    function it_changes_email_of_a_user($email, User $user)
    {
        $this->changeEmail(1034, $email)->shouldBeAnInstanceOf(User::class);
        $this->changeEmail(1, $email)->shouldReturn(false);
    }
}