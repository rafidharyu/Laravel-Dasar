<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Contracts\View\View;
use App\Http\services\DoctorService;

class DoctorController extends Controller
{
    public function __construct(private DoctorService $doctorService) {}
    public function index(): View
    {
        // $data = Doctor::latest()->get(['uuid', 'name', 'email', 'phone']); //SELECT id, name FROM doctors
        $data = $this->doctorService->getWithPaginate();

        return view('doctor.index', [
            'doctors' => $data
        ]);
    }

    public function search(Request $request)
    {
        $search = (string) $request->input('search');

        $doctors = $this->doctorService->search($search);

        return view('doctor.index', [
            'doctors' => $doctors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'gender']);
        try {
            $this->doctorService->create($data);
            return redirect('/doctor')->with('success', 'Data has been created');
        } catch (\Exception $error) {
            return redirect('/doctor/create')->with('error', $error->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->doctorService->getById($id);
        return view('doctor.show', [
            'doctor' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('doctor.edit', [
            'doctor' => $this->doctorService->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $dataByForm = $request->only(['name', 'email', 'phone', 'gender']);

            $this->doctorService->update($dataByForm, $id);

            return redirect('/doctor')->with('success', 'Data has been updated');
        } catch (\Exception $error) {
            return redirect('/doctor/edit/' . $id)->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->doctorService->delete($id);
            return redirect('/doctor')->with('success', 'Data has been deleted');
        } catch (\Exception $error) {
            return redirect('/doctor')->with('error', $error->getMessage());
        }
    }
}
