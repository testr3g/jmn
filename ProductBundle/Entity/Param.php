<?php
namespace Jmn\ProductBundle\Entity;

use 
	Jmn\ProductBundle\Model\Param as BaseParam,
	Doctrine\ORM\Mapping as ORM
;

/**
* @ORM\Entity
* @ORM\Table(name="jmn_param")
* @ORM\Entity(repositoryClass="Jmn\ProductBundle\Repository\ParamRepository")
*/
class Param extends BaseParam
{
    /**
    * @ORM\GeneratedValue
    * @ORM\Id
    * @ORM\Column(type="integer")
    */
    protected $id;
	
}
