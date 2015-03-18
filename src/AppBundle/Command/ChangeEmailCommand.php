<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ChangeEmailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('changeEmail')
        ->setDescription('Change Email')
        ->addArgument('id',InputArgument::REQUIRED,'User id')
        ->addArgument('email',InputArgument::REQUIRED,'New user email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $id = $input->getArgument('id');
        $email = $input->getArgument('email');
        $repository =  $this->getContainer()->get('user_repository');
        $user = $repository->changeEmail($id,$email);

        if ($user){
            $this->getContainer()->get('logger')->info("User email changed successfully: ".$user->getId()." | ".$user->getName()." | ".$user->getEmail());
            $this->getContainer()->get('marketing_system')->postRequest("User with id ".$user->getID()." had his email changed.");
            $this->getContainer()->get('stats_system')->postRequest("User with id ".$user->getID()." had his email changed.");
        }

        $output->writeln($user ? "User email changed successfully: ".$user->getId()." | ".$user->getName()." | ".$user->getEmail() : "There's no user with id ".$id);
    }
}