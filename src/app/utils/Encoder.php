<?php
namespace app\utils;

class Encoder
{
    public function getJSONEncoddedAnswer(bool $success = false, string $message = '', array $data = []): bool|string
    {
        return json_encode(
            array(
                "success" => $success,
                "message" => $message,
                "data"    => $data
            )
        );

    }
}