<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class InsuranceNumberValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть заполнено в формате XXX-XXX-XXX XX';

    public function rule(): bool
    {
        return preg_match('/^\d{3}-\d{3}-\d{3} \d{2}$/', $this->value);
    }
}