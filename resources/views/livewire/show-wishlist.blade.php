<style>
    .search-input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 25px;
        outline: none;
        width: 200px;
    }

    .search-button {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: -35px;
    }

    .hs-tag-selector {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 25px;
    }

    .tag {
        display: flex;
        align-items: center;
        border: 1px solid #ccc;
        padding: 5px 10px;
        border-radius: 25px;
        margin-right: 5px;
    }

    .tag button {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: 5px;
    }

    .hs-dropdown-button {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: 10px;
    }
</style>
<div>
    <div class="hs-d-flex hs-justify-content-between">
        <div>
            Wishlist
        </div>
        <div class="hs-fs-8">
            return
        </div>
    </div>
    <div class="hs-d-flex hs-justify-content-between">
        <div class="hs-fs-4 hs-text-black hs-mt-2">
            Your Wishlist
        </div>
        <div>
            <input
                type="text"
                wire:model="query"
                placeholder="search"
                class="search-input">

            <button class="search-button">
                🔍
            </button>
        </div>
    </div>
</div>


