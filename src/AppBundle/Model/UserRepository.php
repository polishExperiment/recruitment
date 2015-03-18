<?php

namespace AppBundle\Model;

/**
 * Created by PhpStorm.
 * User: Radek
 * Date: 31/12/14
 * Time: 12:46
 */
class UserRepository
{
	/** @var \SplObjectStorage|User[] */
	protected $users;

	public function __construct()
	{
		$this->users = new \SplObjectStorage();

		$this->users->attach(new User(1034, 'Rafael', 'rafael@example.com'));
		$this->users->attach(new User(1035, 'Donatello', 'donatello@example.com'));
		$this->users->attach(new User(1036, 'Michelangelo', 'michelangelo@example.com'));
		$this->users->attach(new User(1037, 'Leonardo', 'leonardo@example.com'));
	}

    public function changeEmail($id, $email)
    {
        foreach ($this->users as $user) {
            if ($user->getId() == $id) {
                $this->users->detach($user);
                $user->setEmail($email);
                $this->users->attach($user);
                return $user;
            }
        }
        return false;
    }
}