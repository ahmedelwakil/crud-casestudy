<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ControllerInterface;
use Illuminate\Validation\Rule;

class UserController extends BaseController implements ControllerInterface
{
    /**
     * @return string
     */
    function getEntityName()
    {
        return 'User';
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
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['sometimes', 'string'],
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
            'email' => ['sometimes', 'email', 'max:255', Rule::unique('users', 'email')->ignore($id, 'id')],
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
