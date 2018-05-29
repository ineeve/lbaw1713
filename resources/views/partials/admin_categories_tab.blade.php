<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3 ><i class="fa fa-laptop fa-fw"></i> Categories <i class="pl-2 fa fa-edit fa-fw" data-toggle="collapse" data-target="#editMenu"></i></h3>
            <div id="editMenu" class="row collapse">
                <div class="d-flex flex-column">
                    <h3>Pick a category to edit</h3>
                    <div class="d-flex p-3" style="background-color:gray;">
                        <div class="mr-3">
                            <i class="fa fa-laptop fa-fw fa-5x big-icon" style="background-color:white;"></i>
                        </div>
                        <form method="POST" action="">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="form-group">
                            <input type="text" name="icon" placeholder="Icon" class="form-control">
                            </div>
                            <div class="form-group">
                            <input type="text" name="name" placeholder="Name" class="form-control">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="categories-list" class="mt-2 d-flex flex-wrap">
                @each('partials.admin_category', $categories, 'category')
            </div>
        </div>
    </div>
</div>