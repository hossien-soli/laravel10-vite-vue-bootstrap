<?php

function commonJsonResponse(bool $ok,array|null $data,string|null $message): array
{
    return [
        'ok' => $ok,
        'data' => $data,
        'msg' => $message,
    ];
}
