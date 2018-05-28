<script src="{{ asset('js/admin.js') }}" defer></script>

<div class="container-fluid">
    <div class="row mt-2">
        @include('partials.admin_left_section')
        <!-- MAIN CONTENT -->
        <div class="col-xl-10 col-lg-9 col-12">
            <div class="tab-content container-fluid">
                <div class="tab-pane active" id="users_tab" role="tabpanel" aria-labelledby="users_tab">
                @if(isset($users))
                    @include('partials.admin_users_tab',[
                        'users'=>$users,
                        'numberOfPages'=>$numberOfPages,
                        'total'=>$total,
                        'currentPage=>$currentPage'])
                @endif
                </div>
                <div class="tab-pane" id="badges_tab" role="tabpanel" aria-labelledby="badges_tab">...
                </div>
                <div class="tab-pane" id="categories_tab" role="tabpanel" aria-labelledby="categories_tab">
                    @include('partials.admin_categories_tab');
                </div>
                <div class="tab-pane" id="statistics_tab" role="tabpanel" aria-labelledby="statistics_tab">...
                </div>
            </div>
        </div>
    </div>
</div>