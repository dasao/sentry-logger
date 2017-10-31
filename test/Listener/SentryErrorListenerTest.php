<?php

namespace Dasao\SentryLoggerTest;

use Dasao\SentryLogger\Listener\SentryErrorListener;
use Dasao\SentryLogger\Log\SentryLoggerInterface;
use Exception;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class SentryErrorListenerTest
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLoggerTest
 * @author    Dasao <development@simplicity.ag>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryErrorListenerTest extends TestCase
{
    /** @var SentryErrorListener */
    protected $sentryErrorListener;

    /** @var SentryLoggerInterface|PHPUnit_Framework_MockObject_MockObject */
    protected $sentryLogger;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->sentryLogger = $this->createMock(SentryLoggerInterface::class);

        $this->sentryErrorListener = new SentryErrorListener($this->sentryLogger);
    }

    /**
     * @return void
     */
    public function testInvoke()
    {
        $sentryErrorListener = $this->sentryErrorListener;

        $this->sentryLogger->expects($this->once())->method('exception');

        /** @var Exception $error */
        $error = $this->createMock(Exception::class);
        /** @var ServerRequestInterface $request */
        $request = $this->createMock(ServerRequestInterface::class);
        /** @var ResponseInterface $response */
        $response = $this->createMock(ResponseInterface::class);

        $sentryErrorListener($error, $request, $response);
    }
}