<?php

namespace Dasao\SentryLogger\Log;

use Exception;
use Psr\Log\LoggerInterface;
use Throwable;

/**
 * Interface SentryLoggerInterface
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
interface SentryLoggerInterface extends LoggerInterface
{
    /**
     * Log the exception.
     *
     * @param Throwable|Exception $exception The Exception to log.
     * @param array               $context   The context data.
     *
     * @return void
     */
    public function exception($exception, array $context = []);

}