// =====================
// Search Vehicle
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
    createModal?.classList.remove("hidden");
}

function closeCreateModal() {
    createModal?.classList.add("hidden");
}

openCreateBtn?.addEventListener("click", openCreateModal);

closeCreateBtn?.addEventListener("click", closeCreateModal);

cancelCreateBtn?.addEventListener("click", closeCreateModal);

createBackdrop?.addEventListener("click", closeCreateModal);

// =====================
// Create Vehicle
// =====================

const createForm = document.getElementById("createVehicleForm");

if (createForm) {
    createForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        try {
            const response = await fetch("/admin/vehicles", {
                method: "POST",

                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,

                    Accept: "application/json",
                },

                body: new FormData(createForm),
            });

            if (response.ok) {
                window.location.reload();
            } else if (response.status === 422) {
                console.log(await response.json());
            }
        } catch (error) {
            console.error(error);
        }
    });
}

// =====================
// Edit Vehicle Modal
// =====================

const editModal = document.getElementById("editVehicleModal");
const editForm = document.getElementById("editVehicleForm");

const editId = document.getElementById("edit_id");
const editVehicleNumber = document.getElementById("edit_vehicle_number");
const editBrand = document.getElementById("edit_brand");
const editPlateNumber = document.getElementById("edit_plate_number");
const editType = document.getElementById("edit_type");
const editYear = document.getElementById("edit_year");
const editCapacity = document.getElementById("edit_capacity");
const editStatus = document.getElementById("edit_status");

document.querySelectorAll(".editVehicleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editModal.classList.remove("hidden");

        editId.value = button.dataset.id;

        editForm.action = `/admin/vehicles/${button.dataset.id}`;

        console.log("Vehicle ID:", editId.value);

        editVehicleNumber.value = button.dataset.number || "";

        editBrand.value = button.dataset.brand || "";

        editPlateNumber.value = button.dataset.plate || "";

        editType.value = button.dataset.type || "";

        editYear.value = button.dataset.year || "";

        editCapacity.value = button.dataset.capacity || "";

        editStatus.value = button.dataset.status || "active";
    });
});

// Close modal

function closeEditModal() {
    editModal.classList.add("hidden");
}

document
    .getElementById("closeEditModal")
    ?.addEventListener("click", closeEditModal);

document
    .getElementById("cancelEditModal")
    ?.addEventListener("click", closeEditModal);

document
    .getElementById("editBackdrop")
    ?.addEventListener("click", closeEditModal);

// =====================
// Update Vehicle
// =====================

if (editForm) {
    editForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(editForm);

        const response = await fetch(editForm.action, {
            method: "POST",

            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,

                Accept: "application/json",
            },

            body: formData,
        });

        if (response.ok) {
            window.location.reload();
        } else {
            console.log(await response.text());
        }
    });
}

// =====================
// Delete Vehicle Modal
// =====================

const deleteModal = document.getElementById("deleteVehicleModal");

const deleteForm = document.getElementById("deleteVehicleForm");

const deleteName = document.getElementById("deleteVehicleName");

document.querySelectorAll(".deleteVehicleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        deleteModal?.classList.remove("hidden");

        deleteName.innerText = button.dataset.name;

        deleteForm.action = `/admin/vehicles/${button.dataset.id}`;
    });
});

function closeDeleteModal() {
    deleteModal?.classList.add("hidden");
}

document
    .getElementById("cancelDelete")
    ?.addEventListener("click", closeDeleteModal);

document
    .getElementById("deleteBackdrop")
    ?.addEventListener("click", closeDeleteModal);

// =====================
// Delete Vehicle
// =====================

if (deleteForm) {
    deleteForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        try {
            const response = await fetch(deleteForm.action, {
                method: "POST",

                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,

                    Accept: "application/json",
                },

                body: new FormData(deleteForm),
            });

            if (response.ok) {
                window.location.reload();
            }
        } catch (error) {
            console.error(error);
        }
    });
}
