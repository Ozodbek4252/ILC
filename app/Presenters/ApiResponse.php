<?php

namespace App\Presenters;

use Illuminate\Contracts\Support\Jsonable;

class ApiResponse implements Jsonable
{
    /**
     * @var bool
     */
    public bool $success;
    /**
     * @var string
     */
    public mixed $errorMessage = null;
    /**
     * @var int
     */
    public int $errorCode = 0;
    /**
     * @var mixed
     */
    public mixed $data = null;

    /**
     * @param string $errorMessage
     * @param int    $errorCode
     * @return ApiResponse
     */
    public static function getErrorResponse(string $errorMessage, int $errorCode = -1): ApiResponse
    {
        return (new self())->setAsError($errorMessage, $errorCode);
    }

    /**
     * @param mixed $data
     * @return ApiResponse
     */
    public static function getSuccessResponse(mixed $data): ApiResponse
    {
        $instance          = new self();
        $instance->success = true;
        $instance->data    = $data;

        return $instance;
    }

    /**
     * @param string $errorMessage
     * @param int    $errorCode
     * @return $this
     */
    public function setAsError(string $errorMessage, int $errorCode = -1): static
    {
        $this->success      = false;
        $this->errorMessage = $errorMessage;
        $this->errorCode    = $errorCode;

        return $this;
    }

    public function toJson($options = 0): bool|string
    {
        if ($this->success) {
            return json_encode([
                "success" => $this->success,
                "error"   => null,
                "data"    => $this->data,
            ]);
        }

        return json_encode([
            "success" => $this->success,
            "error"   => [
                "message" => $this->errorMessage,
                "code"    => $this->errorCode,
            ],
        ]);
    }
}
