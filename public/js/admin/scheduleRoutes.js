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

// ==================================================
// Create Schedule Modal
// ==================================================

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

// ==================================================
// Duration Calculator (CREATE)
// ==================================================

const departureInput = document.getElementById("departure_time");

const arrivalInput = document.getElementById("arrival_time");

const durationPreview = document.getElementById("durationPreview");

function calculateDuration() {
    if (!departureInput?.value || !arrivalInput?.value) {
        return;
    }

    let start = new Date(`2000-01-01 ${departureInput.value}`);

    let end = new Date(`2000-01-01 ${arrivalInput.value}`);

    if (end < start) {
        end.setDate(end.getDate() + 1);
    }

    let minutes = (end - start) / 60000;

    let hours = Math.floor(minutes / 60);

    let mins = minutes % 60;

    if (durationPreview) {
        durationPreview.innerText = `${hours}h ${mins}m`;
    }
}

departureInput?.addEventListener("change", calculateDuration);

arrivalInput?.addEventListener("change", calculateDuration);

// ==================================================
// Create Schedule Submit
// ==================================================

const createScheduleForm = document.getElementById("createScheduleForm");

createScheduleForm?.addEventListener("submit", async (e) => {
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
        } else {
            console.log(await response.text());
        }
    } catch (error) {
        console.error(error);
    }
});

// ==================================================
// Edit Schedule
// ==================================================

const editScheduleModal = document.getElementById("editScheduleModal");

const editScheduleForm = document.getElementById("editScheduleForm");

document.querySelectorAll(".editScheduleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editScheduleModal?.classList.remove("hidden");

        editScheduleForm.action = `/admin/schedules/${button.dataset.id}`;

        document.getElementById("edit_route").value = button.dataset.route;

        document.getElementById("edit_vehicle").value = button.dataset.vehicle;

        document.getElementById("edit_date").value = button.dataset.date;

        document.getElementById("edit_departure").value =
            button.dataset.departure;

        document.getElementById("edit_arrival").value = button.dataset.arrival;

        document.getElementById("edit_price").value = button.dataset.price;

        document.getElementById("edit_seats").value = button.dataset.seats;

        // Show Duration

        const durationMinutes = Number(button.dataset.duration);

        const hours = Math.floor(durationMinutes / 60);

        const minutes = durationMinutes % 60;

        const editDurationPreview = document.getElementById(
            "editDurationPreview",
        );

        if (editDurationPreview) {
            editDurationPreview.innerText = `${hours}h ${minutes}m`;
        }
    });
});

// close edit

function closeEditSchedule() {
    editScheduleModal?.classList.add("hidden");
}

document
    .getElementById("cancelEditSchedule")
    ?.addEventListener("click", closeEditSchedule);

document
    .getElementById("editScheduleBackdrop")
    ?.addEventListener("click", closeEditSchedule);

// ==================================================
// Edit Submit
// ==================================================

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

// ==================================================
// Delete Schedule Modal
// ==================================================

const deleteScheduleModal = document.getElementById("deleteScheduleModal");

const deleteScheduleForm = document.getElementById("deleteScheduleForm");

const deleteScheduleName = document.getElementById("deleteScheduleName");

document.querySelectorAll(".deleteScheduleBtn").forEach((button) => {
    button.addEventListener("click", () => {
        deleteScheduleModal?.classList.remove("hidden");

        deleteScheduleName.innerText = button.dataset.name;

        deleteScheduleForm.action = `/admin/schedules/${button.dataset.id}`;
    });
});

function closeDeleteSchedule() {
    deleteScheduleModal?.classList.add("hidden");
}

document
    .getElementById("cancelDeleteSchedule")
    ?.addEventListener("click", closeDeleteSchedule);

document
    .getElementById("deleteScheduleBackdrop")
    ?.addEventListener("click", closeDeleteSchedule);

// ==================================================
// Delete Submit
// ==================================================

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
