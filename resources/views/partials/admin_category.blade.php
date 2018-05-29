<?php
if ($create_cat) {
    $icon_size = 'fa-4x';
} else {
    $icon_size = 'medium-big-icon';
}
?>

<div class="news_box d-flex flex-column flex-wrap align-items-center p-3" @if(!$create_cat) onclick="setEdit({{$cat_id}}, '{{$cat_name}}', '{{$cat_icon}}')" @endif>
    <i class="{{ $cat_icon }} fa-fw {{$icon_size}}"></i>
    <p class="m-0">{{ $cat_name }}</p>
</div>