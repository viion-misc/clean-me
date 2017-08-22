<?php

namespace CleanMe\Entity;

/**
 * Class AbstractEntity
 *
 * @package CleanMe\Entity
 */
class AbstractEntity
{
    /**
     * Returns appropriate values of the model
     */
    public function toArray()
    {
        $reflector = new \ReflectionClass(get_class($this));

        // get properties
        $properties = $reflector->getProperties(\ReflectionProperty::IS_PROTECTED);

        // loop through properties
        $arr = [];
        foreach($properties as $property) {
            $propertyName = $property->name;
            $doc = $reflector
                ->getProperty($propertyName)
                ->getDocComment();

            // parse fields
            $result = [];
            if (preg_match_all('/@(\w+)\s+(.*)\r?\n/m', $doc, $matches)) {
                $result = array_combine($matches[1], $matches[2]);
            }
            // only add those with a var type
            if (isset($result['var'])) {
                if (!$this->{$propertyName}) {
                    continue;
                }
                $var = explode('|', $result['var'])[0];
                $var = strtolower(trim($var));
                // get base type
                switch($var) {
                    // basic
                    case 'string':
                    case 'int':
                    case 'integer':
                    case 'bool':
                    case 'float':
                        $arr[$propertyName] = $this->{$propertyName};
                        break;

                    // if uuid
                    case 'uuid':
                        $arr[$propertyName] = (string)$this->{$propertyName}->toString();
                        break;

                    // if array, need to loop through it
                    case 'array':
                        foreach($this->{$propertyName} as $i => $value) {
                            $arr[$propertyName][] = ($value instanceof AbstractEntity) ? $value->toArray() : $value;
                        }
                        break;

                    // assume a class, get its data
                    default:
                        $arr[$propertyName] = $this->{$propertyName}->toArray();
                        break;
                }
            }
        }

        return $arr;
    }
}