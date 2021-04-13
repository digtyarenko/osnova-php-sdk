<?php declare(strict_types=1);

namespace Osnova\Api\Common\Support\Storage;

use Osnova\Api\Component\Model\Vacancy;

/**
 * Class ArrayOfVacancy
 * @package Osnova\Api\Common\Support\Storage
 */
class ArrayOfVacancy extends ArrayOfModel
{
    public const ENTITY = Vacancy::class;
}
