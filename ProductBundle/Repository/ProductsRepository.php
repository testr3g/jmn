<?php
/*
* Creation Date : 11/25/2017
* Author: N'VEKOUNOU Moise José
* File name : ProductsRepository.php
* Description: products repository
*/

namespace Jmn\ProductBundle\Repository;

class ProductsRepository extends \Doctrine\ORM\EntityRepository
{
	/*
	* @getTotal
	* Return integer : number of products recorded in the database
	*/
	public function getTotal(){
		$query = $this->_em->createQuery('SELECT COUNT(a) From JmnProductBundle:Products a');
		return (int) $query->getSingleScalarResult();
	}
	/*
	* Search a product in the database by criteria
	* @search 
	* @param string $sCriteria
	* Return array of entity product
	*/
	public function search($criteria){
		$qb = $this->_em->createQueryBuilder();
		$qb->select('a')
			->from('JmnProductBundle:Products', 'a')
			->where("a.creationdate like :criteria or a.name like :criteria or a.description like :criteria" )
			->orderBy('a.id','DESC')
			->setParameters(array('criteria'=>"%".trim($criteria)."%"));
		$query = $qb->getQuery();
		$aResult = $query->getResult();	
		return $aResult;
	}
}
