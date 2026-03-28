<?php

namespace Validators;

use Debug\Debug;
use Src\Validator\AbstractValidator;

class MaxValidator extends AbstractValidator
{
    protected string $message = 'Поле :field должно быть не больше :max символов';

    public function rule(): bool
    {
        if (!isset($this->value)) {
            return true;
        }

        $max = (int)$this->args[0];

        return mb_strlen(trim($this->value)) <= $max;
    }

    public function messageError(): string
    {
        return str_replace(
            [':field', ':max'],
            [$this->field, $this->args[0]],
            $this->message
        );
    }
}
