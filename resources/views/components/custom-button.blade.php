<!-- Delete Button -->
@if($type == "delete" )
    <form action="{{ $route }}"
          method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" style="border: none; background-color: transparent">
            <i class="bi bi-trash fs-5" style="color: red"></i>
        </button>
    </form>
@endif

<!-- Show Button -->
@if($type == "show")
    <a href="{{ $route }}"
       class="btn btn-secondary btn-sm mr-2 bg-gradient-info"
       data-toggle="tooltip">
        Show
    </a>
@endif

<!-- Edit Button -->
@if($type == "edit")
    <a href="{{ $route }}" class="mx-2"><i class="bi bi-pencil-square fs-5" style="color: #2B6EFF"></i></a>
@endif

<!-- Create New Button -->
@if($type == "createNew")
    <a href="{{ $route }}"
       class="btn btn-primary btn-sm mr-2"
       data-toggle="tooltip">
        Create New
    </a>
@endif

<!-- Update Button -->
@if($type == "update" )
    <button type="submit" class="btn btn-primary btn-sm ms-auto bg-gradient-success">
        Update
    </button>
@endif

<!-- Create Button -->
@if($type == "create" )
    <button type="submit" class="btn btn-sm ms-auto" style="border: 1px solid #437546; background-color: #E0EBDC; width: 100%">
        Create
    </button>
@endif

<!-- Cancel Button -->
@if($type == "cancel")
    <a href="{{ $route }}"
       class="btn btn-secondary btn-sm ms-3 bg-gradient-danger">
        Cancel
    </a>
@endif

@if($type == "close")
    <a type="button" data-bs-dismiss="modal" aria-label="Close">
        <i class="bi bi-x fs-3" style="color: black !important;"></i>
    </a>
@endif


@if($type == 'fav')
    <a href="" class="mx-2"><i class="star-button bi bi-star fs-5" style="color: #FFB427;"></i></a>
@endif


