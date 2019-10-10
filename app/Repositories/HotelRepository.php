<?php

namespace App\Repositories;

use App\Models\Hotel;
use Ramsey\Uuid\Uuid;

class HotelRepository extends RepositoryAbstract
{

    public function __construct(Hotel $model)
    {
        parent::__construct($model);
    }

    protected $fieldFilters = [
        'name' => ['field' =>'name', 'scope' => 'byName'],
        'city' => ['field' =>'city', 'scope' => 'byCity'],
        'address' => ['field' =>'address', 'scope' => 'byAddress'],
        'starts' => ['field' =>'starts', 'scope' => 'byStarts'],
        'search' => ['field' =>'search', 'scope' => 'bySearch'],
    ];

    public function create(array $data)
    {
        $data['uuid'] = Uuid::uuid4()->toString();
        return parent::create($data); // TODO: Change the autogenerated stub
    }
}