<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Vacancy
 * @package Osnova\Api\Component\Model
 */
class Vacancy extends Model
{
    public int $id;
    public string $title;
    public string $salary_to;
    public string $salary_from;
    public string $salary_text;
    public int $area;
    public string $area_text;
    public int $schedule;
    public string $schedule_text;
    public int $entry_id;
    public int $city_id;
    public string $city_name;
    public int $favoritesCount;
    public bool $isFavorited;
    public Company $company;
}
