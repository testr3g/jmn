<?php 
/* 
* 
*/
namespace Jmn\ProductBundle\Tools\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/** 
* Common controller 
*/
class CommonController extends Controller
{
	protected function getRepository($bundle,$name=null){
		if($name!=null) $sEntity = sprintf("%s:%s",$bundle,$name);
		else $sEntity = $bundle;
		$em = $this->getDoctrine()->getManager();
		return $em->getRepository($sEntity);
	}
	protected function updateEntity($oEntity){
		$em = $this->getDoctrine()->getManager();
		$em->persist($oEntity);
		$em->flush();	
		if($oEntity){
			return $oEntity;
		}else{
			return null;
		}
	}
	protected function removeEntity($oEntity){
		$em = $this->getDoctrine()->getManager();
		$em->remove($oEntity);
		try {
			$res=$em->flush();	
		} catch (Exception $e) {
			return $e->getMessage();
		}
		return $res;
	}

}
