<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'profile_image.required' => 'Por favor, selecione uma imagem.',
            'profile_image.image' => 'O arquivo deve ser uma imagem.',
            'profile_image.mimes' => 'A imagem deve ser do tipo: jpeg, png, jpg ou gif.',
            'profile_image.max' => 'A imagem não pode ser maior que 2MB.',
        ]);

        try {
            $user = $request->user();

            if (!$request->hasFile('profile_image')) {
                return back()->withErrors(['profile_image' => 'Nenhum arquivo foi enviado.']);
            }

            $image = $request->file('profile_image');
            $name = time().'_'.preg_replace('/[^a-zA-Z0-9._-]/', '_', $image->getClientOriginalName());
            $path = $image->storeAs('profile_images', $name, 'public');

            if (!$path) {
                return back()->withErrors(['profile_image' => 'Erro ao salvar a imagem no servidor.']);
            }

            // Delete old image if exists
            if ($user->profile_image && Storage::disk('public')->exists($user->profile_image)) {
                Storage::disk('public')->delete($user->profile_image);
            }

            // Update user profile image
            $updated = $user->update([
                'profile_image' => $path
            ]);

            if (!$updated) {
                // If update failed, delete the uploaded file
                Storage::disk('public')->delete($path);
                return back()->withErrors(['profile_image' => 'Erro ao atualizar o perfil no banco de dados.']);
            }

            return back()->with('success', 'Imagem de perfil atualizada com sucesso!');
        } catch (\Exception $e) {
            Log::error('Erro ao fazer upload da imagem de perfil: ' . $e->getMessage());
            return back()->withErrors(['profile_image' => 'Erro inesperado: ' . $e->getMessage()]);
        }
    }
}
