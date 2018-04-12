//initialize froala
tinymce.init({
    selector: '#newsBody',
    height: 300,
    browser_spellcheck: true,
    plugins: [
      'advlist autolink link image lists charmap hr anchor pagebreak',
      'searchreplace code fullscreen',
      'save paste textcolor'
    ],
    content_css: 'bootswatch.css',
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
  });
  