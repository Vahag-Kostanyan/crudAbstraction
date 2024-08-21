<?php


namespace App\Modules\core\traits;

use App\Modules\core\requests\BaseRequest;
use App\Modules\core\services\CrudService;
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

    /**
     * Summary of setServices
     * @return void
     */
    public function setServices() : void
    {
        $this->crudService = new CrudService();
        if($this->indexServiceClass){
            $this->indexService = new $this->indexServiceClass;
        }
        if($this->showServiceClass){
            $this->showService = new $this->showServiceClass;
        }
        if($this->storeServiceClass){
            $this->storeService = new $this->storeServiceClass;
        }
        if($this->updateServiceClass){
            $this->updateService = new $this->updateServiceClass;
        }
        if($this->destroyServiceClass){
            $this->destroyService = new $this->destroyServiceClass;
        }
    }

}
