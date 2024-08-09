<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ControllerInterface;
use App\Services\Common\ServiceService;
use App\Utils\HttpStatusCodeUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * @property ServiceService $service
 */
class ServiceController extends BaseController implements ControllerInterface
{
    /**
     * @return string
     */
    function getEntityName()
    {
        return 'Service';
    }

    /**
     * @param $customer_id
     * @return JsonResponse
     */
    public function list($customer_id)
    {
        try {
            $records = $this->service->listByCustomerId($customer_id)->toArray();
            return $this->response($records, HttpStatusCodeUtil::OK, "Customer $this->entity List Retrieved Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @param Request $request
     * @param $customer_id
     * @return JsonResponse
     */
    public function attach(Request $request, $customer_id)
    {
        $validator = Validator::make($request->all(), $this->getStoreValidationRules(), $this->getStoreValidationMessages());
        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $records = $this->service->attach($customer_id, $request->all())->toArray();
            return $this->response($records, HttpStatusCodeUtil::OK, "Customer $this->entity Attached Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @return array
     */
    function getIndexValidationRules()
    {
        return [];
    }

    /**
     * @return array
     */
    function getIndexValidationMessages()
    {
        return [];
    }

    /**
     * @return array
     */
    function getStoreValidationRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'integer'],
        ];
    }

    /**
     * @return array
     */
    function getStoreValidationMessages()
    {
        return [];
    }

    /**
     * @param $id
     * @return array
     */
    function getUpdateValidationRules($id)
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'price' => ['sometimes', 'numeric'],
            'duration' => ['sometimes', 'integer'],
        ];

    }

    /**
     * @return array
     */
    function getUpdateValidationMessages()
    {
        return [];
    }
}
