<?php

/**
 * @ORM\Entity
 * @ORM\Table(name="test")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="text")
 * @ORM\DiscriminatorMap({
 *                "complex" = "Test1",
 *                "simple" = "Test2"
 * })
 */
class Test{

}