<?php


namespace App\Modules\core\traits;

use App\Modules\core\requests\BaseRequest;
use Illuminate\Validation\ValidationException;

trait ValidationTrait
{
    public function validation(BaseRequest $request, string|null $validationClass, $id = null): void
    {
        if ($validationClass) {
            try {
                app($validationClass);
            } catch (ValidationException $e) {
                serverException();
            }
        }

        if ($id) {
            if(!$this->model->find($id)){
                validationException(['id' => ['Invalid record id']]);
            }
        }
        if ($request->has('sortDir')) {
            if (strtolower($request->input('sortDir')) != 'asc' && strtolower($request->input('sortDir')) != 'desc') {
                validationException(['sortDir' => ['sortDir can be asc or desc']]);
            }
        }
        if ($request->has('sortBy')) {
            if (!in_array($request->input('sortBy'), $this->searchField)) {
                validationException(['sortBy' => ['Invalid sortBy']]);
            }
        }

        if ($request->has('include')) {
            $includes = explode('&', $request->input('include'));
            $errorArray = [];
            foreach ($includes as $include) {
                if (!in_array($include, $this->allowedIncludes)) {
                    $errorArray[] = "This relations $include is invalid";
                }
            }

            if(!empty($errorArray)){
                validationException(['include' => $errorArray]);
            }
        }
    }
}
