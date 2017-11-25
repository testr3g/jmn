<?php

namespace Jmn\ProductBundle\Entity;


use 
	Jmn\ProductBundle\Model\Products as BaseProducts,
	Doctrine\ORM\Mapping as ORM
;

/**
 * @ORM\Entity
 * @ORM\Table(name="jmn_products")
 * @ORM\Entity(repositoryClass="Jmn\ProductBundle\Repository\ProductsRepository")
*/

class Products extends BaseProducts 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
