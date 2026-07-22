
<form id="tripSearchForm" action="/booktrip" method="GET">

    <label for="fromPlace">From</label>
    <select name="from" id="fromPlace" required>
          <option value="">Select departure</option>
          @foreach ($departPlace as $place)
            <option value="{{$place}}" {{ (isset($from) && $from === $place) ? 'selected' : ''}}>
             {{$place}}
            </option>
          @endforeach

    </select>

    <button type="button" id="swapBtn" title="swap">⇄</button>
    
    <label for="toPlace">To</label>
    <select name="to" id="toPlace" required>
        <option value="">Select destination</option>
        @foreach($arrivePlace as $place)
        <option value="{{$place}}" {{(isset($to) && $to === $place) ? 'selected' : ''}}>
            {{$place}}
        </option>
        @endforeach
    </select>

    <label for="tripDate">Date</label>
    <input type="date" name="date" id="tripDate" value="{{ $date ?? ''}}" required>

    <button type="submit" id="searchBtn">Search</button>

</form>

@if(isset($scheds))
    <div class="results-banner">
        <h2>{{ $from }} → {{ $to }}</h2>
        <p>
            {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }} 
            · {{ count($scheds) }} buses found
        </p>
    </div>

    <div class="results-list">
        @forelse ($scheds as $sched)
            <div class="trip-card">
                <h3>{{ $sched->vehicleName }}</h3>
                <p>{{ $sched->departTime }} — {{ $sched->departPlace }}</p>
                <p>{{ $sched->arrivalTime }} — {{ $sched->arrivePlace }}</p>
                <p>Duration: {{ $sched->duration }}</p>
                <p>Amenities: {{ $sched->ammenities }}</p>
                <p>Price: ${{ $sched->price }} per person</p>
                <p>{{ $sched->availableSeat }} seats left</p>
                <a href="/booktrip/select/{{$sched->scheduleID}}" class="select-btn">Select</a>
            
            </div>
        @empty
            <p>No trips found for this route and date.</p>
        @endforelse
    </div>
@endif

<script src="{{asset('js/booktrip.js')}}"></script>

