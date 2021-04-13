<?php declare(strict_types=1);

namespace Osnova\Api\Component\Model;

/**
 * Class Rates
 * @package Osnova\Api\Component\Model
 */
class Rates extends Model
{
    public Rate $USD; // documented as 'usd'
    public Rate $EUR; // documented as 'eur'
    public Rate $BTC; // documented as 'btc'
    public Rate $ETH; // documented as 'eth'
}
