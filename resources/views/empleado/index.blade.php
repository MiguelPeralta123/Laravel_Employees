<!-- The first three and last two lines were copied from views/auth/login.blade.php to add bootstrap styles -->
@extends('layouts.app')

@section('content')

<div class="container">

    <!-- If the view was returned with a message, render it -->
    @if (Session::has('message'))
    <div id="notification" class="alert alert-primary" role="alert">
        <p class="mb-0">{{ Session::get('message') }}</p>
    </div>
    <script>
        // Hide the message after 3 seconds
        setTimeout(function() {
            document.getElementById('notification').classList.add('d-none');
        }, 3000);
    </script>
    @endif

    <!-- Create a new employee -->
    <a href="{{ url('empleado/create') }}" class="btn btn-primary mb-3">Create employee</a>

    <!-- Employees table -->
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Picture</th>
                    <th scope="col">Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td class="bg-white" scope="row">{{ $empleado->id }}</td>
                    <td class="bg-white" scope="row">
                        <img src="{{ asset('storage').'/'.$empleado->picture }}" alt="employee" class="img-thumbnail img-fluid" width="100" />
                    </td>
                    <td class="bg-white" scope="row">{{ $empleado->name }}</td>
                    <td class="bg-white" scope="row">{{ $empleado->lastname }}</td>
                    <td class="bg-white" scope="row">{{ $empleado->email }}</td>
                    <td class="bg-white" scope="row">{{ $empleado->phone }}</td>
                    <td class="bg-white" scope="row">
                        <!-- Edit button - redirects to edit view with id as an argument -->
                        <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-warning">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <!-- Delete button - destroy method in EmpleadoController removes an employee from DB -->
                        <form method="POST" action="{{ url('/empleado/'.$empleado->id) }}" class="d-inline">
                            @csrf
                            <!-- Set method as DELETE -->
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this employee?')">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> <!-- Employees table -->

    <!-- To use pagination, configure the boot method in app/Providers/AppServiceProvider.php -->
    {!! $empleados->links() !!}
    
</div> <!-- Container -->
@endsection