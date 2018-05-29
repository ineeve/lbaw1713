@if(is_null($news) || count($news) == 0)
<div class="container ml-0">
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
    <strong>Sorry!</strong> There are no news to show in this section.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
</div>
@endif
@each('partials.news_item_preview', $news, 'item')