<?php declare(strict_types=1);

namespace Osnova\Api\Service\Entry\Params;

use Osnova\Api\Service\Entry\Enum\TypeEnum;

/**
 * Class IdTypeParams
 * @package Osnova\Api\Service\Entry\Params
 */
class IdTypeParams
{
    public int $id;
    public TypeEnum $type;

    /**
     * @param int|null $id
     * @param TypeEnum|null $type
     */
    public function __construct(int $id = null, TypeEnum $type = null)
    {
        if (null !== $id) {
            $this->id = $id;
        }

        if (null !== $type) {
            $this->type = $type;
        }
    }
}
