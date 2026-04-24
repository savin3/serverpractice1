<?php
//
//namespace Validators;
//
//use Src\Validator\AbstractValidator;
//
//class AlphabetValidator extends AbstractValidator
//{
//    protected string $message = 'Поле :field должно содержать только буквы';
//
//    public function rule(): bool
//    {
//        $result = preg_match('/^[а-яёЁa-zA-Z\s\-]+$/u', $this->value);
//        var_dump($this->field, $this->value, $result);
//        return $result;
//    }
//}