<script src="{{ asset('js/collapsible.js') }}" defer></script>

<div class="container-fluid mt-2">
    <div class="row">
        <!-- TABS -->
        <div class="col-xl-2 col-sm-3 col-12">
            <h3 data-toggle="collapse" data-target="#settings_list" aria-expanded="true" aria-controls="sections_list">
                <i class="fas fa-bars"></i> Settings</h3>
            <div class="collapse show collapsible" id="settings_list">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#interests">Interests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#notifications">Notifications</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-10 col-sm-9 col-12">
            <div id="settingsTabContent" class="tab-content">
                <div class="tab-pane fade active show" id="interests">
                    <h3>Manage Interests</h3>
                    <h4 class="pt-3">Add A New Interest</h4>
                    <form class="form-inline pb-3">
                        <input list="list_interests" name="interest" placeholder="Interest" class="form-control">
                        <datalist id="list_interests">
                            <option value="Sports"></option>
                            <option value="Politics"></option>
                            <option value="Business"></option>
                            <option value="Technology"></option>
                            <option value="Science"></option>
                        </datalist>
                        <input class="btn ml-2" value="Add" type="submit">
                    </form>
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action">Animals
                            <div class="float-right">X</div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Music
                            <div class="float-right">X</div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Food
                            <div class="float-right">X</div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">Travel
                            <div class="float-right">X</div>
                        </a>
                    </div>
                </div>
                <div class="tab-pane fade" id="notifications">
                    <h3>Manage Notifications</h3>
                    <fieldset class="pt-3">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="" id="article-comments">
                                <label class="custom-control-label" for="article-comments">
                                    Comments To My Articles
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="" id="article-votes">
                                <label class="custom-control-label" for="article-votes">
                                    Votes In My Articles
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="" id="follow-articles" checked>
                                <label class="custom-control-label" for="follow-articles">
                                    Articles from people I follow
                                </label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" value="" id="article-interest">
                                <label class="custom-control-label" for="article-interest">
                                    New articles of my interest
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>