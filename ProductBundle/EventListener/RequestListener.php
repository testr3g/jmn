<?php
namespace BoAdminBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RequestListener
{
	public function onKernelRequest(GetResponseEvent $event)
	{
		$request = $event->getRequest();

		// some logic to determine the $locale
		$request->setLocale($locale);
	}
}