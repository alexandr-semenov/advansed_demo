<?php

namespace backend\components\util;

use Psr\Log\LoggerInterface;

/**
 * Class Util
 */
class Util
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Util constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $logger->info('create Util object');
    }
}
