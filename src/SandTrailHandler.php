<?php

namespace Iqbalatma\SandTrailDriver;

use Monolog\Handler\AbstractProcessingHandler;

/**
 * Summary of SandTrailHandler
 */
class SandTrailHandler extends AbstractProcessingHandler
{
    private $httpClient;
    public function __construct($httpClient, $level)
    {
        parent::__construct($level);
        $this->httpClient = $httpClient;
    }
    /**
     * Summary of write
     * @param mixed $record
     * @return void
     */
    protected function write($record): void
    {
        $this->httpClient->storeLog($record);
    }
}
