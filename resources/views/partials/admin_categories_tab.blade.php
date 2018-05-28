<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3 ><i class="fa fa-laptop"></i> Categories <i class="pl-2 fa fa-edit" data-toggle="collapse" data-target="#editMenu"></i></h3>
            <div id="editMenu" class="row collapse" style="background-color:gray;">
                <div class="col-3">
                    <i class="fa fa-laptop fa-5x"></i>
                </div>
                <div class="col-9">
                    <form class="form-inline" method="POST" action="">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }} 
                        <input type="text" name="icon" placeholder="Icon">
                        <input type="text" name="name" placeholder="Name">
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
            <div id="categories-list" class="d-flex flex-wrap">
                @each('partials.admin_category', $categories, 'category')
            </div>
        </div>
    </div>
</div>