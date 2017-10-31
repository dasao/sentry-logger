<?php

namespace Dasao\SentryLogger\Log;

use Interop\Container\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class SentryLoggerConfigFactory
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLoggerConfigFactory implements FactoryInterface
{
    /**
     * Invoke the factory.
     *
     *
     * @param ContainerInterface $container     The DI container.
     * @param string             $requestedName The requested class name.
     * @param null|array         $options       Optional options.
     *
     * @return SentryLoggerConfigInterface
     *
     * @throws ContainerExceptionInterface Error while retrieving the entry.
     * @throws NotFoundExceptionInterface If service was not found in container.
     * @throws ServiceNotCreatedException If sentry config is not available.
     * @throws ReflectionException Error on reflection.
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) : SentryLoggerConfigInterface {
        /** @var array $config */
        $config = $container->get('config');

        if (isset($config['sentry'])) {
            $sentryLoggerConfig = new SentryLoggerConfig();
            $sentryLoggerConfig->exchangeArray($config['sentry']);

            return $sentryLoggerConfig;
        }

        throw new ServiceNotCreatedException('Sentry config not available.');
    }
}
