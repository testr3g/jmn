<?php

namespace Jmn\ProductBundle\Controller;

use Jmn\ProductBundle\Entity\Products;
use Jmn\ProductBundle\Tools\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 */
class ProductsController extends Controller
{
    /**
     * Lists all product entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aProducts = $em->getRepository('JmnProductBundle:Products')->findAll();

        return $this->render('JmnProductBundle:Products:index.html.twig', array(
            	'products' => $aProducts,
		'message' => $this->getSessionMessage(),//get session message if it exists
		'form'=>$this->getProductFormView(),//get the product form view for the modal creation
        ));
    }

    /**
     * Creates a new product entity.
     *
     */
    public function newAction(Request $request)
    {
	//initialization
	$aMessage = null;
        $oProduct = new Products();

	//Get entity form
        $form = $this->createForm('Jmn\ProductBundle\Form\ProductsType', $oProduct);
        $form->handleRequest($request);

	//Verify if the form is submitted and it is valid  
        if ($form->isSubmitted() && $form->isValid()) {
	    $em = $this->getDoctrine()->getManager();
	    //Verify if the product name is duplicated. If it's not the case then record the data else send a message to view
	    $aProduct = $em->getRepository('JmnProductBundle:Products')->findByName($oProduct->getName());
	    if(count($aProduct)==0){
		$em->persist($oProduct);	
		$em->flush();
		//Verify if the product is really created
		if($oProduct and $oProduct instanceof Products){
			$res = $this->sendMessageFor($oProduct);
			//Format the message to send to view for the sending mail execution
			if($res==1){
				$type = "Success";
				$message = $this->get('translator')->trans('Message sent successfully');
			}else{
				$type = "Warning";
				$this->get('translator')->trans('unable to send the message');
			}
			$this->get('session')->set('message',array('type'=>$type,'texte'=>$message));
			//redirect to list view
                	return $this->redirectToRoute('products_index');
		}else{
			$message = $this->get('translator')->trans('An incident occured during the execution of the request');
			$aMessage = array('type'=>"Warning",'texte'=>$message);
		}
	   }else{
		$message = $this->get('translator')->trans('The name of the product entered already exists');
		$aMessage = array('type'=>"Warning",'texte'=>$message);
	   }	
        }

        return $this->render('JmnProductBundle:Products:new.html.twig', array(
            'product' => $oProduct,
            'form' => $form->createView(),
	    'message'=>$aMessage,
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     */
    public function showAction(Products $oProduct)
    {
        $deleteForm = $this->createDeleteForm($oProduct);

        return $this->render('JmnProductBundle:Products:show.html.twig', array(
            'product' => $oProduct,
	    'form' => $this->getProductFormView($oProduct),//get the product form view for the modal edition
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     */
    public function editAction(Request $request, Products $oProduct)
    {
	//get the edition form by the existing product
        $editForm = $this->createForm('Jmn\ProductBundle\Form\ProductsType', $oProduct);
        $editForm->handleRequest($request);

	//Check if the form is submitted and it is valid
        if($editForm->isSubmitted() && $editForm->isValid()){
	    //Save the data
            $this->getDoctrine()->getManager()->flush();
	    //Get the referer
	    $referer = $request->headers->get('referer');
	    //if the referer is the show page and redirect toward it
	    if($referer!=null and Helper::getAction($referer)=="show") return $this->redirect($referer);
	    //Redirect to the list page
            return $this->redirectToRoute('products_index');
        }
	//render the view when the the form is not submitted or is not valid
        return $this->render('JmnProductBundle:Products:edit.html.twig', array(
            'product' => $oProduct,
            'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     */
    public function deleteAction(Request $request, Products $oProduct)
    {
	//Create the delete form
        $form = $this->createDeleteForm($oProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
	    // Remove the product when the delete form is valid
            $em = $this->getDoctrine()->getManager();
            $em->remove($oProduct);
            $em->flush();
        }
	//Redirect toward the list of product
        return $this->redirectToRoute('products_index');
    }
    /**
     * Search a product using Ajax of Jquery.
     */
    public function searchAction(Request $request)
    {	
		$description = "Televiseur";
		if($request->isXmlHttpRequest())
		{	
			$description = $request->request->get('description');	
		}
            	$em = $this->getDoctrine()->getManager();
		$aResult = $em->getRepository('JmnProductBundle:Products')->search($description);

		if(isset($aResult[0])){
			return $this->render('JmnProductBundle:Products:search.html.twig', array(
				'products'=>$aResult,
				'description'=>$description,
			));				
		}
		return $this->render('JmnProductBundle:Products:search.html.twig', array(
			'criteria' => $description,
		));
    }

    /**
     * Creates a form to delete a product entity.
     * @param Products $oProduct The product entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Products $oProduct)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('products_delete', array('id' => $oProduct->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Creates the form view for a product entity.
     * @return the form view
     * If the parameter $oProduct is null then instanciate the product
     */
	private function getProductFormView($oProduct=null){
		if($oProduct==null) $oProduct = new Products();
		$form = $this->createForm('Jmn\ProductBundle\Form\ProductsType', $oProduct);
            	return $form->createView();
	}
    /**
     * Send mail to a contact
     * @return 1 when everything is correct or 0 else
     */	
	private function sendMessageFor($oProduct)
	{
            	$em = $this->getDoctrine()->getManager();
		//Get the setting
		$oRepParam = $em->getRepository('JmnProductBundle:Param');
		$suject = $oRepParam->getValueByReference("product.mailer.object");
		$from = $oRepParam->getValueByReference("product.mailer.from");
		$to =  $oRepParam->getValueByReference("product.mailer.to");
		//Get mail template
		$body = $this->renderView("JmnProductBundle:Default:mail_template.html.twig", array('product' =>$oProduct,));
		//Initialize Swift_Message 
		$message = \Swift_Message::newInstance()
			->setSubject($suject)
			->setFrom($from)
			->setTo($to)
			->setBody($body);
		//Send the message
		$res = $this->get('mailer')->send($message);
		return $res;
	}
	/*
	* Get session message and remove it. Return message if it exists, null else
	*/ 
	private function getSessionMessage(){
		$session = $this->get('session');
		$message = $session->get('message');
		$session->remove('message');
		return $message;
	}
}
