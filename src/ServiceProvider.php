<?php
declare(strict_types=1);

namespace B2B\Enum;

use B2B\Eloquent\Extensions\Factories\TypesFactory;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package B2B\Eloquent\TypeCasting
 */
class ServiceProvider extends IlluminateServiceProvider
{
    public function register(): void
    {
        $this->app->extend('eloquent.types', function (TypesFactory $factory) {
            return $factory->extend('enum', function ($value, string $class): Enum {
                return new $class(\ctype_digit($value) ? (int) $value : $value);
            }, function ($value) {
                return $value instanceof Enum ? $value->getValue() : (string) $value;
            });
        });
    }
}
