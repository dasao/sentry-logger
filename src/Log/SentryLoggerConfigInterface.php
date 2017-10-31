<?php

namespace Dasao\SentryLogger\Log;


/**
 * Class SentryLoggerConfigInterface
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
interface SentryLoggerConfigInterface
{
    /**
     * @return string
     */
    public function getDsn() : string;

    /**
     * @return array
     */
    public function getOptions() : array;

    /**
     * @param string $dsn
     *
     * @return void
     */
    public function setDsn(string $dsn);

    /**
     * @param array $options
     *
     * @return void
     */
    public function setOptions(array $options);

    /**
     * Exchange array to properties.
     *
     * @param array $data The data to exchange.
     *
     * @return void
     */
    public function exchangeArray(array $data);
}