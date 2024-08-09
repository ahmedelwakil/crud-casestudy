<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

interface ServiceInterface
{
    /**
     * @return Collection
     */
    public function all();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param $id
     */
    public function delete($id);
}
