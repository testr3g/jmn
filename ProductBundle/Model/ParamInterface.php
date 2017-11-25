<?php
namespace Jmn\ProductBundle\Model;

/**
 * ProductsInterface
 *
 * @package ParamBundle
 * @subpackage Model
 * @author N'VEKOUNOU Moise José <jmnvekounou@gmail.com>
*/

interface ParamInterface
{
    /**
    * Get id
    * @return integer
    */
    public function getId();

    /**
     * Set name
     * @param string $name
     * @return Param
     */
    public function setName($name);

    /**
    * Get name
    * @return string
    */
    public function getName();

    /**
    * Set value
    * @param string $value
    * @return Param
    */
    public function setValue($value);

    /**
    * Get value
    * @return string
    */
    public function getValue();

    /**
    * Set reference
    * @param string $reference
    * @return Param
	*/
    public function setReference($reference);

    /**
    * Get reference
    * @return string
    */
    public function getReference();

    /**
    * Set category
    * @param string $category
    * @return Param
    */
    public function setCategory($category);

    /**
    * Get category
    * @return string
    */
    public function getCategory();

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return Param
     */
    public function setUnit($unit);

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit();
}
