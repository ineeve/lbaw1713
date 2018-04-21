<script src="{{ asset('js/manageSources.js') }}" defer></script>

<div class="container my-5">
  <h3 class="text-primary">Post a news story!</h3>

  @if (isset($article))
    {{ Form::model($article, ['route' => ['update_news', $article->id], 'method' => 'PUT', 'files' => true]) }}
  @else
    {{ Form::open(['route' => 'news', 'files' => true]) }}
  @endif

  <fieldset class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Insert title here']) }}
    @if ($errors->has('title'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> {{ $errors->first('title') }} </strong>
      </div>
    @endif

    {{ Form::label('section_id', 'Category') }}
    {{ Form::select('section_id', $sections, null, ['class' => 'form-control']) }}
    @if ($errors->has('category'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> {{ $errors->first('category') }} </strong>
      </div>
    @endif
    
    {{ Form::label('image', 'Preview image') }}
    {{ Form::file('image', ['class' => 'form-control', 'accept' => 'image/*']) }}
    @if ($errors->has('image'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> {{ $errors->first('image') }} </strong>
      </div>
    @endif
  </fieldset>

  <fieldset class="form-group">
    {{ Form::label('body', 'Body') }}
    {{ Form::textarea('body', null, ['class' => 'form-control editor']) }}
    @if ($errors->has('body'))
      <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> {{ $errors->first('body') }} </strong>
      </div>
    @endif
  </fieldset>

  {{ Form::label('sources', 'Sources') }}

  <div id="editor-sources">
    @include('partials.editor_source_input')
  </div>

  {{ Form::submit('Submit', ['name' => 'submit', 'class' => 'btn btn-primary']) }}

  {{ Form::close() }}

</div>
