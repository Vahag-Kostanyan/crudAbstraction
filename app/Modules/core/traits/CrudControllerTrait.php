<?php


namespace App\Modules\core\traits;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Validation\ValidationException;

trait CrudControllerTrait
{
    /**
     * Summary of validation
     * @param BaseRequest $request
     * @param string|null $validationClass
     * @param mixed $id
     * @return void
     */
    public function validation(BaseRequest $request, string|null $validationClass, $id = null): void
    {

        if ($validationClass) {
            try {
                $validationRequest = app($validationClass);
                $validationRequest->after_validation($id, $this->searchField, $this->allowedIncludes, $this->model);
            } catch (ValidationException $e) {
                serverException();
            }
        }
    }

}
