// =====================
// Search Routes
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
// Create Route Modal
// =====================

const createModal = document.getElementById("createRouteModal");

const openCreateBtn = document.getElementById("openCreateRouteModal");
const closeCreateBtn = document.getElementById("closeCreateRouteModal");
const cancelCreateBtn = document.getElementById("cancelCreateRoute");
const createBackdrop = document.getElementById("createBackdrop");

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
// Create Route
// =====================

const createForm = document.getElementById("createRouteForm");

if (createForm) {
    createForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const response = await fetch("/admin/routes", {
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
            location.reload();
        }

        if (response.status === 422) {
            console.log(await response.json());
        }
    });
}

// =====================
// Edit Route Modal
// =====================

const editModal = document.getElementById("editRouteModal");

const editId = document.getElementById("edit_route_id");

const editOrigin = document.getElementById("edit_origin");

const editDestination = document.getElementById("edit_destination");

const editDistance = document.getElementById("edit_distance");

const editDuration = document.getElementById("edit_duration");

document.querySelectorAll(".editRouteBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editModal.classList.remove("hidden");

        editId.value = button.dataset.id;

        editOrigin.value = button.dataset.origin;

        editDestination.value = button.dataset.destination;

        editDistance.value = button.dataset.distance;

        editDuration.value = button.dataset.duration;
    });
});

function closeEditModal() {
    editModal.classList.add("hidden");
}

document
    .getElementById("closeEditRouteModal")
    ?.addEventListener("click", closeEditModal);

document
    .getElementById("cancelEditRoute")
    ?.addEventListener("click", closeEditModal);

document
    .getElementById("editRouteBackdrop")
    ?.addEventListener("click", closeEditModal);

// =====================
// Update Route
// =====================

const editForm = document.getElementById("editRouteForm");

if (editForm) {
    editForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const id = editId.value;

        const response = await fetch(`/admin/routes/${id}`, {
            method: "POST",

            headers: {
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,

                Accept: "application/json",
            },

            body: new FormData(editForm),
        });

        if (response.ok) {
            location.reload();
        }
    });
}

// =====================
// Delete Route Modal
// =====================

const deleteModal = document.getElementById("deleteRouteModal");

const deleteForm = document.getElementById("deleteRouteForm");

const deleteName = document.getElementById("deleteRouteName");

const cancelDeleteRoute = document.getElementById("cancelDeleteRoute");

const deleteRouteBackdrop = document.getElementById("deleteRouteBackdrop");

// Open Delete Modal

document.querySelectorAll(".deleteRouteBtn").forEach((button) => {
    button.addEventListener("click", () => {
        deleteModal.classList.remove("hidden");

        deleteName.innerText = button.dataset.name;

        deleteForm.action = `/admin/routes/${button.dataset.id}`;
    });
});

// Close Delete Modal

function closeDeleteModal() {
    deleteModal.classList.add("hidden");
}

if (cancelDeleteRoute) {
    cancelDeleteRoute.addEventListener("click", closeDeleteModal);
}

if (deleteRouteBackdrop) {
    deleteRouteBackdrop.addEventListener("click", closeDeleteModal);
}

// =====================
// Delete Submit
// =====================

if (deleteForm) {
    deleteForm.addEventListener("submit", async (e) => {
        e.preventDefault();

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
    });
}
