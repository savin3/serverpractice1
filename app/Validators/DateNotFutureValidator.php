<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class DateNotFutureValidator extends AbstractValidator
{
    protected string $message = 'Поле :field не может быть позже текущей даты';

    public function rule(): bool
    {
        return strtotime($this->value) <= time();
    }
}