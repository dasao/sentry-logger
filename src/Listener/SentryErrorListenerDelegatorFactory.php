<?php

namespace Dasao\SentryLogger\Listener;

use Dasao\SentryLogger\Log\SentryLogger;
use Dasao\SentryLogger\Log\SentryLoggerConfig;
use Dasao\SentryLogger\Log\SentryLoggerConfigInterface;
use Interop\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;
use Zend\Stratigility\Middleware\ErrorHandler;

/**
 * Class SentryErrorListenerDelegatorFactory
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Listener
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryErrorListenerDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * Invoke the delegator factory.
     *
     * @param ContainerInterface $container The DI container.
     * @param string             $name      The original class name.
     * @param callable           $callback  The callback to get original class.
     * @param array|null         $options   Additional options.
     *
     * @return ErrorHandler
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        array $options = null
    ) : ErrorHandler {
        /** @var SentryLoggerConfigInterface $sentryLoggerConfig */
        $sentryLoggerConfig = $container->get(SentryLoggerConfig::class);

        /** @var ErrorHandler $errorHandler */
        $errorHandler = $callback();

        if ($sentryLoggerConfig->getDsn()) {
            /** @var SentryLogger $sentryLogger */
            $sentryLogger = $container->get(SentryLogger::class);

            $sentryErrorListener = new SentryErrorListener($sentryLogger);
            $errorHandler->attachListener($sentryErrorListener);
        }

        return $errorHandler;
    }
}