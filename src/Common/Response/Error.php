<?php declare(strict_types=1);

namespace Osnova\Api\Common\Response;

/**
 * Class Error
 * @package Osnova\Api\Common\Response
 */
class Error
{
    protected int $code;
    protected array $info;

    /**
     * @param array $error
     */
    public function __construct(array $error)
    {
        $this->code = $error['code'] ?? 0;
        $this->info = $error['info'] ?? [];
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return array
     */
    public function getInfo(): array
    {
        return $this->info;
    }
}
