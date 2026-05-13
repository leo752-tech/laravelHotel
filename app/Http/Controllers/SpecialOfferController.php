<?php

namespace App\Http\Controllers;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;

class SpecialOfferController extends Controller
{

    
    public function index()
    {
        $offers = SpecialOffer::all();
        return view('specialOffer', ['specialOffers' => $offers]);
    }

    
    public function create()
    {
        return view('admin.offers.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lenght' => 'required|integer|min:1',
            'specialPrice' => 'required|integer|min:0',
        ]);

        SpecialOffer::create($validated);

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offerta speciale creata con successo!');
    }

    
    public function show(SpecialOffer $specialOffer)
    {
        return view('admin.offers.show', compact('specialOffer'));
    }

    
    public function edit(SpecialOffer $specialOffer)
    {
        return view('admin.offers.edit', compact('specialOffer'));
    }

    public function update(Request $request, SpecialOffer $specialOffer)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lenght' => 'required|integer|min:1',
            'specialPrice' => 'required|integer|min:0',
        ]);

        $specialOffer->update($validated);

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offerta aggiornata correttamente!');
    }

    
    public function destroy(SpecialOffer $specialOffer)
    {
        $specialOffer->delete();

        return redirect()->route('admin.offers.index')
            ->with('success', 'Offerta eliminata.');
    }
}
