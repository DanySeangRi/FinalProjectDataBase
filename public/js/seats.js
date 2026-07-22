const selectedSeatsText = document.getElementById("selectedSeats");

const totalPrice = document.getElementById("totalPrice");

const continueBtn = document.getElementById("continueBtn");

const selectedSeatInput = document.getElementById("selectedSeatInput");


const seats = document.querySelectorAll(".seat-btn");


let selected = [];



seats.forEach((seat) => {


    if (seat.dataset.status === "booked") {

        return;

    }



    seat.addEventListener("click", () => {


        const seatId = seat.dataset.id;

        const seatNumber = seat.dataset.seat;



        // already selected
        if (selected.includes(seatId)) {


            selected = selected.filter(
                id => id !== seatId
            );


            seat.classList.remove(
                "bg-[#86C5FF]",
                "text-white",
                "border-[#86C5FF]"
            );


            seat.classList.add(
                "bg-gray-100",
                "border-gray-300"
            );



        } else {


            // maximum 4 seats

            if (selected.length >= 4) {

                return;

            }



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





        // display seat number

        const selectedNumbers = selected.map(id => {


            const element = document.querySelector(
                `[data-id="${id}"]`
            );


            return element.dataset.seat;


        });



        selectedSeatsText.innerHTML =
            selectedNumbers.length
            ? selectedNumbers.join(", ")
            : "None";





        // calculate price

        totalPrice.innerHTML =
            "$" + selected.length * seatPrice;





        // send seat IDs to Laravel

        selectedSeatInput.value =
            selected.join(",");





        continueBtn.disabled =
            selected.length === 0;



    });



});