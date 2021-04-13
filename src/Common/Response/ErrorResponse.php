<?php declare(strict_types=1);

namespace Osnova\Api\Common\Response;

/**
 * Class ErrorResponse
 * @package Osnova\Api\Common\Response
 */
class ErrorResponse extends Response
{
    protected Error $error;

    public function __construct($data)
    {
        parent::__construct($data);

        $this->error = new Error(is_object($data) ? $data->error : $data['error']);
    }

    /**
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }
}
