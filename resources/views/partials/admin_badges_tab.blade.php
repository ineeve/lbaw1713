<!-- Input: array $badges -->

<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-11">
            <h3>
                <i class="fa fa-flask fa-fw"></i> Badges</h3>
            <!-- Badges listing -->
            <div id="badges-list" class="mt-2 d-flex flex-wrap align-items-center">
                @foreach ($badges as $badge) @include('partials.admin_badge', ['badge' => $badge]) @endforeach
                <a href="" class="d-flex flex-column align-items-center nounderline mt-3 mr-3" style="min-width:16rem;">
                    <i class="fas fa-plus-circle fa-fw medium-big-icon"></i>
                    <p class="m-0">Add Badge</p>
                </a>
            </div>
        </div>
    </div>
</div>