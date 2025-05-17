@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('result.polling-unit') }}" class="mb-4">
    <label for="polling_unit_uniqueid" class="form-label">Select Polling Unit</label>
    <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select" required>
        <option value="">-- Choose a Polling Unit --</option>
        @foreach ($pollingUnits as $unit)
            <option value="{{ $unit->uniqueid }}" {{ request('polling_unit_uniqueid') == $unit->uniqueid ? 'selected' : '' }}>
                {{ $unit->polling_unit_name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-3">View Result</button>
</form>

@if(!empty($results) && $results->count() > 0)
    <h4>Results for Polling Unit: {{ $pollingUnits->firstWhere('uniqueid', request('polling_unit_uniqueid'))->polling_unit_name ?? '' }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Party</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->party_abbreviation }}</td>
                <td>{{ $result->party_score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@elseif(request('polling_unit_uniqueid'))
    <div class="alert alert-warning">No results found for selected polling unit.</div>
@endif
@endsection
