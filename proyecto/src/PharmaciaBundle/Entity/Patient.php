<?php

namespace PharmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Patient
 *
 * @ORM\Table(name="patient")
 * @ORM\Entity(repositoryClass="PharmaciaBundle\Repository\PatientRepository")
 */
class Patient implements \JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var int
     * @Assert\NotBlank
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="idNumber", type="string", length=255)
     */
    private $idNumber;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="idType", type="string", length=255)
     */
    private $idType;

    /**
     * @var string
     * @Assert\NotBlank
     * @ORM\Column(name="observations", type="string", length=255)
     */
    private $observations;


    /**
     * @var arrayColection
     * @ORM\ManyToMany(targetEntity="Analisis", inversedBy="patients")
     * @ORM\JoinTable (name="patient_analisis")
     */
    private $analisis=null;

    public function __construct()
    {
        $this->analisis = new ArrayCollection();
    }

    public function getAnalisis()
    {
        return $this->analisis;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Patient
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Patient
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

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Patient
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set idNumber
     *
     * @param string $idNumber
     *
     * @return Patient
     */
    public function setIdNumber($idNumber)
    {
        $this->idNumber = $idNumber;

        return $this;
    }

    /**
     * Get idNumber
     *
     * @return string
     */
    public function getIdNumber()
    {
        return $this->idNumber;
    }

    /**
     * Set idType
     *
     * @param string $idType
     *
     * @return Patient
     */
    public function setIdType($idType)
    {
        $this->idType = $idType;

        return $this;
    }

    /**
     * Get idType
     *
     * @return string
     */
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return Patient
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    public function jsonSerialize()
    {
        return [
                'id' => $this->getId(),
                'name' => $this->getName(),
                'lastName' => $this->getLastName(),
                'age' => $this->getAge(),
                'idNumber' => $this->getIdNumber(),
                'idType' => $this->getIdType(),
                'observations' => $this->getObservations()
               ];
    }

    public function __toString()
    {
        return $this->name;
    }
}

