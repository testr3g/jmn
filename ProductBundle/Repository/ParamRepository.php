<?php
namespace Jmn\ProductBundle\Repository;

/**
 * Class ParamRepository
 * repository methods below.
 */
class ParamRepository extends \Doctrine\ORM\EntityRepository
{
	/*
	* @getTotal
	* Return integer : number of parameters recorded in the database
	*/
	public function getTotal(){
		$query = $this->_em->createQuery('SELECT COUNT(a) From JmnProductBundle:Param a');
		return (int) $query->getSingleScalarResult();
	}
	/*
	* @getValueByReference
	* @param string $sReference
	* Return the parameter value by its reference
	*/
	public function getValueByReference($sReference){
		$aParam=$this->_em->getRepository('JmnProductBundle:Param')->findByReference($sReference);
		if(isset($aParam[0])) return $aParam[0]->getValue();
		return null;
	}
	/*
	* @getValueByName
	* @param string $sName
	* Return the parameter value by its name
	*/
	public function getValueByName($sName){
		$aParam=$this->_em->getRepository('JmnProductBundle:Param')->findByName($sName);
		if(isset($aParam[0])) return $aParam[0]->getValue();
		return null;
	}
	/*
	* @getValueById 
	* @param integer $iId
	* Return the parameter value by its id
	*/
	public function getValueById($id){ 
		$oParam=$this->_em->getRepository('JmnProductBundle:Param')->find($iId);
		if($oParam) return $oParam->getValue();   
	}
	/*
	* @search 
	* @param string $sCriteria
	* Return array of entity param
	*/
	public function search($sCriteria){
		$sSelect = "SELECT v FROM Jmn\ProductBundle\Entity\Param v  WHERE v.name like :motcle or v.reference like :motcle or v.value like :motcle";
		$oQuery =  $this->_em->createQuery($sSelect);	
		$oQuery->setParameters(array(
			'motcle' => "%".$sCriteria."%",
		));	
		$aResult = $oQuery->getResult();
		return $aResult;
	}	
}
