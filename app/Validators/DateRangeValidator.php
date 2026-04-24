<?php
//
//namespace Validators;
//
//use Src\Validator\AbstractValidator;
//
//class DateRangeValidator extends AbstractValidator
//{
//    protected string $message = 'Дата начала не может быть позже даты окончания';
//
//    public function rule(): bool
//    {
//        if (empty($this->args[0])) return true;
//        $start = strtotime($this->value);
//        $end = strtotime($this->args[0]);
//        return $start <= $end;
//    }
//}