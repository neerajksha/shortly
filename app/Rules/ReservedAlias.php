<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Illuminate\Support\Facades\Route;

class ReservedAlias implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $routes = collect(Route::getRoutes())
            ->map(fn ($route) => trim($route->uri(), '/'))
            ->filter()
            ->map(fn ($uri) => explode('/', $uri)[0])
            ->unique()
            ->toArray();

        if (in_array(strtolower($value), $routes)) {
            $fail('This alias is reserved.');
        }
    }
}
