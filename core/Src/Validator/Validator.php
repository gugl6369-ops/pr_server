<?php

namespace Src\Validator;

class Validator
{
    //Разрешенные валидаторы
    private array $validators = [];
    //Итоговые ошибки
    private array $errors = [];
    //Проверяемые поля
    private array $fields = [];
    //Массив правил
    private array $rules = [];
    //Кастомные сообщения
    private array $messages = [];

    public function __construct(array $fields, array $rules, array $messages = [])
    {
        $this->validators = app()->settings->app['validators'] ?? [];
        $this->fields = $fields;
        $this->rules = $rules;
        $this->messages = $messages;
        $this->validate();
    }

    //Перебираем список всех валидируемых полей и для
    //каждого поля вызываем метод validateField()
    private function validate(): void
    {
        foreach ($this->rules as $fieldName => $fieldValidators) {
            $this->validateField($fieldName, $fieldValidators);
        }
    }

    //Валидация отдельного поля
    private function validateField(string $fieldName, array $fieldValidators): void
    {
        //Перебираем все валидаторы, ассоциированные с полем
        foreach ($fieldValidators as $validatorName) {
            //Отделяем от имени валидатора дополнительные аргументы
            $tmp = explode(':', $validatorName);

            $ruleName = $tmp[0];
            $args = isset($tmp[1]) ? explode(',', $tmp[1]) : [];

            //Соотносим имя валидатора с классом в массиве разрешенных валидаторов
            $validatorClass = $this->validators[$ruleName] ?? null;
            if (!class_exists($validatorClass)) {
                continue;
            }

            $message = $this->messages[$ruleName] ?? null;
            //Создаем объект валидатора, передаем туда параметры
            $validator = new $validatorClass(
                $fieldName,
                $this->fields[$fieldName],
                $args,
                $message
            );

            //Если валидация не прошла, то добавляем ошибку в общий массив ошибок
            if (!$validator->rule()) {
                $this->errors[$fieldName][] = $validator->validate();
            }
        }
    }

    //Возврат массива найденных ошибок
    public function errors(): array
    {
        return $this->errors;
    }

    //Признак успешной валидации
    public function fails(): bool
    {
        return (bool)count($this->errors);
    }
}