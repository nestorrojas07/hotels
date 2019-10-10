<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    protected $fieldFilters = [];

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function find($uuid)
    {
       return $this->model->where('uuid', $uuid)->first();
    }

    public function search($filters = [])
    {
       return $this->filter($filters);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
    public function update(array $data, $uuid)
    {
        return $this->model->where('uuid', $uuid)
            ->update($data);
    }

    public function delete($uuid)
    {
        $model = $this->model->whereUuid($uuid)->first();
        if ($model){
            return $model->delete();
        }
        return false;
    }

    public  function filter(array $search)
    {
        $modelQuery = $this->model->newModelQuery();
        foreach ($this->fieldFilters as $field => $config) {
            $field = Arr::get($config, 'field', $field);
            if (Arr::exists($search, $field)) {
                $scope = Arr::get($config, 'scope');
                $searchValue = Arr::get($search, $field);
                $modelQuery = $modelQuery->{$scope}($searchValue);
            }
        }
        return $modelQuery;
    }
}
