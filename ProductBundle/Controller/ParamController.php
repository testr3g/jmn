<?php

namespace Jmn\ProductBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jmn\ProductBundle\Entity\Param;
use Jmn\ProductBundle\Form\ParamType;
use Jmn\ProductBundle\Tools\Helper;
use Jmn\ProductBundle\Form\ParamTypeEdit;

/**
* Param controller.
*/
class ParamController extends Controller
{

    /**
    * Lists all Param entities.
    */
    public function indexAction()
    {	
        $em = $this->getDoctrine()->getManager();
        $aParams = $em->getRepository('JmnProductBundle:Param')->findBy(array(),array('id' => 'desc'));
	//create the form 
        $form = $this->createForm('Jmn\ProductBundle\Form\ParamType', new Param());

        return $this->render('JmnProductBundle:Param:index.html.twig', array(
            	'params' => $aParams,
		'form' => $form->createView(),
        ));
    } 
    /**
    * Creates a new Param entity.
    */
    public function newAction(Request $request)
    {
	$aMessage = null;
        $oParam = new Param();
        $form = $this->createForm('Jmn\ProductBundle\Form\ParamType', $oParam);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        	$em = $this->getDoctrine()->getManager();
	    //Verify if the product name is duplicated. If it's not the case then record the data else send a message to view
	    $aParam = $em->getRepository('JmnProductBundle:Param')->findByName($oParam->getName());
	    if(!isset($aParam[0])){
 		$em->persist($oParam);	
		$em->flush();
		if($oParam and $oParam instanceof Param){
			return $this->redirectToRoute('param_index');	
		}else{
			$message = $this->get('translator')->trans('An incident occured during the execution of the request');
			$aMessage = array('type'=>"Warning",'texte'=>$message);
		}
	   }else{
		$message = $this->get('translator')->trans('The name of the product entered already exists');
		$aMessage = array('type'=>"Warning",'texte'=>$message);
	   }			
        }
        return $this->render('JmnProductBundle:Param:new.html.twig', array(
            'param' => $oParam,
	    'message' => $aMessage,
            'form' => $form->createView(),
        ));
    }

    /**
    * Finds and displays a Param entity.
    */
    public function showAction(Param $oParam)
    {
        $deleteForm = $this->createDeleteForm($oParam);
	$duplicate_form = $this->createForm('Jmn\ProductBundle\Form\ParamType', $oParam);
        $edit_form = $this->createForm('Jmn\ProductBundle\Form\ParamTypeEdit', $oParam);
		
        return $this->render('JmnProductBundle:Param:show.html.twig', array(
            	'param' => $oParam,
		'edit_form' => $edit_form->createView(),
		'form' => $duplicate_form->createView(),
            	'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Displays a form to edit an existing Param entity.
    */
    public function editAction(Request $request, Param $oParam)
    {
        $editForm = $this->createForm('Jmn\ProductBundle\Form\ParamTypeEdit', $oParam);
        $editForm->handleRequest($request);

        if($editForm->isSubmitted() && $editForm->isValid()) {
	    //Save the data
            $this->getDoctrine()->getManager()->flush();
	    //Get the referer
	    $referer = $request->headers->get('referer');
	    //if the referer is the show page and redirect toward it
	    if($referer!=null and Helper::getAction($referer)=="show") return $this->redirect($referer);
            return $this->redirectToRoute('param_index');
        }

        return $this->render('JmnProductBundle:Param:edit.html.twig', array(
            'param' => $oParam,
            'edit_form' => $editForm->createView(),
        ));
    }
    /**
    * Search a param.
    */
    public function searchAction(Request $request)
    {
		$description=null;
		$oEntity = $this->getDoctrine()->getManager()->getRepository('JmnProductBundle:Param');	
		if($request->isXmlHttpRequest())
		{	
			$description = $request->request->get('description');	
		}
		$aResult = $oEntity ->search($description);
		if(isset($aResult[0])){
			return $this->render('JmnProductBundle:Param:search.html.twig', array(
				'params'=>$aResult,
				'count'=>count($aResult),
				'description'=>$description,
			));				
		}
		return $this->render('JmnProductBundle:Param:search.html.twig', array(
			'criteria' => $description,
		));
    }
    /**
    * Deletes a Param entity.
    */
    public function deleteAction(Request $request, Param $param)
    {
        $form = $this->createDeleteForm($param);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($param);
            $em->flush();
        }

        return $this->redirectToRoute('param_index');
    }

    /**
     * Creates a form to delete a Param entity.
     * @param Param $param The Param entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Param $param)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('param_delete', array('id' => $param->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
