<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PositiveNumberValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть положительным числом';

    public function rule(): bool
    {
        return is_numeric($this->value) && $this->value > 0;
    }
}