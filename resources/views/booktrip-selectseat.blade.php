
<h3>Select your Seat</h3>
<p>
    {{$sched->vehicle->vehicleName}} • {{$sched->route->departPlace}}→ {{$sched->route->arrivePlace}}
</p>

<p>Available</p>
<p>Select</p>
<p>Taken</p>

<h3>Seat Selected</h3>
<p> 
    <span>
        <strong>Total</strong>
    </span>

    <span>
        <strong>{{$sched->price}}</strong>
    </span>
</p>

<a href="/booktrip/fill-info/{{$sched->scheduleID}}" class="select-btn">Continue</a>
