<?php declare(strict_types=1);

namespace Osnova\Api\Common\Params;

/**
 * Class CountOffsetParams
 * @package Osnova\Api\Common\Params
 */
class CountOffsetParams
{
    public int $count;
    public int $offset;

    /**
     * @param int|null $count
     * @param int|null $offset
     */
    public function __construct(int $count = null, int $offset = null)
    {
        if (null !== $count) {
            $this->count = $count;
        }

        if (null !== $offset) {
            $this->offset = $offset;
        }
    }
}
