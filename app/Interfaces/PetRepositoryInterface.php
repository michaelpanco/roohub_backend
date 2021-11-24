<?php

namespace App\Interfaces;

interface PetRepositoryInterface 
{
    public function getAllPets($query_params);
    public function getPetById($pet_id);
    public function createPet(array $pet_details);
    public function updatePet($pet_id, array $new_details);
}