<?php

namespace App\Http\Controllers\Administrador;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PushSubscriptionController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'endpoint' => [
                'required',
                'string',
                'max:4096',
            ],

            'keys.p256dh' => [
                'required',
                'string',
            ],

            'keys.auth' => [
                'required',
                'string',
            ],

            'contentEncoding' => [
                'nullable',
                'string',
                'max:50',
            ],
        ]);

        $request->user()->updatePushSubscription(
            $datos['endpoint'],
            $datos['keys']['p256dh'],
            $datos['keys']['auth'],
            $datos['contentEncoding'] ?? null
        );

        return response()->json([
            'success' => true,
            'message' => 'Las notificaciones fueron activadas correctamente.',
        ]);
    }

    public function destroy(Request $request): JsonResponse
    {
        $datos = $request->validate([
            'endpoint' => [
                'required',
                'string',
                'max:4096',
            ],
        ]);

        $request->user()->deletePushSubscription(
            $datos['endpoint']
        );

        return response()->json([
            'success' => true,
            'message' => 'Las notificaciones fueron desactivadas.',
        ]);
    }
}
