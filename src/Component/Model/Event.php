<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Event
 * @package Osnova\Api\Component\Model
 */
class Event extends Model
{
    public int $id;
    public string $title;
    public bool $archived;
    public string $entry_id;
    public string $city_id;
    public string $city_name;
    public string $price;
    public int $date;
    public int $favoritesCount;
    public bool $isFavorited;
    public Company $company;
    public int $interested;
}
