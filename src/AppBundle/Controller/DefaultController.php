<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/updateEmail/{id}", name="updateEmail")
     */
    public function updateEmailAction($id) {

        $request = $this->get('request');

        if ($request->getMethod() == Request::METHOD_POST) {

            $email = $request->request->get('email');

            if ($user = $this->get('user_repository')->changeEmail($id,$email)){

                $this->get('logger')->info("User email changed successfully: ".$user->getId()." | ".$user->getName()." | ".$user->getEmail());
                $this->get('marketing_system')->postRequest("User with id ".$user->getID()." had his email changed.");
                $this->get('stats_system')->postRequest("User with id ".$user->getID()." had his email changed.");

                return $this->render('default/updateEmail.html.twig',array('user'=>$user));
            }
        }
        return $this->render('default/error.html.twig',array('error'=>"Couldn't change email of a user."));
    }
}
