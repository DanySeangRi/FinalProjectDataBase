

<a href="{{ url()->previous() }}" class="btn btn-secondary">
    ← Back
</a>



<h3>{{$sched->vehicle->vehicleName}}</h3>
<p>{{$sched->route->departPlace}} → {{$sched->route->arrivePlace}} • {{ \Carbon\Carbon::parse($sched->departDate)->format('l, F j, Y') }} </p>

<p><strong>{{$sched->departTime}}</strong></p>
<p>{{$sched->duration}}</p>
<p><strong>{{$sched->arrivalTime}}</strong></p>

<p>{{$sched->route->boardStation}}</p>
<p>{{$sched->route->dropOffStation}}</p>


<p>Total Seats: 
    <span>
        <strong> {{$sched->vehicle->capacity}}</strong>
    </span>
</p>


<p>Available Seats: 
    <span>
        <strong> {{$sched->availableSeat}}</strong>
    </span>
</p>

<p><strong>{{$sched->price}}</strong></p>



<h3>Ammenities</h3>
<p>{{$sched->vehicle->ammenities}}</p>



<h3>Boarding & Drop-off Points</h3>
<p><strong>{{$sched->route->boardStation}}</strong></p>
<p>{{$sched->route->departPlace}} • {{$sched->departTime}}</p>
<p><strong>{{$sched->route->dropOffStation}}</strong></p>
<p>{{$sched->route->arrivePlace}} • {{$sched->arrivalTime}}</p>


<h3>Booking Summary</h3>
<p>
    Route: 
    <span>
        <strong>{{$sched->route->departPlace}} → {{$sched->route->arrivePlace}}</strong>
    </span>
</p>

<p>
    Date: 
    <span>
        <strong>{{ \Carbon\Carbon::parse($sched->departDate)->format('l, F j, Y') }}</strong>
    </span>
</p>

<p>
    Departure Time: 
    <span>
        <strong>{{ \Carbon\Carbon::parse($sched->departTime)->format('l, F j, Y') }}</strong>
    </span>
</p>

</p>

<a href="/booktrip/select-seat/{{$sched->scheduleID}}" class="select-btn">Select Seat</a>
