<?php

namespace Dasao\SentryLogger\Log;

use Exception;
use Raven_Client as SentryClient;
use Throwable;

/**
 * Class SentryLogger
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Log
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLogger implements SentryLoggerInterface
{
    /** @var SentryClient */
    protected $sentryClient;

    /**
     * SentryLogger constructor.
     *
     * @param SentryClient $sentryClient The sentry client.
     */
    public function __construct(SentryClient $sentryClient)
    {
        $this->sentryClient = $sentryClient;
        $this->sentryClient->install();
    }

    /**
     * Action must be taken immediately.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'error',
        ]);
    }

    /**
     * Critical conditions.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'fatal',
        ]);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'debug',
        ]);
    }

    /**
     * System is unusable.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'fatal',
        ]);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'error',
        ]);
    }

    /**
     * Log the exception.
     *
     * @param Throwable|Exception $exception The Exception to log.
     * @param array               $context   The context data.
     *
     * @return void
     */
    public function exception($exception, array $context = [])
    {
        $this->sentryClient->captureException($exception, $context);
    }

    /**
     * Interesting events.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'info',
        ]);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param string|integer $level   The log level.
     * @param string         $message The message to log.
     * @param array          $context The context data.
     *
     * @return void
     */
    public function log($level, $message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => $level,
        ]);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'info',
        ]);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * @param string $message The message to log.
     * @param array  $context The context data.
     *
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->sentryClient->captureMessage($message, [
            'extra' => $context,
            'level' => 'warning',
        ]);
    }

}
