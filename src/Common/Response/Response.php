<?php declare(strict_types=1);

namespace Osnova\Api\Common\Response;

use Osnova\Api\Common\Interfaces\IResponse;
use Osnova\Api\Component\Model\Model;
use Osnova\Api\Helper\Utils;

/**
 * Class Response
 * @package Osnova\Api\Common\Response
 */
class Response implements IResponse
{
    protected string $message;
    protected $result;
    protected Error $error;

    public function __construct($data)
    {
        $this->message = $data['message'] ?? '';
        $this->result  = $data['result'] ?? [];

        if (array_key_exists('error', $data) && null !== $data['error']) {
            if (is_object($data['error'])) {
                $data['error'] = Utils::convertObjectToArray($data['error']);
            }

            $this->error = new Error($data['error']);
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
     * @return null|array|Model|Model[]
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return !empty($this->error);
    }

    /**
     * @return Error|null
     */
    public function getError(): ?Error
    {
        if (!$this->hasError()) {
            return null;
        }

        return $this->error;
    }
}
