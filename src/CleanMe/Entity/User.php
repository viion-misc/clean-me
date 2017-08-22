<?php

namespace CleanMe\Entity;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

/**
 * Class User
 *
 * @package CleanMe\Entity
 */
class User extends AbstractEntity
{
    const TABLE = 'users';

    /**
     * @var uuid
     */
    private $id;
    /**
     * @var string
     */
    private $prefix;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private $lastName;
    /**
     * @var string
     */
    private $suffix;

    /**
     * User constructor.
     */
    function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /**
     * @param $data
     * @return $this
     */
    public function map($data)
    {
        $data = (Object)$data;

        $converter = new CamelCaseToSnakeCaseNameConverter();

        // map fields
        foreach($data as $field => $value) {
            $field = $converter->denormalize($field);
            $this->{$field} = $value;
        }

        return $this;
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
     * @return User
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return User
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param string $suffix
     * @return User
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
        return $this;
    }
}