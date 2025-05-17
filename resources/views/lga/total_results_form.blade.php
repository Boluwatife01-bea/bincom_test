@extends('layouts.app')

@section('content')
<form method="GET" action="{{ route('result.lga.total') }}" class="mb-4">
    @csrf
    <label for="lga_id" class="form-label">Select Local Government Area (LGA)</label>
    <select name="lga_id" id="lga_id" class="form-select" required>
        <option value="">-- Choose an LGA --</option>
        @foreach($lgas as $lga)
            <option value="{{ $lga->lga_id }}" {{ request('lga_id') == $lga->lga_id ? 'selected' : '' }}>
                {{ $lga->lga_name }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-3">Get Summed Results</button>
</form>

@if(!empty($results) && $results->count() > 0)
    <h4>Summed Results for LGA: {{ $lgas->firstWhere('lga_id', request('lga_id'))->lga_name ?? '' }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Party</th>
                <th>Total Result</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
            <tr>
                <td>{{ $result->party_abbreviation }}</td>
                <td>{{ $result->total_score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@elseif(request('lga_id'))
    <div class="alert alert-warning">No results found for selected LGA.</div>
@endif
@endsection
