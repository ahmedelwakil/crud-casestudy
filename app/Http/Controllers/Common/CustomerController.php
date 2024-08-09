<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ControllerInterface;

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
        return [];
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
        return [];
    }

    /**
     * @return array
     */
    function getUpdateValidationMessages()
    {
        return [];
    }
}
