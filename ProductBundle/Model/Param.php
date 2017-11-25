<?php

namespace Jmn\ProductBundle\Model;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Param
 *
 * @uses ParamInterface
 * @abstract
 * @package ProductBundle
 * @subpackage Model
 * @author N'VEKOUNOU Moise José <jmnvekounou@gmail.com>
 */

abstract class Param implements ParamInterface
{
    /**
    * @ORM\Column(type="string",length=255)
    */    
    protected $reference;
	
    /**
    * @ORM\Column(type="string",length=255)
    */    
    protected $category;
	
    /**
    * @ORM\Column(type="string",length=255,nullable=true)
    */    
    protected $unit;

    /**
    * @ORM\Column(type="string",length=255)
    */    
    protected $name;
	
    /**
    * @ORM\Column(type="string",length=255)
    */    
    protected $value;

    /**
    * Get id
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     * @param string $name
     * @return Param
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    * Get name
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }

    /**
    * Set value
    * @param string $value
    * @return Param
    */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
    * Get value
    * @return string
    */
    public function getValue()
    {
        return $this->value;
    }

    /**
    * Set reference
    * @param string $reference
    * @return Param
	*/
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
    * Get reference
    * @return string
    */
    public function getReference()
    {
        return $this->reference;
    }

    /**
    * Set category
    * @param string $category
    * @return Param
    */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
    * Get category
    * @return string
    */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Param
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
