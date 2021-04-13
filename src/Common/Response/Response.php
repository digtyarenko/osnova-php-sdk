<?php declare(strict_types=1);

namespace Osnova\Api\Common\Response;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Model;

/**
 * Class Response
 * @package Osnova\Api\Common\Response
 */
class Response implements IResponse
{
    protected string $message;
    protected $result;

    public function __construct($data)
    {
        if (is_object($data)) {
            $this->message = $data->message ?? '';
            $this->result  = $data->result  ?? [];
        }

        if (is_array($data)) {
            $this->message = $data['message'] ?? '';
            $this->result  = $data['result'] ?? [];
        }
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array|Model|Model[]
     */
    public function getResult()
    {
        return $this->result;
    }
}
