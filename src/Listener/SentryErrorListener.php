<?php

namespace Dasao\SentryLogger\Listener;

use Dasao\SentryLogger\Log\SentryLoggerInterface;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

/**
 * Class SentryErrorListener
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLogger\Listener
 * @author    Dasao <info@das-ao.com>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryErrorListener
{
    /** @var SentryLoggerInterface */
    protected $sentryLogger;

    /**
     * SentryErrorListener constructor.
     *
     * @param SentryLoggerInterface $sentryLogger
     */
    public function __construct(SentryLoggerInterface $sentryLogger)
    {
        $this->sentryLogger = $sentryLogger;
    }

    /**
     * Invoke the listener.
     *
     *
     * @param Throwable|Exception    $error    The error.
     * @param ServerRequestInterface $request  The request.
     * @param ResponseInterface      $response The response.
     *
     * @return void
     */
    public function __invoke($error, ServerRequestInterface $request, ResponseInterface $response)
    {
        $context = [
            'method'     => $request->getMethod(),
            'statusCode' => $response->getStatusCode(),
            'uri'        => (string)$request->getUri(),
        ];

        $this->sentryLogger->exception($error, $context);
    }

}
