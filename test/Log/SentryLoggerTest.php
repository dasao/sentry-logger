<?php

namespace Dasao\SentryLoggerTest\Log;

use Dasao\SentryLogger\Log\SentryLogger;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Raven_Client as SentryClient;

/**
 * Class SentryLoggerTest
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLoggerTest\Log
 * @author    Dasao <development@simplicity.ag>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLoggerTest extends TestCase
{
    /** @var SentryLogger */
    protected $sentryLogger;

    /** @var SentryClient|PHPUnit_Framework_MockObject_MockObject */
    protected $sentryClient;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->sentryClient = $this->createMock(SentryClient::class);

        $this->sentryLogger = new SentryLogger($this->sentryClient);
    }

    /**
     * @return void
     */
    public function testAlert()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'error',
        ]);

        $this->sentryLogger->alert($message, $context);
    }

    /**
     * @return void
     */
    public function testCritical()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'fatal',
        ]);

        $this->sentryLogger->critical($message, $context);
    }

    /**
     * @return void
     */
    public function testDebug()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'debug',
        ]);

        $this->sentryLogger->debug($message, $context);
    }

    /**
     * @return void
     */
    public function testEmergency()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'fatal',
        ]);

        $this->sentryLogger->emergency($message, $context);
    }

    /**
     * @return void
     */
    public function testInfo()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'info',
        ]);

        $this->sentryLogger->info($message, $context);
    }

    /**
     * @return void
     */
    public function testLog()
    {
        $message = 'This is a alert';
        $level = 'custom';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => $level,
        ]);

        $this->sentryLogger->log($level, $message, $context);
    }

    /**
     * @return void
     */
    public function testNotice()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'info',
        ]);

        $this->sentryLogger->notice($message, $context);
    }

    /**
     * @return void
     */
    public function testWarning()
    {
        $message = 'This is a alert';
        $context = [
            'key' => 'value',
        ];
        $this->sentryClient->expects($this->once())->method('captureMessage')->with($message, [
            'extra' => $context,
            'level' => 'warning',
        ]);

        $this->sentryLogger->warning($message, $context);
    }
}