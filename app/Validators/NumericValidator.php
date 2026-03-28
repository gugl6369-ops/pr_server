<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumericValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть числом';

    public function rule(): bool
    {
        if ($this->value === null || $this->value === '') {
            return true; // required отдельно
        }

        return is_numeric($this->value);
    }
}
