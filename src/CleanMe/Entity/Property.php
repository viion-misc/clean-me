<?php

namespace CleanMe\Entity;

use Ramsey\Uuid\Uuid;

/**
 * Class Property
 *
 * @package CleanMe\Entity
 */
class Property
{
    const TABLE = 'properties';

    /**
     * @var string
     */
    private $id;
    /**
     * @var int
     */
    private $number;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $numberOfBeds;
    /**
     * @var string
     */
    private $location;
    /**
     * @var int
     */
    private $allowSmoking;
    /**
     * @var int
     */
    private $allowPets;

    /**
     * Property constructor.
     */
    function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Property
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return Property
     */
    public function setNumber($number)
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Property
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumberOfBeds()
    {
        return $this->numberOfBeds;
    }

    /**
     * @param int $numberOfBeds
     * @return Property
     */
    public function setNumberOfBeds($numberOfBeds)
    {
        $this->numberOfBeds = $numberOfBeds;
        return $this;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     * @return Property
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllowSmoking()
    {
        return $this->allowSmoking;
    }

    /**
     * @param int $allowSmoking
     * @return Property
     */
    public function setAllowSmoking($allowSmoking)
    {
        $this->allowSmoking = $allowSmoking;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllowPets()
    {
        return $this->allowPets;
    }

    /**
     * @param int $allowPets
     * @return Property
     */
    public function setAllowPets($allowPets)
    {
        $this->allowPets = $allowPets;
        return $this;
    }
}