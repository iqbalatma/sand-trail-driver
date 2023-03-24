<?php

namespace Iqbalatma\SandTrailDriver;

use Monolog\Logger;

class SandTrailLogger
{
    public function __invoke($config)
    {
        $httpClient = new SandTrailAPI($config["host"], $config["client_id"], $config["secret_key"]);
        $logger = new Logger("sandtrail");
        $handler = new SandTrailHandler($httpClient, $config["level"]);
        $processor = new SandTrailProcessor();
        $logger->pushHandler($handler);
        $logger->pushProcessor($processor);
        return $logger;
    }
}
