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
        <div class="hs-row">
            <div class="hs-col-6 hs-fs-4 hs-text-black hs-mt-2">
                Your Wishlist
            </div>
            <div class="hs-col-6">
                <input
                    type="text"
                    wire:model="query"
                    placeholder="search"
                    class="search-input">

                <button class="search-button">
                    <i class="bi bi-search"></i>
                </button>

            <select multiple="" data-hs-select='{
  "placeholder": "Choose",
  "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
  "toggleClasses": "hs-select-disabled:pointer-events-none hs-select-disabled:opacity-50 relative py-3 ps-4 pe-9 flex gap-x-2 text-nowrap w-full cursor-pointer bg-white border border-gray-200 rounded-lg text-start text-sm focus:outline-none focus:ring-2 focus:ring-primary !important dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-neutral-600 hs-form-control",
  "dropdownClasses": "mt-2 z-50 w-full max-h-72 p-1 space-y-0.5 bg-white border border-gray-200 rounded-lg overflow-hidden overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 dark:bg-neutral-900 dark:border-neutral-700",
  "dropdownVerticalFixedPlacement": "bottom",
  "optionClasses": "py-2 px-4 w-full text-sm text-gray-800 cursor-pointer hover:bg-gray-100 rounded-lg focus:outline-none focus:bg-gray-100 dark:bg-neutral-900 dark:hover:bg-neutral-800 dark:text-neutral-200 dark:focus:bg-neutral-800",
  "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"hidden hs-selected:block\"><svg class=\"shrink-0 size-3.5 primary-color dark:primary-color \" xmlns=\"http:.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"20 6 9 17 4 12\"/></svg></span></div>",
  "extraMarkup": "<div class=\"absolute top-1/2 end-3 -translate-y-1/2\"><svg class=\"shrink-0 size-3.5 text-gray-500 dark:text-neutral-500 \" xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"m7 15 5 5 5-5\"/><path d=\"m7 9 5-5 5 5\"/></svg></div>"
}' class="hidden hs-form-control" name=".....">
                <option value="activities">Activities</option>
                <option value="products">Products</option>
                <option value="accommodations">Accommodations</option>
            </select>
            </div>
        </div>
    </div>
</div>


