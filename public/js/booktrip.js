const fromSelect = document.getElementById('fromPlace');
const toSelect = document.getElementById('toPlace');
const swapBtn = document.getElementById('swapBtn'); 
const tripForm = document.getElementById('tripSearchForm'); 


//Swap Button
swapBtn.addEventListener('click', function(){
    const temp = fromSelect.value;
    fromSelect.value = toSelect.value;
    toSelect.value = temp;

    updateHiddenOptions();
});


//Avoid same options for From and To by Hidding the matching option

function updateHiddenOptions(){
    Array.from(toSelect.options).forEach(opt=>opt.hidden=false); 
    Array.from(fromSelect.options).forEach(opt=>opt.hidden=false); 

    if (fromSelect.value){
        Array.from(toSelect.options).forEach(opt=>{
            if(opt.value === fromSelect.value){
                opt.hidden = true;
            }
        })
    }


    if(toSelect.value){
        Array.from(fromSelect.options).forEach(opt => {
            if(opt.value === toSelect.value){
                opt.hidden = true; 
            }
        })
    }

}

fromSelect.addEventListener('change', updateHiddenOptions);
    toSelect.addEventListener('change', updateHiddenOptions);

    tripForm.addEventListener('submit', function (e) {
        if(fromSelect.value === toSelect.value){
            e.preventDefault();
            alert('Same Destination travel is unsupported')
        }
    })