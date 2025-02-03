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
    <a href="{{ $route }}" class="hs-mx-2"><i class="bi bi-eye hs-fs-5" style="color: #E17747"></i></a>
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
    <button type="submit" class="hs-btn hs-btn-sm hs-col-md-4" style="border: 1px solid #437546; background-color: #E0EBDC;">
        Create
    </button>
@endif

<!-- Cancel Button -->
@if($type == "cancel")
    <a href="{{ $route }}"
       class="hs-btn hs-btn-sm hs-col-md-4" style="border: 1px solid #754343; background-color: #EAD2D2;">
        Cancel
    </a>
@endif

@if($type == "cancelIcon")
    <a href="{{ $route }}" class="hs-mx-2"><i class="bi bi-x-lg hs-fs-5" style="color: black"></i></a>
@endif

@if($type == "close")
    <a type="button" data-bs-dismiss="modal" aria-label="Close" class="mx-3">
        <i class="bi bi-x hs-fs-3" style="color: black !important;"></i>
    </a>
@endif


@if($type == 'fav')
    <a href="" class="hs-mx-2"><i class="bi bi-star hs-fs-5" style="color: #FFB427;"></i></a>
@endif

@if($type == "viewMore" )
    <a href="{{ $route }}" class="hs-btn hs-btn-primary text-white">View More</a>
@endif

@if($type == "disable")
    <form action="{{ $route }}"
          method="POST">
        @method('DELETE')
        @csrf
        <button type="submit"
                class="bg-transparent"
                data-toggle="tooltip" data-original-title="Disable user">
            <i class="bi bi-person-x hs-fs-5" style="color: #df0505"></i>
        </button>
    </form>
@endif

@if($type == "enable")
    <form action="{{ $route }}"
          method="POST">
        @csrf
        <button type="submit"
                class="bg-transparent"
                data-toggle="tooltip" data-original-title="Activate user">
            <i class="bi bi-person-up hs-fs-5" style="color: #22df05"></i>
        </button>
    </form>
@endif

@if($type == "disableEstate")
    <form action="{{ $route }}"
          method="POST">
        @method('DELETE')
        @csrf
        <button type="submit"
                class="bg-transparent"
                data-toggle="tooltip" data-original-title="Put Estate to maintenance">
            <i class="bi bi-house-gear hs-fs-5" style="color: #df0505"></i>
        </button>
    </form>
@endif

@if($type == "enableEstate")
    <form action="{{ $route }}"
          method="POST">
        @csrf
        <button type="submit"
                class="bg-transparent"
                data-toggle="tooltip" data-original-title="Put Estate to work">
            <i class="bi bi-house-check hs-fs-5" style="color: #2dce89"></i>
        </button>
    </form>
@endif


