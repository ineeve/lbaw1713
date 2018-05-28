<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3><i class="fa fa-laptop"></i> Categories</h3>
            <div class="row m-2 align-items-center">
                @include('partials.admin_categories_table',['categories'=>$categories])
            </div>
        </div>
    </div>
</div>