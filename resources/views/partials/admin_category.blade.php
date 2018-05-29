<div class="news_box d-flex flex-column flex-wrap align-items-center p-3" @if(!$edit_cat) onclick="setEdit( {{$cat_id}} )" @endif>
    <i class="{{ $cat_icon }} fa-fw medium-big-icon"></i>
    <p class="m-0">{{ $cat_name }}</p>
</div>