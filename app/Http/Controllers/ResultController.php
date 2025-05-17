<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lga;
use App\Models\PollingUnit;
use App\Models\AnnouncedPuResult;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{

    public function showPollingUnitResult(Request $request)
    {

        $pollingUnits = PollingUnit::where('lga_id', '!=', 0)->get();

        $results = collect();

        if ($request->filled('polling_unit_uniqueid')) {
            $results = AnnouncedPuResult::where('polling_unit_uniqueid', $request->polling_unit_uniqueid)->get();
        }

        return view('polling-units.show', compact('pollingUnits', 'results'));
    }

    public function showLgaResultForm()
    {
        $lgas = Lga::where('state_id', 25)->get();
        return view('lga.total_results_form', compact('lgas'));
    }


    public function showLgaResult(Request $request)
    {
        $request->validate([
            'lga_id' => 'required|exists:lga,lga_id',
        ]);

        $lgas = Lga::where('state_id', 25)->get();

        $pollingUnitIds = PollingUnit::where('lga_id', $request->lga_id)->pluck('uniqueid');

        $results = AnnouncedPuResult::whereIn('polling_unit_uniqueid', $pollingUnitIds)
            ->select('party_abbreviation', DB::raw('SUM(party_score) as total_score'))
            ->groupBy('party_abbreviation')
            ->get();

        return view('lga.total_results_form', compact('lgas', 'results'));
    }


    public function createResultForm()
    {
        $pollingUnits = PollingUnit::where('lga_id', '!=', 0)->get();
        $parties = Party::all();
        return view('create_result', compact('pollingUnits', 'parties'));
    }


    public function storeResult(Request $request)
    {
        $request->validate([
            'polling_unit_uniqueid' => 'required|exists:polling_unit,uniqueid',
            'party_scores.*' => 'required|integer|min:0',
            'party_scores.*' => 'string|max:10',
            'entered_by_user' => 'required|string|max:255',
        ]);

        foreach ($request->party_scores as $partyId => $score) {
            AnnouncedPuResult::create([
                'polling_unit_uniqueid' => $request->polling_unit_uniqueid,
                'party_abbreviation' => $partyId,
                'party_score' => $score,
                'entered_by_user' => $request->entered_by_user,
                'date_entered' => now(),
                'user_ip_address' => $request->ip(),
            ]);
        }

        return redirect()->route('result.create')->with('success', 'Results saved successfully!');
    }
}
