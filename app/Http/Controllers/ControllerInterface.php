<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface ControllerInterface
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request);

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id);

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request);

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id);

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id);

    /**
     * @return string
     */
    function getEntityName();

    /**
     * @return array
     */
    function getIndexValidationRules();

    /**
     * @return array
     */
    function getIndexValidationMessages();

    /**
     * @return array
     */
    function getStoreValidationRules();

    /**
     * @return array
     */
    function getStoreValidationMessages();

    /**
     * @param $id
     * @return array
     */
    function getUpdateValidationRules($id);

    /**
     * @return array
     */
    function getUpdateValidationMessages();
}
