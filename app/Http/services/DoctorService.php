<?php

namespace App\Http\services;

use App\Models\Doctor;
use Illuminate\Support\Str;

class DoctorService
{
    public function getWithPaginate(int $paginate = 10){
        return Doctor::latest()->select('uuid', 'name', 'email', 'phone')->paginate($paginate);
    }

    public function getById(String $id)
    {
        return Doctor::where('uuid', $id)->firstOrFail();
    }

    public function create(array $data)
    {
        $data['uuid'] = Str::uuid();
        return Doctor::create($data);
    }

    public function update(array $data, String $id)
    {
        $getDoctor = $this->getById($id);
        return $getDoctor->update($data);
    }

    public function delete(String $id)
    {
        $getDoctor = $this->getById($id);
        return $getDoctor->delete();
    }

    public function search(String $search)
    {
        return Doctor::where('name', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->latest()
                    ->select('uuid', 'name', 'email', 'phone')
                    ->paginate(10);
    }
}
