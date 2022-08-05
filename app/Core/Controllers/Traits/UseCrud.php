<?php

namespace App\Core\Controllers\Traits;

use Illuminate\Database\Eloquent\Model;

trait UseCrud
{
    protected function _create(array $data): Model
    {
        return $this->service->create($data);
    }

    protected function _update(Model $model, array $data)
    {
        return $this->service->update($model, $data);
    }

    protected function _delete(Model $model)
    {
        if ($this->service->delete($model)) {
            return response('', 202);
        }

        return response('', 204);
    }

    public function _index()
    {
        return $this->service->index();
    }
}
