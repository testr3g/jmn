<?php

namespace Jmn\ProductBundle\Model;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * Products
 *
 * @uses ProductsInterface
 * @abstract
 * @package ProductBundle
 * @subpackage Model
 * @author N'VEKOUNOU Moise José <jmnvekounou@gmail.com>
 */
abstract class Products implements ProductsInterface
{
    /**
     * @ORM\Column(type="string",length=255)
     */    
    protected $name;
	
    /**
     * @ORM\Column(type="string",length=255)
     */    
    protected $description;
	
    /**
    * @ORM\Column(type="decimal", scale=4)
    */    
    protected $price;	
	
    /**
    * @ORM\Column(type="datetime",nullable=true)
    */    
    protected $creationdate;
	
    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */    
    protected $createdby;
	
    /**
     * Constructor
     */
    public function __construct()
    {
	$this->creationdate=new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Products
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Products
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;

        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Products
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return string
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }
}
