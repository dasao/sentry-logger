<?php

namespace Dasao\SentryLogger\Log;

use ReflectionClass;
use ReflectionException;

/**
 * Class SentryLoggerConfig
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLoggerConfig implements SentryLoggerConfigInterface
{
    /** @var string */
    protected $dsn;
    /** @var array */
    protected $options;

    /**
     * @return string
     */
    public function getDsn() : string
    {
        return $this->dsn;
    }

    /**
     * @param string $dsn
     *
     * @return void
     */
    public function setDsn(string $dsn)
    {
        $this->dsn = $dsn;
    }

    /**
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return void
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Exchange array to properties.
     *
     * @param array $data The data to exchange.
     *
     * @return void
     * @throws ReflectionException
     */
    public function exchangeArray(array $data)
    {
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties();

        foreach ($properties as $property) {
            $propertyName = $property->getName();

            if (isset($data[$propertyName])) {
                $this->{$propertyName} = $data[$propertyName];
            }
        }
    }
}
