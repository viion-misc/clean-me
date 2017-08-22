<?php

namespace CleanMe\Service;

/**
 * Interface ServiceInterface
 *
 * @package CleanMe\Service
 */
interface ServiceInterface
{
    /**
     * @param $entity
     * @return mixed
     */
    public function create($entity);

    /**
     * @return mixed
     */
    public function findAll();
}