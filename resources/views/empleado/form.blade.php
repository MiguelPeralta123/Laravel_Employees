<!-- Customize the form title depending on the value sent as an array -->
<h1>{{ $mode }} employee</h1>

@if (count($errors) > 0)
<div class="alert alert-danger" role="alert">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- Inputs -->
<!-- old('field_name') allows to keep the input value in case an error message is shown -->
<div class="form-group mb-3">
    <label for="name">Name</label>
    <input id="name" class="form-control mb-3 bg-white" type="text" name="name" value="{{ isset($empleado->name) ? $empleado->name : old('name') }}" placeholder="Enter your name" />

    <label for="lastname">Last name</label>
    <input id="lastname" class="form-control mb-3 bg-white" type="text" name="lastname" value="{{ isset($empleado->lastname) ? $empleado->lastname : old('lastname') }}" placeholder="Enter your last name" />

    <label for="email">Email</label>
    <input id="email" class="form-control mb-3 bg-white" type="text" name="email" value="{{ isset($empleado->email) ? $empleado->email : old('email') }}" placeholder="Enter your email" />

    <label for="phone">Phone</label>
    <input id="phone" class="form-control mb-3 bg-white" type="text" name="phone" value="{{ isset($empleado->phone) ? $empleado->phone : old('phone') }}" placeholder="Enter your phone" />

    <!-- The image will be rendered only if it exists -->
    @if (isset($empleado->picture))
    <img src="{{ asset('storage').'/'.$empleado->picture }}" alt="employee" class="mb-2" width="100" />
    @else
    <label for="picture">Picture</label>
    @endif

    <input id="picture" class="form-control bg-white" type="file" name="picture" />
</div>

<div class="d-flex gap-2">
    <!-- Link to go back -->
    <a href="{{ url('empleado') }}" class="btn btn-secondary">
        <i class="fa fa-arrow-left" aria-hidden="true"></i>
        Go back
    </a>

    <button id="submit" class="btn btn-primary" type="submit">
        <i class="fa fa-floppy-o" aria-hidden="true"></i>
        {{ $mode }}
    </button>
</div>