<?php

namespace Jmn\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('JmnProductBundle:Default:index.html.twig');
    }
    public function languageAction(Request $request,$_locale)
    {
		//echo $_locale."<br>";
		$this->setUserLocale($_locale);
		$url = $this->getReferer();
		//echo $url;
		//exit(0);
		if(empty($url)) {
			$url = $this->container->get('router')->generate('jmn_product_products');
		}
		return new RedirectResponse($url);
    }
	protected function setUserLocale($_locale){
		$lang = $this->getUserLocale();
		if($lang==null){
			$this->setLang($_locale);
		}
		return;		
	}
	protected function getUserLocale(){
		return $this->get("session")->get("_locale");		
	}
	protected function setLang($lang){
		$this->get("session")->set('_locale',$lang);
		$this->get("session")->set('lang',$lang);
	}
	protected function getReferer(){
	   $request = Request::createFromGlobals();
	   $url = $request->headers->get('referer');
	   return  $url;
	}
}
