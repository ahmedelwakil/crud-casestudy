<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Validation\Rule;

class CustomerController extends BaseController implements ControllerInterface
{
    /**
     * @return string
     */
    function getEntityName()
    {
        return 'Customer';
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
            'email' => ['required', 'email', 'max:255', Rule::unique('customers', 'email')],
            'phone' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:255'],
            'state' => ['sometimes', 'string', 'max:255'],
            'zip' => ['sometimes', 'string', 'max:255'],
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
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('customers', 'email')->ignore($id, 'id')],
            'phone' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:255'],
            'state' => ['sometimes', 'string', 'max:255'],
            'zip' => ['sometimes', 'string', 'max:255'],
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
