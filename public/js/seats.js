const selectedSeatsDiv = document.getElementById("selectedSeats");
const ticketSubtotal = document.getElementById("ticketSubtotal");
const totalPrice = document.getElementById("totalPrice");
const continueBtn = document.getElementById("continueBtn");
const selectedSeatInput = document.getElementById("selectedSeatInput");

const seats = document.querySelectorAll(".seat-btn");

let selected = [];

function updateSummary() {
    // Get selected seat numbers
    const selectedNumbers = selected.map(id => {
        const element = document.querySelector(`[data-id="${id}"]`);
        return element.dataset.seat;
    });

    // Seat badges
    if (selectedNumbers.length === 0) {
        selectedSeatsDiv.innerHTML = `
            <span class="text-gray-400 text-sm">
                No seats selected
            </span>
        `;
    } else {
        selectedSeatsDiv.innerHTML = selectedNumbers
            .map(
                seat => `
                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                        ${seat}
                    </span>
                `
            )
            .join("");
    }

    // Calculate total
    const total = selected.length * seatPrice;

    ticketSubtotal.textContent = `$${total.toFixed(2)}`;
    totalPrice.textContent = `$${total.toFixed(2)}`;

    // Hidden input
    selectedSeatInput.value = selected.join(",");

    // Enable button
    continueBtn.disabled = selected.length === 0;
}

// Initial state
updateSummary();

seats.forEach((seat) => {

    if (seat.dataset.status === "booked") return;

    seat.addEventListener("click", () => {

        const seatId = seat.dataset.id;

        if (selected.includes(seatId)) {

            // Remove seat
            selected = selected.filter(id => id !== seatId);

            seat.classList.remove(
                "bg-[#86C5FF]",
                "border-[#86C5FF]",
                "text-white"
            );

            seat.classList.add(
                "bg-gray-100",
                "border-gray-300"
            );

        } else {

            if (selected.length >= 4) {
                alert("You can select a maximum of 4 seats.");
                return;
            }

            // Add seat
            selected.push(seatId);

            seat.classList.remove(
                "bg-gray-100",
                "border-gray-300"
            );

            seat.classList.add(
                "bg-[#86C5FF]",
                "border-[#86C5FF]",
                "text-white"
            );
        }

        updateSummary();

    });

});