<div class="d-flex flex-wrap align-items-center source-inputs">
      <fieldset class="form-group mr-3">
        {{ Form::text('author[]', null, ['class' => 'form-control', 'placeholder' => 'Publication author']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('date[]', null, ['class' => 'form-control', 'placeholder' => 'Publication year']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('link[]', null, ['class' => 'form-control', 'placeholder' => 'Link', 'required' => 'required']) }}
      </fieldset>

      <fieldset class="form-group" onclick="addSource(this)">
        <i class="fas fa-plus-circle"></i>
      </fieldset>
</div>