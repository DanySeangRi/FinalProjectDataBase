// =====================
// Search
// =====================

const searchInput = document.getElementById("searchInput");
const searchForm = document.getElementById("searchForm");

if (searchInput && searchForm) {

    let timer;

    searchInput.addEventListener("input", () => {

        clearTimeout(timer);

        timer = setTimeout(() => {
            searchForm.submit();
        }, 500);

    });

}



// =====================
// Create Vehicle Modal
// =====================

const createModal = document.getElementById("createVehicleModal");

const openCreateBtn = document.getElementById("openCreateVehicleModal");
const closeCreateBtn = document.getElementById("closeCreateVehicleModal");
const cancelCreateBtn = document.getElementById("cancelCreateVehicle");
const createBackdrop = document.getElementById("modalBackdrop");


function openCreateModal() {

    if(createModal){
        createModal.classList.remove("hidden");
    }

}


function closeCreateModal(){

    if(createModal){
        createModal.classList.add("hidden");
    }

}


if(openCreateBtn)
    openCreateBtn.onclick = openCreateModal;


if(closeCreateBtn)
    closeCreateBtn.onclick = closeCreateModal;


if(cancelCreateBtn)
    cancelCreateBtn.onclick = closeCreateModal;


if(createBackdrop)
    createBackdrop.onclick = closeCreateModal;




// =====================
// AJAX Create Vehicle
// =====================


const createForm = document.getElementById("createVehicleForm");


if(createForm){

    createForm.addEventListener("submit", async(e)=>{


        e.preventDefault();


        const data = new FormData(createForm);


        const response = await fetch(
            "/admin/vehicles",
            {

                method:"POST",

                headers:{

                    "X-CSRF-TOKEN":
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,

                    Accept:"application/json"

                },


                body:data

            }
        );



        if(response.ok){

            window.location.reload();

        }


        else if(response.status === 422){

            console.log(await response.json());

        }


    });

}




// =====================
// Edit Vehicle Modal
// =====================


const editModal =
document.getElementById("editVehicleModal");


const editId =
document.getElementById("edit_id");


const editVehicleNumber =
document.getElementById("edit_vehicle_number");


const editType =
document.getElementById("edit_type");


const editCapacity =
document.getElementById("edit_capacity");


const editDriver =
document.getElementById("edit_driver_name");


const editStatus =
document.getElementById("edit_status");


const closeEdit =
document.getElementById("closeEditModal");


const cancelEdit =
document.getElementById("cancelEditModal");


const editBackdrop =
document.getElementById("editBackdrop");



document.querySelectorAll(".editVehicleBtn")
.forEach(button=>{


    button.addEventListener("click",()=>{


        editModal.classList.remove("hidden");


        editId.value =
        button.dataset.id;


        editVehicleNumber.value =
        button.dataset.number;


        editType.value =
        button.dataset.type;


        editCapacity.value =
        button.dataset.capacity;


        editDriver.value =
        button.dataset.driver ?? "";


        editStatus.value =
        button.dataset.status;


    });


});



function closeEditModal(){

    editModal.classList.add("hidden");

}



if(closeEdit)
    closeEdit.onclick = closeEditModal;


if(cancelEdit)
    cancelEdit.onclick = closeEditModal;


if(editBackdrop)
    editBackdrop.onclick = closeEditModal;




// =====================
// Update Vehicle
// =====================


const editForm =
document.getElementById("editVehicleForm");


if(editForm){

    editForm.addEventListener("submit", async(e)=>{


        e.preventDefault();


        const id = editId.value;


        const data =
        new FormData(editForm);



        const response =
        await fetch(
            `/admin/vehicles/${id}`,
            {

                method:"POST",

                headers:{

                    "X-CSRF-TOKEN":
                    document.querySelector(
                    'meta[name="csrf-token"]'
                    ).content,

                    Accept:"application/json"

                },


                body:data

            }
        );



        if(response.ok){

            window.location.reload();

        }


    });

}




// =====================
// Delete Vehicle Modal
// =====================


const deleteModal =
document.getElementById("deleteVehicleModal");


const deleteName =
document.getElementById("deleteVehicleName");


const deleteForm =
document.getElementById("deleteVehicleForm");


const cancelDelete =
document.getElementById("cancelDelete");


const deleteBackdrop =
document.getElementById("deleteBackdrop");



document.querySelectorAll(".deleteVehicleBtn")
.forEach(button=>{


    button.addEventListener("click",()=>{


        deleteModal.classList.remove("hidden");


        deleteName.innerText =
        button.dataset.name;


        deleteForm.action =
        `/admin/vehicles/${button.dataset.id}`;


    });


});



function closeDeleteModal(){

    deleteModal.classList.add("hidden");

}



if(cancelDelete)
    cancelDelete.onclick = closeDeleteModal;


if(deleteBackdrop)
    deleteBackdrop.onclick = closeDeleteModal;




// =====================
// Delete Vehicle Submit
// =====================


if(deleteForm){


    deleteForm.addEventListener("submit",async(e)=>{


        e.preventDefault();


        const response =
        await fetch(
            deleteForm.action,
            {

                method:"POST",

                headers:{

                    "X-CSRF-TOKEN":
                    document.querySelector(
                    'meta[name="csrf-token"]'
                    ).content,

                    Accept:"application/json"

                },


                body:new FormData(deleteForm)

            }
        );



        if(response.ok){

            window.location.reload();

        }


    });


}