<?php
/**
 * Created by PhpStorm.
 * User: morteza
 * Date: 10/17/16
 * Time: 9:24 PM
 */

namespace Pouyasazan\ExamplesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Uecode\Bundle\ApiKeyBundle\Entity\ApiKeyUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends ApiKeyUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern     = "/^[a-zA-Z0-9\s]*$/",
     * )
     *
     * @ORM\Column(name="firstName", type="string", length=31)
     */
    private $firstName;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern     = "/^[a-zA-Z0-9\s]*$/",
     * )
     *
     * @ORM\Column(name="lastName", type="string", length=31)
     */
    private $lastName;



    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}
