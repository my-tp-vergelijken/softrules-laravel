<?php declare(strict_types=1);

namespace SoftRules\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SoftRules\Laravel\SoftRules
 */
final class SoftRules extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SoftRules\Laravel\SoftRules::class;
    }
}
