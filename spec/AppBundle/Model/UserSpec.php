<?php
/**
 * Created by PhpStorm.
 * User: zwolin
 * Date: 3/18/15
 * Time: 12:31 AM
 */

namespace spec\AppBundle\Model;

use AppBundle\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function let($id, $name, $email)
    {
        $this->beConstructedWith($id, $name, $email);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_changes_email($emailOld, $emailNew)
    {
        $this->setEmail($emailOld);
        $this->setEmail($emailNew);
        $this->getEmail()->shouldBeEqualTo($emailNew);
        $this->getEmail()->shouldNotBeEqualTo($emailOld);
    }



}