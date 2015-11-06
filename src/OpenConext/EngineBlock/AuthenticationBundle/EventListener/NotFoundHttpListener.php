<?php

namespace OpenConext\EngineBlock\AuthenticationBundle\EventListener;

use EngineBlock_ApplicationSingleton;
use EngineBlock_View;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class NotFoundHttpListener
{
    /**
     * @var EngineBlock_View
     */
    private $engineBlockView;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var EngineBlock_ApplicationSingleton
     */
    private $engineBlockApplicationSingleton;

    /**
     * @param EngineBlock_ApplicationSingleton $engineBlockApplicationSingleton
     * @param EngineBlock_View                  $engineBlockView
     * @param LoggerInterface                   $logger
     */
    public function __construct(
        EngineBlock_ApplicationSingleton $engineBlockApplicationSingleton,
        EngineBlock_View $engineBlockView,
        LoggerInterface $logger
    ) {
        $this->engineBlockApplicationSingleton = $engineBlockApplicationSingleton;
        $this->engineBlockView                 = $engineBlockView;
        $this->logger                          = $logger;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        if (!$exception instanceof NotFoundHttpException) {
            return;
        }

        // inverted quotes for BC, existing log parsers may rely on this
        $this->logger->notice(sprintf(
            "[404]Unroutable URI: '%s'",
            $this->engineBlockApplicationSingleton->getHttpRequest()->getUri()
        ));

        $response = new Response(
            $this->engineBlockView->render('Default/View/Error/NotFound.phtml'),
            404
        );

        $event->setResponse($response);
        // once we've handled it, we don't want anything else to interfere.
        $event->stopPropagation();
    }
}
