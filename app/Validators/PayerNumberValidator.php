<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PayerNumberValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать 10 или 12 цифр';

    public function rule(): bool
    {
        return preg_match('/^\d{10}$|^\d{12}$/', $this->value);
    }
}