<?php

declare(strict_types=1);

namespace AdventOfCode\Day4;

class Passport
{
    /** @var Field[] */
    private array $fields;

    public function __construct(Field ...$fields)
    {
        foreach ($fields as $field) {
            $this->fields[$field->type] = $field;
        }
    }

    public function isValid(): bool
    {
        return $this->allRequiredFieldArePresent() && $this->allFieldAreValid();
    }

    protected function allRequiredFieldArePresent(): bool
    {
        $fieldTypes = Field::getTypes();

        foreach ($fieldTypes as $fieldType) {
            if (\array_key_exists($fieldType, $this->fields)) {
                continue;
            }

            if ($fieldType === Field::COUNTRY_ID) {
                continue;
            }

            return false;
        }

        return true;
    }

    protected function allFieldAreValid(): bool
    {
        foreach ($this->fields as $field) {
            if (!$field->isValid()) {
                return false;
            }
        }

        return true;
    }
}
