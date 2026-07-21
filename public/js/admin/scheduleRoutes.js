const searchInput = document.getElementById("searchInput");
const searchForm = document.getElementById("searchForm");

if (searchInput && searchForm) {
    let timer;

    searchInput.addEventListener("input", () => {
        clearTimeout(timer);

        timer = setTimeout(() => {
            searchForm.submit();
        }, 700);
    });
}

// =====================
// Create Schedule Modal
// =====================

const createScheduleModal = document.getElementById("createScheduleModal");

const openScheduleBtn = document.getElementById("openCreateScheduleModal");

const closeScheduleBtn = document.getElementById("closeScheduleModal");

const cancelScheduleBtn = document.getElementById("cancelSchedule");

const scheduleBackdrop = document.getElementById("scheduleBackdrop");

function openScheduleModal() {
    createScheduleModal?.classList.remove("hidden");
}

function closeScheduleModal() {
    createScheduleModal?.classList.add("hidden");
}

openScheduleBtn?.addEventListener("click", openScheduleModal);

closeScheduleBtn?.addEventListener("click", closeScheduleModal);

cancelScheduleBtn?.addEventListener("click", closeScheduleModal);

scheduleBackdrop?.addEventListener("click", closeScheduleModal);

// =====================
// Create Schedule Submit
// =====================

const createScheduleForm = document.getElementById("createScheduleForm");

if (createScheduleForm) {
    createScheduleForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        try {
            const response = await fetch("/admin/schedules", {
                method: "POST",

                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]',
                    ).content,

                    Accept: "application/json",
                },

                body: new FormData(createScheduleForm),
            });

            if (response.ok) {
                window.location.reload();
            } else if (response.status === 422) {
                const errors = await response.json();

                console.log(errors);
            } else {
                console.log(await response.text());
            }
        } catch (error) {
            console.error(error);
        }
    });
}
// =====================
// Edit Schedule
// =====================

const editScheduleModal = document.getElementById("editScheduleModal");

const editScheduleForm = document.getElementById("editScheduleForm");

document.querySelectorAll(".editScheduleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editScheduleModal.classList.remove("hidden");

        editScheduleForm.action = `/admin/schedules/${button.dataset.id}`;

        document.getElementById("edit_route").value = button.dataset.route;

        document.getElementById("edit_vehicle").value = button.dataset.vehicle;

        document.getElementById("edit_date").value = button.dataset.date;

        document.getElementById("edit_departure").value =
            button.dataset.departure;

        document.getElementById("edit_arrival").value = button.dataset.arrival;

        document.getElementById("edit_price").value = button.dataset.price;

        document.getElementById("edit_seats").value = button.dataset.seats;
    });
});

// close

function closeEditSchedule() {
    editScheduleModal.classList.add("hidden");
}

document
    .getElementById("cancelEditSchedule")
    ?.addEventListener("click", closeEditSchedule);

document
    .getElementById("editScheduleBackdrop")
    ?.addEventListener("click", closeEditSchedule);

// submit

editScheduleForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const response = await fetch(editScheduleForm.action, {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,

            Accept: "application/json",
        },

        body: new FormData(editScheduleForm),
    });

    if (response.ok) {
        window.location.reload();
    } else {
        console.log(await response.text());
    }
});

// =====================
// Delete Schedule Modal
// =====================

const deleteScheduleModal = document.getElementById("deleteScheduleModal");

const deleteScheduleForm = document.getElementById("deleteScheduleForm");

const deleteScheduleName = document.getElementById("deleteScheduleName");

document.querySelectorAll(".deleteScheduleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        deleteScheduleModal.classList.remove("hidden");

        deleteScheduleName.innerText = button.dataset.name;

        deleteScheduleForm.action = `/admin/schedules/${button.dataset.id}`;
    });
});

function closeDeleteSchedule() {
    deleteScheduleModal.classList.add("hidden");
}

document
    .getElementById("cancelDeleteSchedule")
    ?.addEventListener("click", closeDeleteSchedule);

document
    .getElementById("deleteScheduleBackdrop")
    ?.addEventListener("click", closeDeleteSchedule);

// =====================
// Delete Schedule Submit
// =====================

deleteScheduleForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const response = await fetch(deleteScheduleForm.action, {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,

            Accept: "application/json",
        },

        body: new FormData(deleteScheduleForm),
    });

    if (response.ok) {
        window.location.reload();
    } else {
        console.log(await response.text());
    }
});
