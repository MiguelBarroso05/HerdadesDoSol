@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="text-white">
            @foreach($errors->all() as $error)
                <li><strong>Error!</strong> {{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
