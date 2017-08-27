<?php

namespace Dany\Bundle\DanyBundle\EventListener;

use Dany\Library\CollectionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

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
        $routeName = $event->getRequest()->attributes->get('_controller');

        dump($routeName);
        die();

        foreach ($this->configuration as $danyAppName => $config) {
            $routingConfig = $config->getRoutingConfiguration();

            foreach ($routingConfig as $danyRoute) {
                if ($danyRoute->normalize($danyAppName) === $routeName) {
                    if (!$config->hasFlowConfiguration()) {

                    }
                }
            }
        }
    }
}