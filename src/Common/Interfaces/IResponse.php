<?php declare(strict_types=1);

namespace Osnova\Api\Common\Interfaces;

use Osnova\Api\Common\Response\Error;
use Osnova\Api\Component\Model\Model;

/**
 * Interface IResponse
 * @package Osnova\Api\Common\Interfaces
 */
interface IResponse
{
    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return null|array|Model|Model[]
     */
    public function getResult();

    /**
     * @return bool
     */
    public function hasError(): bool;

    /**
     * @return Error|null
     */
    public function getError(): ?Error;
}
