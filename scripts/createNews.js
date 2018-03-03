//initialize froala
$(function() {
    $('#newsBody').froalaEditor({
        heightMin: 300,
        tabSpaces: 4,
        toolbarButtonsXS: ['bold', 'italic', 'underline', 'fontSize', 'insertImage','|', 'undo', 'redo'],
    })
 });

 function createArticle(){
     event.preventDefault();
     console.log("Article created");
     document.location.href = "news_user_owns.html";
 }
