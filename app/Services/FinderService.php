<?php
namespace App\Services;

class FinderService {
    public function searchDoctor(array $data){
        $query = User::with('doctor');

        if(!empty($data['speciality'])){
            $query->where('speciality', 'like', '%' .$data['speciality'] . '%');
        }

        if(!empty($data['name'])){
            $query->whereHas('user', function ($q) use ($data){
                $q->where('name', 'like', '%'.$data['name'].'%');
            });
        }

        return $query->get();
    }



}
