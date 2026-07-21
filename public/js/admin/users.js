// =====================
// Search
// =====================

const searchInput = document.getElementById("searchInput");
const searchForm = document.getElementById("searchForm");

if (searchInput) {
    let timer;

    searchInput.addEventListener("input", () => {
        clearTimeout(timer);

        timer = setTimeout(() => {
            searchForm.submit();
        }, 700);
    });
}

// =====================
// Create User Modal
// =====================

const modal = document.getElementById("createUserModal");

const openBtn = document.getElementById("openCreateUserModal");

const closeBtn = document.getElementById("closeCreateUserModal");

const cancelBtn = document.getElementById("cancelCreateUser");

const backdrop = document.getElementById("modalBackdrop");

function openModal() {
    modal.classList.remove("hidden");
}

function closeModal() {
    modal.classList.add("hidden");
}

if (openBtn) {
    openBtn.addEventListener("click", openModal);
}

if (closeBtn) {
    closeBtn.addEventListener("click", closeModal);
}

if (cancelBtn) {
    cancelBtn.addEventListener("click", closeModal);
}

if (backdrop) {
    backdrop.addEventListener("click", closeModal);
}

// =====================
// AJAX Create User
// =====================

const form = document.getElementById("createUserForm");
if (form) {
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        let data = new FormData(form);

        fetch("/admin/users", {
            method: "POST",

            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,
                Accept: "application/json",
            },

            body: data,
        })
            .then(async (response) => {
                console.log("Status:", response.status);

                if (response.status === 422) {
                    let errors = await response.json();
                    console.log(errors);
                    return;
                }

                if (response.ok) {
                    window.location.reload();
                }
            })
            .catch((error) => {
                console.error(error);
            });
    });
}

// EDIT MODAL

const editModal = document.getElementById("editUserModal");

document.querySelectorAll(".editUserBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editModal.classList.remove("hidden");

        document.getElementById("edit_id").value = button.dataset.id;

        document.getElementById("edit_first_name").value = button.dataset.first;

        document.getElementById("edit_last_name").value = button.dataset.last;

        document.getElementById("edit_email").value = button.dataset.email;

        document.getElementById("edit_phone").value = button.dataset.phone;
    });
});

document.getElementById("closeEditModal").onclick = () => {
    editModal.classList.add("hidden");
};

// =====================
// UPDATE USER
// =====================

const editForm = document.getElementById("editUserForm");

if (editForm) {
    editForm.addEventListener("submit", (e) => {
        e.preventDefault();

        const id = document.getElementById("edit_id").value;

        const data = new FormData(editForm);

        fetch(`/admin/users/${id}`, {
            method: "POST",

            headers: {
                "X-Requested-With": "XMLHttpRequest",

                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,

                Accept: "application/json",
            },

            body: data,
        }).then(async (response) => {
            if (response.status === 422) {
                const errors = await response.json();

                console.log(errors);

                return;
            }

            if (response.ok) {
                window.location.reload();
            }
        });
    });
}
// DELETE MODAL

const deleteModal = document.getElementById("deleteUserModal");

document.querySelectorAll(".deleteUserBtn").forEach((button) => {
    button.onclick = () => {
        deleteModal.classList.remove("hidden");

        document.getElementById("deleteUserName").innerText =
            button.dataset.name;

        document.getElementById("deleteUserForm").action =
            "/admin/users/" + button.dataset.id;
    };
});

document.getElementById("cancelDelete").onclick = () => {
    deleteModal.classList.add("hidden");
};

// =====================
// DELETE USER
// =====================

const deleteForm = document.getElementById("deleteUserForm");

if (deleteForm) {
    deleteForm.addEventListener("submit", (e) => {
        e.preventDefault();

        fetch(deleteForm.action, {
            method: "POST",

            headers: {
                "X-Requested-With": "XMLHttpRequest",

                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]',
                ).content,

                Accept: "application/json",
            },

            body: new FormData(deleteForm),
        }).then((response) => {
            if (response.ok) {
                window.location.reload();
            }
        });
    });
}
