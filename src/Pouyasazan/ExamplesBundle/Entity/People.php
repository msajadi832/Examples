<?php

namespace Pouyasazan\ExamplesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as JMS;

/**
 * People
 *
 * @ORM\Table(name="people")
 * @ORM\Entity(repositoryClass="Pouyasazan\ExamplesBundle\Repository\PeopleRepository")
 *
 * @JMS\ExclusionPolicy("all")
 */
class People
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     * @JMS\Expose
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     * @JMS\Expose
     */
    private $age;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     * @JMS\Expose
     */
    private $weight;

    /**
     * @var bool
     *
     * @ORM\Column(name="gender", type="boolean")
     * @JMS\Expose
     */
    private $gender;

    /**
     * @ORM\OneToMany(targetEntity="Book", mappedBy="people")
     */
    private $books;

    public function __construct()
    {

        // your own logic
        $this->books = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return People
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return People
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set weight
     *
     * @param float $weight
     * @return People
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return float 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return People
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Add books
     *
     * @param Book $books
     * @return People
     */
    public function addBook(Book $books)
    {
        $this->books[] = $books;

        return $this;
    }

    /**
     * Remove books
     *
     * @param Book $books
     */
    public function removeBook(Book $books)
    {
        $this->books->removeElement($books);
    }

    /**
     * Get books
     *
     * @return Collection
     */
    public function getBooks()
    {
        return $this->books;
    }
}
