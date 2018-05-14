<script src="{{ asset('js/admin.js') }}" defer></script>
<div class="container-fluid">
    <div class="row mt-2">
        @include('partials.admin_left_section')
        <!-- MAIN CONTENT -->
        <div class="col-xl-10 col-lg-9 col-12">
        <div class="tab-content container-fluid">
            @if(isset($users)&&isset($total))
                @include('partials.admin_users_tab',['users'=>$users,'total'=>$total])
            @endif
            <div class="tab-pane" id="badges" role="tabpanel" aria-labelledby="badges-tab">...
            </div>
            <div class="tab-pane" id="categories" role="tabpanel" aria-labelledby="categories-tab">...
            </div>
            <div class="tab-pane" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">...
            </div>
        </div>
        </div>
    </div>
</div>