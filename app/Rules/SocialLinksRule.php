<?php

namespace App\Rules;

use App\Traits\SocialLinksTrait;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SocialLinksRule implements ValidationRule
{
    use SocialLinksTrait;

    public $social;

    public function __construct($social)
    {
        $this->social = $social;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match($this->socialLinkPattern($this->social), $value)) {
            $fail('The :attribute must be a valid ' . ucfirst($this->social) . ' page or profile link.');
        }
    }
}
