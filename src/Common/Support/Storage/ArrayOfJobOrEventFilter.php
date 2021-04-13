<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\JobOrEventFilter;

/**
 * Class ArrayOfJobOrEventFilter
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfJobOrEventFilter extends ArrayOfModel
{
    public const ENTITY = JobOrEventFilter::class;
}
