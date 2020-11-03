<?php

namespace backend\helper\Monolog;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

/**
 * Class MonologBuilder
 */
class MonologBuilder
{
    /**
     * @return LoggerInterface
     */
    public static function build(): LoggerInterface
    {
        $traceId = bin2hex(random_bytes(16));

        $logger = new Logger('logger');
        $formatter = new MessageFormatter();

        $stream = new StreamHandler(__DIR__ . '/../../runtime/logs/development.log', \Monolog\Logger::DEBUG);
        $stream->setFormatter($formatter);

        $logger->pushHandler($stream);
        $logger->pushHandler(new \Monolog\Handler\FirePHPHandler());
        $logger->pushProcessor(function ($record) use ($traceId) {
           $record['traceId'] = $traceId;
           return $record;
        });

        return $logger;
    }
}
