<?php

namespace CleanMe\Service;

use CleanMe\Entity\User;

/**
 * Class UserService
 *
 * @package CleanMe\Service
 */
class UserService extends AbstractService implements ServiceInterface
{
    const TABLE = 'users';

    /**
     * @param $user
     * @return bool
     */
    public function create($user)
    {
        // do something with user if you wanted to
        // ...

        // save
        $this->persist($user);
        return true;
    }

    /**
     * @param $name
     * @return array|mixed|null|string
     * @throws \Exception
     */
    public function findOneByLastname($name)
    {
        $res = $this->fetch([
            'lastName' => $name,
        ]);

        $res = $res[0] ?: null;
        if (!$res) {
            throw new \Exception('Could not find user with that last name');
        }

        $user = new User();
        $user->map($res);

        return $user;
    }
}