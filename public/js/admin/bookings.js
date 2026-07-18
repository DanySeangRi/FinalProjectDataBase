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

//booking modal
const bookingModal = document.getElementById("createBookingModal");

document
    .getElementById("openCreateBookingModal")
    ?.addEventListener("click", () => {
        bookingModal.classList.remove("hidden");
    });

function closeBookingModal() {
    bookingModal.classList.add("hidden");
}

document
    .getElementById("closeBookingModal")
    ?.addEventListener("click", closeBookingModal);

document
    .getElementById("cancelBooking")
    ?.addEventListener("click", closeBookingModal);

document
    .getElementById("bookingBackdrop")
    ?.addEventListener("click", closeBookingModal);

const scheduleSelect = document.getElementById("scheduleSelect");

const bookingPrice = document.getElementById("bookingPrice");

scheduleSelect?.addEventListener("change", () => {
    const option = scheduleSelect.options[scheduleSelect.selectedIndex];

    bookingPrice.value = option.dataset.price ? "$" + option.dataset.price : "";
});

const createBookingForm = document.getElementById("createBookingForm");

createBookingForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const response = await fetch("/admin/bookings", {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,

            Accept: "application/json",
        },

        body: new FormData(createBookingForm),
    });

    if (response.ok) {
        window.location.reload();
    } else {
        console.log(await response.json());
    }
});

//Edit Modal
const editBookingModal = document.getElementById("editBookingModal");

const editBookingForm = document.getElementById("editBookingForm");

document.querySelectorAll(".editBookingBtn").forEach((button) => {
    button.addEventListener("click", () => {
        editBookingModal.classList.remove("hidden");

        editBookingForm.action = `/admin/bookings/${button.dataset.id}`;

        document.getElementById("edit_user").value = button.dataset.user;

        document.getElementById("edit_schedule").value =
            button.dataset.schedule;

        document.getElementById("edit_seat").value = button.dataset.seat;

        document.getElementById("edit_status").value = button.dataset.status;
    });
});

function closeEditBookingModal() {
    editBookingModal.classList.add("hidden");
}

document
    .getElementById("closeEditBookingModal")
    ?.addEventListener("click", closeEditBookingModal);

document
    .getElementById("cancelEditBooking")
    ?.addEventListener("click", closeEditBookingModal);

document
    .getElementById("editBookingBackdrop")
    ?.addEventListener("click", closeEditBookingModal);

editBookingForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const response = await fetch(editBookingForm.action, {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,

            Accept: "application/json",
        },

        body: new FormData(editBookingForm),
    });

    if (response.ok) {
        window.location.reload();
    } else {
        console.log(await response.json());
    }
});

//open delete modal
const deleteBookingModal = document.getElementById("deleteBookingModal");

const deleteBookingForm = document.getElementById("deleteBookingForm");

const deleteBookingCode = document.getElementById("deleteBookingCode");

document.querySelectorAll(".deleteBookingBtn").forEach((button) => {
    button.addEventListener("click", () => {
        deleteBookingModal.classList.remove("hidden");

        deleteBookingCode.innerText = button.dataset.code;

        deleteBookingForm.action = `/admin/bookings/${button.dataset.id}`;
    });
});

// Close

function closeDeleteBooking() {
    deleteBookingModal.classList.add("hidden");
}

document
    .getElementById("cancelDeleteBooking")
    ?.addEventListener("click", closeDeleteBooking);

document
    .getElementById("deleteBackdrop")
    ?.addEventListener("click", closeDeleteBooking);

// Delete Submit
deleteBookingForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    const response = await fetch(deleteBookingForm.action, {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,

            Accept: "application/json",
        },

        body: new FormData(deleteBookingForm),
    });

    if (response.ok) {
        window.location.reload();
    }
});


