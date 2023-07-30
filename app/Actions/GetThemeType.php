<?php

namespace App\Actions;

class GetThemeType
{
    public array $types = ['primary', 'success', 'info', 'danger', 'warning'];

    public int $seed;

    public function handle($format = '?', $seed = '')
    {
        $this->seed = crc32($seed);

        return str_replace('?', $this->randomType(), $format);
    }

    public function randomType()
    {
        srand($this->seed);

        return $this->types[rand(0, count($this->types) - 1)] ?? '';
    }
}
