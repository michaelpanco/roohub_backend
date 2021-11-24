<?php

namespace App\Repositories;

use App\Interfaces\PetRepositoryInterface;
use App\Models\Pet;

class PetRepository implements PetRepositoryInterface 
{
    public function getAllPets($params) 
    {
       
        $pets = Pet::limit($params['limit']) -> offset($params['offset']);

        if(!empty($params['order'])){
            $pets = $pets -> orderBy(array_keys($params['order'])[0], array_values($params['order'])[0]);
        }
        // count the record
        $record_count = $pets -> count();

        // execute get command
        $pets = $pets -> get();

        return [
            'count' => $record_count,
            'records' => $pets,
        ];
    }

    public function getPetById($pet_id) 
    {
        return Pet::find($pet_id);
    }

    public function createPet(array $pet_details) 
    {
        return Pet::create($pet_details);
    }

    public function updatePet($pet_id, array $new_details) 
    {
        return Pet::whereId($pet_id)->update($new_details);
    }
}