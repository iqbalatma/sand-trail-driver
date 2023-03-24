<?php

namespace Iqbalatma\SandTrailDriver;

class SandTrailProcessor
{
    public function __invoke($record)
    {
        $record["extra"] = [
            "user_id" => auth()->id(),
            "ip_address" => request()->getClientIp(),
            "client_agent" => request()->userAgent(),
            "request_uri" => request()->getUri()
        ];

        return $record;
    }
}
