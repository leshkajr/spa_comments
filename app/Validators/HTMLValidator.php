<?php
namespace App\Validators;

use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator as IlluminateValidator;

class HTMLValidator
{
    public function validate($attribute, $value, $parameters, $validator)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 'a[href|title],code,i,strong,br');
        $purifier = new HTMLPurifier($config);

        $cleanHTML = $purifier->purify($value);
        $cleanHTML = preg_replace('/\s/', '', $cleanHTML);
        $value = preg_replace('/\s/', '', $value);
        return $cleanHTML === $value;
    }
}
