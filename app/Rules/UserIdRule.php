<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class UserIdRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        // 길이 검사 (예: 4에서 12자 사이)
        if (strlen($value) < 4 || strlen($value) > 12) {
            throw ValidationException::withMessages([
                $attribute => ['아이디는 4에서 12자 사이여야 합니다.'],
            ]);
        }


        // 특수 문자 검사 (예: 특수 문자를 포함하지 않아야 함)
        if (preg_match('/[^a-zA-Z0-9]+/', $value)) {
            throw ValidationException::withMessages([
                $attribute => ['아이디에는 특수 문자를 포함할 수 없습니다.'],
            ]);
        }
    }
}
