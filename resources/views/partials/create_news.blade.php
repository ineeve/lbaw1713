<div class="container my-5">
      <h3 class="text-primary">Post a news story!</h3>
      <form method="POST" action="{{ route('news') }}">
        {{ csrf_field() }}
        <fieldset class="form-group">
          <label for="newsTitle">Title</label>
          <input type="text" name="title" class="form-control" id="newsTitle" placeholder="Insert the title here">
          <label for="list_categories" class="mt-2">Select category</label>
          <input list="list_categories" name="section_id" placeholder="Category" class="form-control">
          <datalist id="list_categories">
            <option value="Sports">
            <option value="Politics">
            <option value="Business">
            <option value="Technology">
            <option value="Science">
          </datalist>
          <label for="previewImage" class="mt-2">Preview image</label>
          <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="previewImage">
            <label class="custom-file-label" for="previewImage">Upload preview image</label>
          </div>
        </fieldset>
        <fieldset class="form-group">
          <label for="newsBody">Body</label>
          <textarea class="form-control editor" name="body"></textarea>
        </fieldset>
        <fieldset class="form-group">
          <label for="sources">Sources</label>
          <input id="sources " class="form-control" type="text" placeholder="Insert links to source, separated by comma">
        </fieldset>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>