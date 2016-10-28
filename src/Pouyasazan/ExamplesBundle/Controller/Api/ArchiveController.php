<?php
/**
 * Created by PhpStorm.
 * User: morteza
 * Date: 5/1/16
 * Time: 10:10 AM
 */

namespace Pouyasazan\ExamplesBundle\Controller\Api;


use Doctrine\ORM\EntityManager;
use Pouyasazan\ExamplesBundle\Entity\Book;
use Pouyasazan\ExamplesBundle\Entity\People;
use Pouyasazan\TrainingBundle\Controller\SettingController;
use Pouyasazan\TrainingBundle\Entity\Archive;
use Pouyasazan\TrainingBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;

class ArchiveController extends Controller
{
    const COUNT = 10;

    public function listAction($page = 0)
    {
        /** @var $apiData apiData */
        $apiData = MainApi::start($this);
//        $req = MainApi::checkParams($apiData, array(MainApi::$PAGE));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $totalRes = count($em->getRepository('PouyasazanExamplesBundle:People')->findAll());

        $peoples = $em->createQueryBuilder()
            ->select('people')
            ->from('PouyasazanExamplesBundle:People', 'people')
            ->setFirstResult($page * $this::COUNT)
            ->setMaxResults($this::COUNT)
            ->getQuery()->getResult();

        $res = [];

        /** @var People $people */
        foreach($peoples as $people){
            $res[] = [
                MainApi::ID => $people->getId(),
                MainApi::NAME => $people->getName(),
                MainApi::AGE => $people->getAge(),
                MainApi::WEIGHT => $people->getWeight(),
                MainApi::GENDER => $people->getGender()
            ];
        }

        $apiData->pushResponse([
            MainApi::TOTAL_RESULTS => $totalRes,
            MainApi::TOTAL_PAGES => $totalRes/$this::COUNT,
            MainApi::PAGE => $page,
            MainApi::RESULTS => $res,
        ]);
        return $apiData->sendResponse();
    }

    public function booksAction($id)
    {
        /** @var $apiData apiData */
        $apiData = MainApi::start($this);
//        $req = MainApi::checkParams($apiData, array(MainApi::$PAGE));

        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();

        $people = $em->getRepository('PouyasazanExamplesBundle:People')->find($id);
        if(!$people)
            throw $this->createNotFoundException("Not People");

        $books = $em->getRepository('PouyasazanExamplesBundle:Book')->findBy(['people' => $people]);

        $res = [];

        /** @var Book $book */
        foreach($books as $book){
            $res[] = [
                MainApi::ID => $book->getId(),
                MainApi::NAME => $book->getName(),
                MainApi::GRADE => $book->getGrade(),
                MainApi::PEOPLE => $book->getPeople()->getId()
            ];
        }

        $apiData->pushResponse($res);
        return $apiData->sendResponse();
    }

    public function downloadAction(){
        $path = 'unlocker207.zip';
        $response = new BinaryFileResponse($path);
        return $response;
    }
}