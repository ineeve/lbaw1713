<script src="{{ asset('js/collapsible.js') }}" defer></script>

<div class="container-fluid mt-2">
    <div class="row">
        <!-- TABS -->
        <div class="col-xl-2 col-sm-3 col-12">
            @include('partials.settings_tabs')
        </div>
        <div class="col-xl-10 col-sm-9 col-12">
            <div id="settingsTabContent" class="tab-content">
                @include('partials.settings_interests')
                @include('partials.settings_notifications')
            </div>
        </div>
    </div>
</div>