<!-- The first three and last two lines were copied from views/auth/login.blade.php to add bootstrap styles -->
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Edit method in EmpleadoController updates a record in DB -->
    <form method="POST" action="{{ url('/empleado/'.$empleado->id) }}" enctype="multipart/form-data">
        @csrf
        <!-- Set method as PATCH -->
        {{ method_field('PATCH') }}
        <!-- This passed array can be accessed in form.blade.php -->
        @include('empleado.form', ['mode'=>'Update'])
    </form>
</div>
@endsection