<?php
namespace Pouyasazan\ExamplesBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Pouyasazan\ExamplesBundle\Entity\Book;
use Pouyasazan\ExamplesBundle\Entity\People;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for($i=1;$i<=100;$i++) {
            $people = $this->people($manager, $i);
            for($j=1;$j<=5;$j++)
                $this->book($manager, $people, $j);
        }
        $manager->flush();


    }

    private function people(ObjectManager $manager, $i){
        $people = new People();
        $people->setName("name ".$i);
        $people->setGender(rand(0,1) == true);
        $people->setAge(rand(10,90));
        $people->setWeight(rand(400,1000)/10.0);
        $manager->persist($people);
        return $people;
    }

    private function book(ObjectManager $manager, People $people, $j){
        $book = new Book();
        $book->setName("book ".$j);
        $book->setGrade(rand(100,2000)/100.0);
        $book->setPeople($people);
        $manager->persist($book);
    }
}