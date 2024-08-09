<?php

namespace App\Services\Common;

use App\Services\BaseService;
use App\Services\ServiceInterface;
use Illuminate\Support\Str;

class UserService extends BaseService implements ServiceInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if (isset($data['password']))
            $data['password'] = bcrypt($data['password']);
        else
            $data['password'] = bcrypt('password');

        $data['remember_token'] = Str::random(10);
        return parent::create($data);
    }
}
