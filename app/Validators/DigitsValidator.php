<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DigitsValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать только цифры';

    public function rule(): bool
    {
        return preg_match('/^\d+$/', $this->value);
    }
}