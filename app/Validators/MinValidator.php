<?php

namespace Validators;

use Debug\Debug;
use Src\Validator\AbstractValidator;

class MinValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть не меньше :min символов';

    public function rule(): bool
    {
        // если значение пустое — пропускаем (required отдельно)
        if (!isset($this->value)) {
            return true;
        }

        $min = (int)$this->args[0];

        return mb_strlen(trim($this->value)) >= $min;
    }

    public function messageError(): string
    {
        return str_replace(
            [':field', ':min'],
            [$this->field, $this->args[0]],
            $this->message
        );
    }
}
