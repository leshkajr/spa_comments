<?php
namespace App\Validators;

use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Validation\Validator as IlluminateValidator;

class HTMLValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'a[href|title],code,i,strong');
        $purifier = new HTMLPurifier($config);

        $cleanHTML = $purifier->purify($value);

        return $cleanHTML === $value;
    }
}
