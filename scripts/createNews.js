// initialize tiny mce
tinymce.init({ selector:'#tinymce' });

//initialize ckeditor
ClassicEditor
        .create( document.querySelector( '#ckeditor_classic' ) )
        .catch( error => {
            console.error( error );
        } );

//initialize froala
$(function() { $('#froala').froalaEditor() });