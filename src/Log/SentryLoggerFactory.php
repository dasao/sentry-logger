<?php

namespace Dasao\SentryLogger\Log;

use Interop\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Raven_Client;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SentryLoggerFactory
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLoggerFactory implements FactoryInterface
{
    /**
     * Invoke the factory.
     *
     *
     * @param ContainerInterface $container     The DI container.
     * @param  string            $requestedName The requested class name.
     * @param  null|array        $options       Optional options.
     *
     * @return SentryLoggerInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) : SentryLoggerInterface {
        /** @var SentryLoggerConfigInterface $sentryLoggerConfig */
        $sentryLoggerConfig = $container->get(SentryLoggerConfig::class);

        $sentryClient = new Raven_Client($sentryLoggerConfig->getDsn(), $sentryLoggerConfig->getOptions());

        return new SentryLogger($sentryClient);
    }

}
