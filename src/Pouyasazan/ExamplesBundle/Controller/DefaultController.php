<?php

namespace Pouyasazan\ExamplesBundle\Controller;

use Pouyasazan\ExamplesBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PouyasazanExamplesBundle:Default:index.html.twig');
    }

    /**
     * Get a People by ID
     * @param User $user
     *
     * @Extra\ParamConverter("user", class="PouyasazanExamplesBundle:User")
     * @return Response
     */
    public function getUserAction(User $user){
        dump($user);
        return new Response("End");
    }
}
