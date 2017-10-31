<?php

namespace Dasao\SentryLoggerTest\Log;

use Dasao\SentryLogger\Log\SentryLoggerConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class SentryLoggerConfigTest
 *
 * PHP Version 7
 *
 * @category  PHP
 * @package   Dasao\SentryLoggerTest\Log
 * @author    Dasao <development@simplicity.ag>
 * @copyright 2014-2017 Dasao
 * @license   Proprietary http://www.das-ao.com
 */
class SentryLoggerConfigTest extends TestCase
{
    /** @var SentryLoggerConfig */
    protected $sentryLoggerConfig;

    /**
     * @return void
     */
    public function setUp()
    {
        $this->sentryLoggerConfig = new SentryLoggerConfig();
    }

    /**
     * @return void
     */
    public function testOptions()
    {
        $expectedOptions = [
            'key' => 'value',
        ];

        $this->sentryLoggerConfig->setOptions($expectedOptions);
        $actualOptions = $this->sentryLoggerConfig->getOptions();

        $this->assertEquals($expectedOptions, $actualOptions);
    }

    /**
     * @return void
     */
    public function testDsn()
    {
        $expectedDsn = 'https://key:token@sentry.io/123';

        $this->sentryLoggerConfig->setDsn($expectedDsn);
        $actualDsn = $this->sentryLoggerConfig->getDsn();

        $this->assertEquals($expectedDsn, $actualDsn);
    }

    /**
     * Test the exchange array method.
     *
     * @return void
     */
    public function testExchangeArray()
    {
        $expectedDsn = 'https://key:token@sentry.io/123';
        $expectedOptions = ['testkey' => 'testvalue'];

        $exchangeData = [
            'dsn'     => $expectedDsn,
            'options' => $expectedOptions,
        ];

        $this->sentryLoggerConfig->exchangeArray($exchangeData);
        $actualDsn = $this->sentryLoggerConfig->getDsn();
        $actualOptions = $this->sentryLoggerConfig->getOptions();

        $this->assertEquals($expectedDsn, $actualDsn);
        $this->assertEquals($expectedOptions, $actualOptions);
    }

    /**
     * @return void
     */
    public function testWithEmptyDsn()
    {
        $expectedDsn = '';

        $this->sentryLoggerConfig->setDsn($expectedDsn);
        $actualDsn = $this->sentryLoggerConfig->getDsn();

        $this->assertTrue($actualDsn ? false : true);
    }
}