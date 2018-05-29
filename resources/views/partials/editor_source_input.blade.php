@if(isset($source))

<div class="d-flex flex-wrap align-items-center source-inputs">
      <fieldset class="form-group mr-3">
        <label>Publication author:
          {{ Form::text('author[]', $source->author, ['class' => 'form-control', 'placeholder' => 'Publication author']) }}
        </label>
      </fieldset>

      <fieldset class="form-group mr-3">
      <label>Publication year:
        {{ Form::text('publication_year[]', $source->publication_year, ['class' => 'form-control', 'placeholder' => 'Publication year']) }}
        </label>
      </fieldset>

      <fieldset class="form-group mr-3">
      <label>Source URL:
        {{ Form::text('link[]', $source->link, ['class' => 'form-control', 'placeholder' => 'Link', 'required' => 'required']) }}
      </label>
      </fieldset>


      @if($first && $last)
        <fieldset class="form-group mr-3 mt-3" onclick="addSource(this)">
          <i class="fas fa-plus-circle"></i>
        </fieldset>
      @elseif (!$first && $last)
        <fieldset class="form-group mr-3 mt-3" onclick="addSource(this)">
          <i class="fas fa-plus-circle"></i>
        </fieldset>
        <fieldset class="form-group mt-3" onclick="removeSource(this)">
        <i class="fas fa-minus-circle"></i>
        </fieldset>
      @else
        <fieldset class="form-group mt-3" onclick="removeSource(this)">
        <i class="fas fa-minus-circle"></i>
        </fieldset>
      @endif
      

</div>
@else
  echo('error: source not set')
@endif