<?php declare(strict_types=1);

namespace Osnova\Api\Common\Response;

use Osnova\Api\Helper\Utils;

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

        if (is_object($data)) {
            $data = Utils::convertObjectToArray($data);
        }

        $this->error = new Error($data);
    }

    /**
     * @return Error
     */
    public function getError(): Error
    {
        return $this->error;
    }
}
