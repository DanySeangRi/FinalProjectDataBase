const searchInput = document.getElementById("searchInput");
const searchForm = document.getElementById("searchForm");


if(searchInput && searchForm){

    let timer;


    searchInput.addEventListener("input",()=>{

        clearTimeout(timer);


        timer = setTimeout(()=>{

            searchForm.submit();

        },500);


    });

}