<?php

namespace CleanMe\Service;

use CleanMe\Entity\Property;
use CleanMe\Entity\User;

/**
 * Class PropertyService
 *
 * @package CleanMe\Service
 */
class PropertyService extends AbstractService implements ServiceInterface
{
    const TABLE = 'properties';

    /**
     * @param $user
     * @return bool
     */
    public function create($user)
    {
        // dummy
        return true;
    }

    /**
     * This would be in the database, but strapped for time
     * and the logic would be similar to "UserService"
     *
     * @return array
     */
    public function findAll()
    {
        $arr = [];

        // hard coded woo
        $propety = new Property();
        $propety
            ->setNumber(7439)
            ->setName('Craster Reach')
            ->setNumberOfBeds(1)
            ->setAllowSmoking(false)
            ->setAllowPets(true);

        $arr[] = $propety;

        $propety = new Property();
        $propety
            ->setNumber(7439)
            ->setName('Richard House')
            ->setNumberOfBeds(5)
            ->setAllowSmoking(true)
            ->setAllowPets(false);

        $arr[] = $propety;

        return $arr;
    }
}