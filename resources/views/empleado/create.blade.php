<!-- The first three and last two lines were copied from views/auth/login.blade.php to add bootstrap styles -->
@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Store method in EmpleadoController stores a record in DB -->
    <form method="POST" action="{{ url('/empleado') }}" enctype="multipart/form-data">
        @csrf
        <!-- This passed array can be accessed in form.blade.php -->
        @include('empleado.form', ['mode'=>'Create'])
    </form>
</div>
@endsection