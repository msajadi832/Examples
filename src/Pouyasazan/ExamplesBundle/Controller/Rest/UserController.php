<?php

namespace Pouyasazan\ExamplesBundle\Controller\Rest;

use Pouyasazan\ExamplesBundle\Entity\User;
use Pouyasazan\ExamplesBundle\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;

class UserController extends FOSRestController
{

    /**
     * Get all the Users
     *
     * @return View
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getRepository("PouyasazanExamplesBundle:User")->findAll();
        return $this->view($users);
    }

    /**
     * Register
     * @var Request $request
     * @return View
     *
     */
    public function registerAction(Request $request){
        $user = new User();
        $form = $this->createForm(new UserType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('fos_user.user_manager')->updateUser($user, true);

            return  $this->view($user);

        }

        return  $this->view($form);
    }


    /**
     * Get a People by ID
     * @param User $user
     *
     * @Extra\ParamConverter("user", class="PouyasazanExamplesBundle:User")
     * @return View
     */
    public function getUserAction(User $user){
        return  $this->view($user);
    }
}
