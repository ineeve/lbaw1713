<div class="d-flex flex-wrap align-items-center source-inputs">
      <fieldset class="form-group mr-3">
        {{ Form::text('author', null, ['class' => 'form-control', 'placeholder' => 'Author']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('date', null, ['class' => 'form-control', 'placeholder' => 'Date']) }}
      </fieldset>

      <fieldset class="form-group mr-3">
        {{ Form::text('link', null, ['class' => 'form-control', 'placeholder' => 'Link']) }}
      </fieldset>

      <fieldset class="form-group add-source" onclick="addSource(this)">
        <i class="fas fa-plus-circle"></i>
      </fieldset>
</div>