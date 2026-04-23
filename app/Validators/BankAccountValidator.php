<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class BankAccountValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно содержать 20 цифр';

    public function rule(): bool
    {
        return preg_match('/^\d{20}$/', $this->value);
    }
}