<?php

namespace App\Http\Validation;

interface IValidation {
    public function validate(array $dados, $id = 0) ;
}
