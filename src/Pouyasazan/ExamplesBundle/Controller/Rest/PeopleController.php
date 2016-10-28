<?php

namespace Pouyasazan\ExamplesBundle\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Pouyasazan\ExamplesBundle\Entity\People;
use Pouyasazan\ExamplesBundle\Form\PeopleType;
use Symfony\Component\HttpFoundation\Request;

class PeopleController extends FOSRestController
{
    /**
     * Get all the Peoples
     *
     * @return View
     */
    public function getPeoplesAction()
    {
        $peoples = $this->getDoctrine()->getRepository("PouyasazanExamplesBundle:People")
            ->findAll();

        return $this->view(['peoples' => $peoples]);
    }


    /**
     * Get a People by ID
     * @param People $people
     *
     * @Extra\ParamConverter("people", class="PouyasazanExamplesBundle:People")
     * @return View
     */
    public function getPeopleAction(People $people){
        return  $this->view($people);
    }

    /**
     * Create a new People
     * @var Request $request
     * @return View
     *
     */
    public function postPeopleAction(Request $request)
    {
        $people = new People();
        $form = $this->createForm(new PeopleType(), $people);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($people);
            $em->flush();

            return  $this->view($people);

        }

        return  $this->view(['form' => $form]);
    }



    /**
     * Edit a People
     * Put action
     * @var Request $request
     * @var People $people
     * @return View
     *
     * @Extra\ParamConverter("people", class="PouyasazanExamplesBundle:People")
     */
    public function putPeopleAction(Request $request, People $people)
    {
//        dump($people);
//        dump($request->request->all());
//        die();
        $form = $this->createForm(new PeopleType(), $people);
//
        $form->handleRequest($request);
        $form->submit($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($people);
            $em->flush();

            return  $this->view(['people' => $people]);
        }

        return  $this->view(['form' => $form]);
    }

    /**
     * Delete a People
     * Delete action
     * @var People $people
     * @return View
     *
     * @Extra\ParamConverter("people", class="PouyasazanExamplesBundle:People")
     */
    public function deletePeopleAction(People $people)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($people);
        $em->flush();

        return  $this->view(["status" => "Deleted"]);
    }
}
