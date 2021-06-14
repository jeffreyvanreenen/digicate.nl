@if(Request::is('/'))
<div id="weerinfo">
    <div class="container vertical-center">
        <div class="row">
            <div class="col-sm">
                <img src="{{ $station->icoonactueel  }}">
            </div>
            <div class="col-sm">
                {{ $station->icoonactueel['zin'] }}<br/>

            </div>
            <div class="col-sm">
                <stron>Temperatuur:</stron>
                <br/>
                <small>{{ $station->temperatuurGC }} &#x2103;</small>
            </div>
            <div class="col-sm">
                <strong>Wind:</strong><br/>
                <small>{{ $station->windsnelheidBF }} Bft - {{ $station->windrichting }}</small>
            </div>
            <div class="col-sm">
                <strong>Luchtvochtigheid:</strong><br/>
                <small>{{ $station->luchtvochtigheid }}&percnt;</small>
            </div>
        </div>
    </div>
</div>
@endif
