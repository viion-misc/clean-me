<?php

namespace CleanMe\Service;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use CleanMe\Utility\Database\DB;

/**
 * Class AbstractService
 *
 * @package CleanMe\Service
 */
class AbstractService
{
    /**
     * @param $condition
     * @return array|mixed|string
     */
    public function fetch($condition)
    {
        $converter = new CamelCaseToSnakeCaseNameConverter();

        // convert field names automatically
        foreach($condition as $field => $value) {
            unset($condition[$field]);
            $field = $converter->normalize($field);
            $condition[$field] = $value;
        }

        // get data
        $db = new DB();
        $res = $db->fetch(static::TABLE, $condition);
        $db->flush();

        return $res;
    }

    /**
     * find all results for an entity
     */
    public function findAll()
    {
        $db = new DB();
        $res = $db->fetch(static::TABLE);
        $db->flush();

        return $res;
    }

    /**
     * @param $entity
     */
    public function persist($entity)
    {
        // based on: https://symfony.com/doc/current/components/serializer.html
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

        // normalize entity into array data
        $data = $normalizer->normalize($entity);

        // insert
        $db = new DB();
        $db->insert(static::TABLE, $data);
        $db->flush();
    }
}