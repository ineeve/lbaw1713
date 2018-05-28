<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3><i class="fa fa-laptop"></i> Categories <i class="pl-2 fa fa-edit"></i></h3>
            <div id="editMenu">

            </div>
            <div id="categories-list" class="d-flex align-items-between">
                @each('partials.admin_category', $categories, 'category')
            </div>
        </div>
    </div>
</div>