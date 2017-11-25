<?php

namespace Jmn\ProductBundle\Model;

/**
 * ProductsInterface
 *
 * @package ProductBundle
 * @subpackage Model
 * @author N'VEKOUNOU Moise José <jmnvekounou@gmail.com>
 */

interface ProductsInterface 
{
    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();


    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
     */
    public function setDescription($description);


    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();


    /**
     * Set price
     *
     * @param string $price
     *
     * @return Products
     */
    public function setPrice($price);

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice();

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     *
     * @return Products
     */
    public function setCreationdate($creationdate);

    /**
     * Get creationdate
     *
     * @return \DateTime
     */
    public function getCreationdate();

    /**
     * Set createdby
     *
     * @param string $createdby
     *
     * @return Products
     */
    public function setCreatedby($createdby);

    /**
     * Get createdby
     *
     * @return string
     */
    public function getCreatedby();

}
