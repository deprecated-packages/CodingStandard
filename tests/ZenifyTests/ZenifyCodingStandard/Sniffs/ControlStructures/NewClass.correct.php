<?php

$someClass = new SomeNamespace\SomeClass;

$someClass = new SomeNamespace\SomeClass('ONE');

$someClass = new Exception('Class' . Some::getClassName() . ' not found');

$robot->setCacheStorage(new Nette\Caching\Storages\MemoryStorage);

$configurator = new Nette\Configurator;

$basket->setDeletedAt(new \DateTime);
$this->em->getDao(Basket::getClassName())->save($basket);

return new Nette\Security\Identity($user->getId(), $user->getRole()->getName());
