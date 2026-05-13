<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    public function indexUser(){
        $services = Service::all();
        return view('services', compact('services'));
    }

   
    public function create()
    {
        return view('admin.services.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'pathImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('pathImage')) {
            $path = $request->file('pathImage')->store('services', 'public');

            $validated['pathImage'] = $path;
        }

        Service::create($validated);

        return redirect('/admin/services')
            ->with('success', 'Servizio aggiunto con successo!');
    }

    
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'pathImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('pathImage')) {
            if (Storage::disk('public')->exists($service->pathImage)) {
                Storage::disk('public')->delete($service->pathImage);
            }

            $path = $request->file('pathImage')->store('service', 'public');
            $validated['pathImage'] = $path;
        }

        $service->update($validated);

        return redirect('/admin/services')->with('success', 'Servizio aggiornato con successo!');
    }
    
    public function destroy(Service $service)
    {
        $service->delete();

        return redirect('/admin/services')
            ->with('success', 'Servizio rimosso dal sistema.');
    }
}
