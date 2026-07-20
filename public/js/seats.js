const rows = Math.ceil(seatCapacity / 4);
const cols = ["A", "B", "C", "D"];



const container = document.getElementById("seatContainer");

const selectedSeatsText = document.getElementById("selectedSeats");

const totalPrice = document.getElementById("totalPrice");

const continueBtn = document.getElementById("continueBtn");

let selected = [];

function seatClass(status){

    switch(status){

        case "reserved":
            return "bg-gray-200 border-gray-200 text-gray-400 cursor-not-allowed";

        case "selected":
            return "bg-blue-600 border-blue-600 text-white";

        default:
            return "bg-gray-100 border-gray-300 hover:bg-blue-50 cursor-pointer";

    }

}

for(let row=1; row<=rows; row++){

    const rowDiv=document.createElement("div");

    rowDiv.className="flex items-center gap-2";

    rowDiv.innerHTML=`<span class="w-8 text-center text-xs">${row}</span>`;

    const left=document.createElement("div");
    left.className="flex gap-2";

    const aisle=document.createElement("div");
    aisle.className="w-6";

    const right=document.createElement("div");
    right.className="flex gap-2";

    cols.forEach(col=>{

        const id=row+col;

        const status=reserved.includes(id)
            ? "reserved"
            : "available";

        const btn=document.createElement("button");

        btn.innerText=col;

        btn.dataset.id=id;

        btn.dataset.status=status;

        btn.className=`w-10 h-10 rounded-lg border-2 text-xs font-semibold ${seatClass(status)}`;

        if(status!=="reserved"){

            btn.onclick=()=>{

                if(btn.dataset.status==="selected"){

                    btn.dataset.status="available";

                    selected=selected.filter(s=>s!==id);

                }else{

                    if(selected.length>=4)return;

                    btn.dataset.status="selected";

                    selected.push(id);

                }

                btn.className=`w-10 h-10 rounded-lg border-2 text-xs font-semibold ${seatClass(btn.dataset.status)}`;

                selectedSeatsText.innerHTML=
                    selected.length
                        ? selected.join(", ")
                        : "None";

                totalPrice.innerHTML="$"+selected.length*seatPrice;

                continueBtn.disabled=selected.length===0;

            }

        }

        if(col==="A"||col==="B")
            left.appendChild(btn);
        else
            right.appendChild(btn);

    });

    rowDiv.appendChild(left);

    rowDiv.appendChild(aisle);

    rowDiv.appendChild(right);

    container.appendChild(rowDiv);

}