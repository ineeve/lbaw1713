<!-- Input: array $badges -->

<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-11">
            <h3><i class="fa fa-flask fa-fw"></i> Badges</h3>
            <!-- Badges listing -->
            <div id="badges-list" class="mt-2 d-flex flex-wrap align-items-center">
                @foreach ($badges as $badge)
                    @include('partials.admin_badge', ['badge' => $badge])
                @endforeach
                <!-- <div class="text-primary" data-toggle="modal" data-target="#addCategoryModal">
                    @include('partials.admin_category', ['cat_id' => NULL, 'cat_icon' => 'fas fa-plus-circle', 'cat_name' => 'Add Category', 'create_cat' => true])
                </div> -->
            </div>
        </div>
    </div>
</div>