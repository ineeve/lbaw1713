
<div class="btn-group d-flex align-items-center" role="group">

    <button title="Ordering Criteria" id="criteriaDropdown" class="mr-2 coolBtn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span id="sort-option" data-name="POPULAR" >Popularity <i class="fas fa-chevron-down ml-2 mt-1"></i></span>
    </button>

    <div class="dropdown-menu order" aria-labelledby="criteriaDropdown">
        <a class="dropdown-item order-criteria" data-name="POPULAR" href="#">Popularity</a>
        <a class="dropdown-item order-criteria" data-name="VOTED" href="#">Votes</a>
        <a class="dropdown-item order-criteria" data-name="RECENT" href="#">Date</a>
    </div>

    <button  id="reverseOrderButton" title="Reverse Order" type="button" class="coolBtn"><i class="fas fa-retweet fa-fw"></i></button>
    
</div>