<?php

namespace App\Http\Controllers;

use App\Services\ServiceInterface;
use App\Utils\HttpStatusCodeUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class BaseController extends Controller implements ControllerInterface
{
    protected $entity;
    protected $service;

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
        $this->entity = $this->getEntityName();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getIndexValidationRules(), $this->getIndexValidationMessages());
        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $records = $this->service->all()->toArray();
            return $this->response($records, HttpStatusCodeUtil::OK, "$this->entity List Retrieved Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $record = $this->service->find($id);
            return $this->response($record->toArray(), HttpStatusCodeUtil::OK, "$this->entity Record Retrieved Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getStoreValidationRules(), $this->getStoreValidationMessages());
        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $record = $this->service->create($request->all());
            return $this->response($record->toArray(), HttpStatusCodeUtil::OK, "$this->entity Created Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->getUpdateValidationRules($id), $this->getUpdateValidationMessages());
        if ($validator->fails())
            return $this->response($validator->errors()->toArray(), HttpStatusCodeUtil::BAD_REQUEST, 'Validation Error!');

        try {
            $record = $this->service->update($request->all(), $id);
            return $this->response($record->toArray(), HttpStatusCodeUtil::OK, "$this->entity Updated Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->service->delete($id);
            return $this->response([], HttpStatusCodeUtil::OK, "$this->entity Deleted Successfully!");
        } catch (\Exception $e) {
            // TODO: Add Error Reporting
            return $this->response([], HttpStatusCodeUtil::SERVER_ERROR, 'Something Went Wrong!');
        }
    }
}
