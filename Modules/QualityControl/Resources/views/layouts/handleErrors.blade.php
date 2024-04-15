
@if($message = session('message'))
    <div class="col-md-12">
        <div class="alert alert-success">
            <li>{{ $message }}</li>
        </div>
    </div>
@endif
@if($error = session('error'))
    <div class="col-md-12">
        <div class="alert alert-danger">
            <li>{{ $error }}</li>
        </div>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
