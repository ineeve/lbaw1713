<script src="{{ asset('js/addSource.js') }}" defer></script>

<div class="container my-5">
  <h3 class="text-primary">Post a news story!</h3>

  @if (isset($article))
    {{ Form::model($article, ['route' => ['update_news', $article->id], 'method' => 'PATCH', 'files' => true]) }}
  @else
    {{ Form::open(['route' => 'news', 'files' => true]) }}
  @endif

  <fieldset class="form-group">
    {{ Form::label('title', 'Title') }}
    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Insert title here']) }}

    {{ Form::label('section_id', 'Category') }}
    {{ Form::select('section_id', $sections, null, ['class' => 'form-control']) }}

    
    {{ Form::label('image', 'Preview image') }}
    {{ Form::file('image', ['class' => 'form-control']) }}
  </fieldset>

  <fieldset class="form-group">
    {{ Form::label('body', 'Body') }}
    {{ Form::textarea('body', null, ['class' => 'form-control editor']) }}
  </fieldset>

  {{ Form::label('sources', 'Sources') }}

  <div id="editor-sources">
    @include('partials.editor_source_input')
  </div>

  {{ Form::submit('Submit', ['name' => 'submit', 'class' => 'btn btn-primary']) }}

  {{ Form::close() }}

</div>
