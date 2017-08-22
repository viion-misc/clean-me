<?php

define('CONFIG', __DIR__.'/app/config.yml');

// composer autoloader
require __DIR__.'/vendor/autoload.php';

// get user service
$userService = new \CleanMe\Service\UserService();

// build user A
$userA = new \CleanMe\Entity\User();
$userA->setFirstName('Peter')->setLastName('Johnson');

// build user B
$userB = new \CleanMe\Entity\User();
$userB->setFirstName('Fred')->setLastName('Flimstone');

// create users
$userService->create($userA);
$userService->create($userB);

echo "Created users\n";

// get all users
$users = $userService->findAll();
echo sprintf("There are %s users in the database.\n", count($users));

// get the new user by their last name
echo "Looking for Johnson\n";
$user = $userService->findOneByLastname('Johnson');
echo sprintf("Found: %s %s\n", $user->getFirstName(), $user->getLastName());

// get properties
echo "Getting properties ...\n";
$propertyService = new \CleanMe\Service\PropertyService();

$properties = $propertyService->findAll();
echo sprintf("There are %s properties in the database.\n", count($properties));

// print property details
/** @var \CleanMe\Entity\Property $property */
foreach($properties as $property) {
    echo sprintf("Property %s, sleeps %s, %s cats and %s smoking.\n",
        $property->getName(),
        $property->getNumberOfBeds(),
        $property->getAllowPets() ? 'accepts' : 'does not allow',
        $property->getAllowSmoking() ? 'allows' : 'does not allow'
    );
}