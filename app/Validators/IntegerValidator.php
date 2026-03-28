<?php


namespace Validators;

use Src\Validator\AbstractValidator;

class IntegerValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть целым числом';

    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true; // required отдельно
        }

        return filter_var($this->value, FILTER_VALIDATE_INT) !== false;
    }
}