function createHandlers(){
    let usersPaginationItems = [...document.querySelectorAll('.page-link')]
    if(usersPaginationItems!=null){
        usersPaginationItems.forEach(pagItem=>{
            pagItem.addEventListener('click',usersChangePage)
        })
    }
}

function usersChangePage(e){
    console.log(e)
    let pageNumber = parseInt(e.target.text);
    if(pageNumber<=0)return;
    let request = new XMLHttpRequest()
    request.onload = (x)=>console.log(x)
    request.open("get","/admin/users?pageNumber="+pageNumber+"&itemsPerPage="+10)
    request.send()
}

createHandlers();