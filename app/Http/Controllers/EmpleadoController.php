<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
// Remove files from storage
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['empleados'] = Empleado::paginate(2);
        return view('empleado.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field validation
        $fields = [
            'name'=>'required|string|max:50',
            'lastname'=>'required|string|max:50',
            'email'=>'required|email',
            'phone'=>'required|string|max:20',
            'picture'=>'required|max:10000|mimes:jpeg,png,jpg'
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        $this->validate($request, $fields, $messages);

        // Get all the data except token
        $empleadoData = request()->except('_token');
        // Check if the field Picture has an image
        if (request()->hasFile('picture')) {
            // Save the picture in 'storage/app/public/uploads'
            $empleadoData['picture'] = request()->file('picture')->store('uploads', 'public');
        }
        // Insert the record in the database
        Empleado::insert($empleadoData);
        return redirect('empleado')->with('message', 'Employee created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        // FindOrFail finds a record from DB
        $empleado = Empleado::findOrFail($id);
        // Compact allows to pass an object to a view
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // Field validation
        $fields = [
            'name'=>'required|string|max:50',
            'lastname'=>'required|string|max:50',
            'email'=>'required|email',
            'phone'=>'required|string|max:20',
        ];
        $messages = [
            'required'=>'The :attribute is required'
        ];
        // If the user updates the picture, add it to the validation
        if (request()->hasFile('picture')) {
            $fields['picture'] = 'required|max:10000|mimes:jpeg,png,jpg';
        }
        $this->validate($request, $fields, $messages);
        
        // Get all the data except token and method
        $empleadoData = request()->except('_token', '_method');
        // Check if the field Picture has an image
        if (request()->hasFile('picture')) {
            // Find the employee in DB
            $empleado = Empleado::findOrFail($id);
            // Remove their old picture from storage
            Storage::delete('public/'.$empleado->picture);
            // Save the new picture in 'storage/app/public/uploads'
            $empleadoData['picture'] = request()->file('picture')->store('uploads', 'public');
        }
        // Update the record in the database
        Empleado::where('id','=',$id)->update($empleadoData);
        return redirect('empleado')->with('message', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        // Find the employee in DB
        $empleado = Empleado::findOrFail($id);
        // Remove their picture from storage
        if (Storage::delete('public/'.$empleado->picture)) {
            // Once the picture is deleted, remove employee from DB
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('message', 'Employee removed successfully!');
    }
}
