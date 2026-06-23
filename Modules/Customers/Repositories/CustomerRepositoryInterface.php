<?php

namespace Modules\Customers\Repositories;

interface CustomerRepositoryInterface
{
    public function getForSelect();

    public function create( array $data );

    public function paginate(int $perPage = 15, ?string $search = null);
}
