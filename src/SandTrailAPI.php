<?php

namespace Iqbalatma\SandTrailDriver;

use GuzzleHttp\Client;

class SandTrailAPI
{
    private $client;
    private $clientId;
    private $secretKey;
    public function __construct($baseUri, $clientId, $secretKey)
    {
        $this->clientId = $clientId;
        $this->secretKey = $secretKey;
        $this->client = new Client([
            'base_uri' => $baseUri
        ]);
    }

    private function getFormattedRequest($requestedData)
    {
        $exception = [];
        if (isset($requestedData["context"]["exception"])) {
            $exceptionObject  = $requestedData["context"]["exception"];
            $exception["message"] = $exceptionObject->getMessage();
            $exception["code"] = $exceptionObject->getCode();
            $exception["file"] = $exceptionObject->getFile();
            $exception["line"] = $exceptionObject->getLine();
            $exception["trace"] = $exceptionObject->getTraceAsString();
            unset($requestedData["context"]["exception"]);
        }
        return [
            "message" => $requestedData["message"],
            "level" => $requestedData["level_name"],
            "env" => $requestedData["channel"],
            "ip_address" => $requestedData["extra"]["ip_address"],
            "client_agent" => $requestedData["extra"]["client_agent"],
            "request_uri" => $requestedData["extra"]["request_uri"],
            "user_id" => $requestedData["extra"]["user_id"],
            "context" => json_encode($requestedData["context"]),
            "exception" => json_encode($exception)
        ];
    }

    public function storeLog($requestedData): void
    {
        $requestedData = $this->getFormattedRequest($requestedData);
        $this->client->post("/api/v1/logs", [
            "headers" => [
                "Accept" => "application/json",
                "ClientId" => $this->clientId,
                "SecretKey" => $this->secretKey
            ],
            "form_params" => $requestedData
        ]);
    }
}
