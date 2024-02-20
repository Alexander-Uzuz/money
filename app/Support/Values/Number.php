<?php

namespace App\Support\Values;

use Stringable;
use InvalidArgumentException;
use App\Support\Values\NumberCast;
use Illuminate\Contracts\Database\Eloquent\Castable;

class Number implements Stringable, Castable
{
    public string $value;

    public function __construct(Number|string|int|float $value = 0)
    {
        if ($value instanceof static) {
            $value = $value->value;
        }

        if (!is_numeric($value)) {
            throw new InvalidArgumentException(
                "Значение [{$value}] должно быть числом",
            );
        }

        $this->value = (string) $value;
    }

    public function add(Number|string|int|float $number = 0, int $scale = null): static
    {
        $number = new static($number);
        $value = bcadd($this->value, $number->value, $scale);
        return new static($value);
    }

    public function sub(Number|string|int|float $number = 0, int $scale = null): static
    {
        $number = new static($number);
        $value = bcsub($this->value, $number->value, $scale);
        return new static($value);
    }

    public function mul(Number|string|int|float $number = 0, int $scale = null): static
    {
        $number = new static($number);
        $value = bcmul($this->value, $number->value, $scale);
        return new static($value);
    }

    public function div(Number|string|int|float $number = 0, int $scale = null): static
    {
        $number = new static($number);
        $value = bcdiv($this->value, $number->value, $scale);
        return new static($value);
    }

    public function eq(Number|string|int|float $number = 0, int $scale = null): bool
    {
        $number = new static($number);
        $result = bccomp($this->value, $number->value, $scale);
        return ($result === 0);
    }

    public function gt(Number|string|int|float $number = 0, int $scale = null): bool
    {
        $number = new static($number);
        $result = bccomp($this->value, $number->value, $scale);
        return ($result === 1);
    }

    public function gte(Number|string|int|float $number = 0, int $scale = null): bool
    {
        return $this->eq($number, $scale) || $this->gt($number, $scale);
    }

    public function lt(Number|string|int|float $number = 0, int $scale = null): bool
    {
        $number = new static($number);
        $result = bccomp($this->value, $number->value, $scale);
        return ($result === -1);
    }

    public function lte(Number|string|int|float $number = 0, int $scale = null): bool
    {
        return $this->eq($number, $scale) || $this->lt($number, $scale);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function castUsing(array $arguments)
    {
        return NumberCast::class;
    }
}
