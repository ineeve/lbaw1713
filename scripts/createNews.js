//initialize froala
tinymce.init({
    selector: '#newsBody',
    plugins: "image",
    menubar: "insert",
    toolbar: "image",
    image_list: [
      {title: 'My image 1', value: 'https://www.tinymce.com/my1.gif'},
      {title: 'My image 2', value: 'http://www.moxiecode.com/my2.gif'}
    ]
  });


 function createArticle(){
     event.preventDefault();
     console.log("Article created");
     document.location.href = "news_user_owns.html";
 }
