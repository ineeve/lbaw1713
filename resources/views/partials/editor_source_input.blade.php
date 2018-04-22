@if(isset($source))

<div class="d-flex flex-wrap align-items-center source-inputs">
      <fieldset class="form-group mr-3">
        {{ Form::text('author[]', $source->author, ['class' => 'form-control', 'placeholder' => 'Publication author']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('publication_year[]', $source->publication_year, ['class' => 'form-control', 'placeholder' => 'Publication year']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('link[]', $source->link, ['class' => 'form-control', 'placeholder' => 'Link', 'required' => 'required']) }}
      </fieldset>

      @if($last)
      <fieldset class="form-group" onclick="addSource(this)">
        <i class="fas fa-plus-circle"></i>
      </fieldset>
      @endif

      <fieldset class="form-group" onclick="removeSource(this)">
        <i class="fas fa-minus-circle"></i>
      </fieldset>

</div>
@else
  echo('error: source not set')
@endif