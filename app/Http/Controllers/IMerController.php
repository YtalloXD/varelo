<?php

namespace App\Http\Controllers;

use App\Models\Imer;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IMerController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
    $imers = Imer::with('user')
    ->latest()
    ->take(50)
    ->get();

        return view('home', compact('imers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            "message.required" => "Write something to post an IMer!",
            "message.max" => "IMer message cannot exceed 255 characters.",
        ]);

        auth()->user()->imers()->create($validated);

                // Obtenha o número de IMers enviados pelo usuário do cache
        $imersCount = Cache::get('user_imers_count', 0);

        // Incremente o número de IMers enviados pelo usuário
        Cache::put('user_imers_count', $imersCount + 1, 60); // Exemplo de tempo de expiração de 60 segundos

        // Verifique se o usuário atingiu o limite de IMers consecutivos
        if (Imer::count() >= 5) { // Exemplo de limite de 5 IMers consecutivos
            // Exiba uma mensagem de erro ou faça outra ação apropriada
            return redirect('/')->with('error', 'Você atingiu o limite de IMers consecutivos.');
        }

        return redirect('/')->with('success', "IMer was posted!");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imer $imer)
    {

        $this->authorize('update', $imer);

        return view('imers.edit', compact('imer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imer $imer)
    {

        $this->authorize('update', $imer);

        $validated = $request->validate(
 [
            'message' => 'required|string|max:255',
        ], [
            "message.required" => "Write something to post an IMer!",
            "message.max" => "IMer message cannot exceed 255 characters.",
        ]);

        $imer->update($validated);

        return redirect('/')->with('success', "IMer updated with success!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imer $imer)
    {
        $this->authorize('delete', $imer);

        $imer->delete();

        return redirect('/')->with('success', "IMer is now deleted!");
    }
}