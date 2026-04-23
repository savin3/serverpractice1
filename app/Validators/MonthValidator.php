<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class MonthValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть заполнено числом от 1 до 12';

    public function rule(): bool
    {
        $month = (int)$this->value;
        return $month >= 1 && $month <= 12;
    }
}