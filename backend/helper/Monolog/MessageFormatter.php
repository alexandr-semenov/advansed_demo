<?php

namespace backend\helper\Monolog;

use Monolog\Formatter\JsonFormatter;
use Monolog\Logger;

/**
 * Class MessageFormatter
 */
class MessageFormatter extends JsonFormatter
{
    /**
     * MessageFormatter constructor.
     */
    public function __construct()
    {
        parent::__construct(self::BATCH_MODE_NEWLINES, true);
    }

    /**
     * @param array $record
     *
     * @return string
     */
    public function format(array $record): string
    {
        return parent::format([
            'dateTime' => $record['datetime']->format('Y-m-d\TH:i:s.uP'),
            'logLevel' => Logger::getLevelName($record['level']),
            'channel' => isset($record['channel']) ? $record['channel'] : null,
            'message' => $record['message'],
            'traceId' => isset($record['traceId']) ? $record['traceId'] : null,
            'context' => isset($record['context']) ? $record['context'] : null,
        ]);
    }
}
