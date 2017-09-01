<?php

namespace Dany\Bundle\DanyBundle\EventListener;

use Dany\Library\CollectionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RequestListener
{
    /**
     * @var CollectionInterface $configuration
     */
    private $configuration;
    /**
     * RequestListener constructor.
     * @param CollectionInterface $configuration
     */
    public function __construct(CollectionInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $routeName = $event->getRequest()->attributes->get('_route');

        foreach ($this->configuration as $configName => $config) {
            $routingConfig = $config->getRoutingConfiguration();

            foreach ($routingConfig as $danyRoute) {
                $normalizedRoute = $danyRoute->normalize($configName);
                if ($normalizedRoute === $routeName) {
                    $this->configuration->setResource($config);

                    if (!$config->hasFlowConfiguration()) {
                        // return response here
                    }
                }
            }
        }

        if (!$this->configuration->hasResource()) {
            return new NotFoundHttpException();
        }
    }
}