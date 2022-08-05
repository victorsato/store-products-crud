<?php

namespace App\Repository\Eloquent;

use App\Models\Store;
use App\Repository\StoreRepositoryInterface;

class StoreRepository implements StoreRepositoryInterface
{
    public function getAll()
    {
        return Store::select('id', 'name', 'email', 'created_at')->get();
    }

    public function getById($id)
    {
        return Store::select('stores.id AS stores_id', 'stores.name AS store_name', 'stores.email')
                    ->where('stores.id', $id)
                    ->with(['products' => function($query) {
                        $query->get();
                    }])
                    ->get();
    }

    public function create(array $data)
    {
        return Store::create($data);
    }

    public function update($id, array $data)
    {
        return Store::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        Store::destroy($id);
    }
}