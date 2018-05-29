@include('partials.modals.admin_add_category_modal')

<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3 ><i class="fas fa-puzzle-piece fa-fw"></i> Categories</h3>
            <div class="pl-3 pb-3">
                <!-- Button to open 'edit category' form -->
                <a href="" data-toggle="collapse" data-target="#editMenu">
                    <i class="fa fa-edit fa-fw"></i> Edit category
                </a>
                <!-- 'Edit category' form -->
                <div id="editMenu" class="collapse">
                    <div class="d-flex flex-column">
                        <h3>Pick a category to edit</h3>
                        <div class="d-flex p-3" style="background-color:lightgray;">
                            <div class="mr-3 icon-preview">
                                <i class="fas fa-puzzle-piece big-icon p-2" style="color:white; background-color:white;"></i>
                            </div>
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="icon" placeholder="Icon" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Category listing -->
            <div id="categories-list" class="mt-2 d-flex flex-wrap align-items-center">
                @foreach ($categories as $cat)
                    @include('partials.admin_category', ['cat_id' => $cat->id, 'cat_icon' => $cat->icon, 'cat_name' => $cat->name, 'create_cat' => false])
                @endforeach
                <div class="text-primary" data-toggle="modal" data-target="#addCategoryModal">
                    @include('partials.admin_category', ['cat_id' => NULL, 'cat_icon' => 'fas fa-plus-circle', 'cat_name' => 'Add Category', 'create_cat' => true])
                </div>
            </div>
        </div>
    </div>
</div>