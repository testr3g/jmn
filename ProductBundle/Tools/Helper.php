<?php

namespace Jmn\ProductBundle\Tools;


class Helper {

	//getting the action by the referer, return the last word of the url
	public static function getAction($referer){
		$aReferer = explode('/',$referer);
		return $aReferer[count($aReferer)-1];
	}

}
