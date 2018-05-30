<script src="{{ asset('js/manageSources.js') }}" defer></script>

<div class="container my-5">
  <h3 class="text-primary">Post a news story!</h3>

  @if (isset($article))
    {{ Form::model($article, ['route' => ['update_news', $article->id], 'method' => 'PUT', 'files' => true]) }}
  @else
    {{ Form::open(['route' => 'news', 'files' => true]) }}
  @endif

  <fieldset class="form-group">
    {{ Form::label('title', 'Title *') }}
    @if ($errors->has('title'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('title') }} </strong>
      </div>
    @endif
    {{ Form::text('title', null, ['class' => 'form-control', 'required'=>'required', 'placeholder' => 'Insert title here']) }}


    {{ Form::label('section_id', 'Category *') }}
    @if ($errors->has('category'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('category') }} </strong>
      </div>
    @endif
    {{ Form::select('section_id', $sections, null, ['class' => 'form-control']) }}

    
    {{ Form::label('image', 'Preview image') }}
    @if ($errors->has('image'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('image') }} </strong>
      </div>
    @endif
    {{ Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) }}
    
  </fieldset>

  <fieldset class="form-group">
    {{ Form::label('body', 'Body *') }}
    @if ($errors->has('body'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('body') }} </strong>
      </div>
    @endif
    {{ Form::textarea('body', null, ['class' => 'form-control editor']) }}

  </fieldset>

  {{ Form::label('sources', 'Sources *') }}
 
  <div id="editor-sources">
  @if (isset($sources))
    @foreach ($sources as $source)
      <?php $first = False;
      $last = False; ?>
      @if($loop->first)
        <?php $first = True; ?>
      @endif
      @if($loop->last)
        <?php $last = True; ?>
      @endif
      @include('partials.editor_source_input',['source' => $source,'first' => $first, 'last' => $last])
    @endforeach
  @endif
  </div>


  {{ Form::submit('Submit', ['name' => 'submit', 'class' => 'btn btn-primary']) }}
  <div class="mt-5">* Field is required</div>

  {{ Form::close() }}

</div>
