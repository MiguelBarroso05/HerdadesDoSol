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
       class="hs-btn hs-btn-secondary hs-btn-sm hs-mr-2 hs-bg-gradient-info"
       data-toggle="tooltip">
        Show
    </a>
@endif

<!-- Edit Button -->
@if($type == "edit")
    <a href="{{ $route }}" class="hs-mx-2"><i class="bi bi-pencil-square hs-fs-5" style="color: #2B6EFF"></i></a>
@endif

<!-- Create New Button -->
@if($type == "createNew")
    <a href="{{ $route }}"
       class="hs-btn hs-btn-primary hs-btn-sm hs-mr-2"
       data-toggle="tooltip">
        Create New
    </a>
@endif

<!-- Update Button -->
@if($type == "update" )
    <button type="submit" class="hs-btn hs-btn-sm hs-col-md-4" style="border: 1px solid #437546; background-color: #E0EBDC; width: 190px">
        Update
    </button>
@endif

<!-- Create Button -->
@if($type == "create" )
    <button type="submit" class="hs-btn hs-btn-sm hs-ms-auto hs-col-md-4" style="border: 1px solid #437546; background-color: #E0EBDC;">
        Create
    </button>
@endif

<!-- Cancel Button -->
@if($type == "cancel")
    <a href="{{ $route }}"
       class="hs-btn hs-btn-sm hs-col-md-4" style="border: 1px solid #754343; background-color: #EAD2D2; width: 100px">
        Cancel
    </a>
@endif

@if($type == "close")
    <a type="button" data-bs-dismiss="modal" aria-label="Close" class="mx-3">
        <i class="bi bi-x hs-fs-3" style="color: black !important;"></i>
    </a>
@endif


@if($type == 'fav')
    <a href="" class="hs-mx-2"><i class="star-button bi bi-star hs-fs-5" style="color: #FFB427;"></i></a>
@endif


