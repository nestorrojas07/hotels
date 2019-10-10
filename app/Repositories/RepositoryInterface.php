<?php
namespace App\Repositories;

interface RepositoryInterface
{

    public function find($id);

    public function search($filters= []);

    public function create(array  $data);

    public function update(array $data, $id);

    public function delete($id);
}
