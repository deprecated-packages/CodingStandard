<?php

$someClass = new SomeNamespace\SomeClass;

$someClass = new SomeNamespace\SomeClass('ONE');

$someClass = new Exception('Class' . Some::getClassName() . ' not found');

return new Nette\Security\Identity($user->getId(), $user->getRole()->getName());
