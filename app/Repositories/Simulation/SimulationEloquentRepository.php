<?php

namespace App\Repositories\Simulation;

use App\Models\Simulation;
use App\Repositories\BaseRepository;

class SimulationEloquentRepository extends BaseRepository implements SimulationRepositoryInterface
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return Simulation::class;
    }
}
