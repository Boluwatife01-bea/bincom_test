@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('result.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="polling_unit_uniqueid" class="form-label">Polling Unit</label>
        <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select" required>
            <option value="">-- Select Polling Unit --</option>
            @foreach($pollingUnits as $unit)
                <option value="{{ $unit->uniqueid }}">{{ $unit->polling_unit_name }}</option>
            @endforeach
        </select>
    </div>

    @foreach($parties as $party)
        <div class="mb-3">
            <label class="form-label">{{ $party->partyname ?? $party->partyid }} Score</label>
            <input type="number" name="party_scores[{{ $party->partyid }}]" class="form-control" min="0" required />
        </div>
    @endforeach

    <div class="mb-3">
        <label for="entered_by_user" class="form-label">Agent Name</label>
        <input type="text" name="entered_by_user" id="entered_by_user" class="form-control" required />
    </div>

    <button type="submit" class="btn btn-success">Submit Results</button>
</form>
@endsection
