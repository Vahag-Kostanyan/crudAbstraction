<?php


namespace App\Modules\core\traits;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Validation\ValidationException;

trait ValidationTrait
{
    protected function validate(BaseRequest $baseRequest, string $validationClass): void
    {
        if ($validationClass) {
            try {
                $validated = app($validationClass)->validate($baseRequest->all());
            } catch (ValidationException $e) {
                validationException($e->errors());
            }
        }

        
    }
}
