<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponsPostRequest;
use App\Models\Promocode;
use Carbon\Carbon;
use Gabievi\Promocodes\Facades\Promocodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CouponsController extends Controller
{
    public function index(Request $request)
    {
        // $coupons = Promocodes::all()->sortBy('expires_at');

        $coupons = Promocode::when($request->q, function ($query, $q) {
            $query->where('code', 'LIKE', '%' . $q . '%');
        })->paginate(5);

        return Inertia::render('Coupons/Index', [
            'coupons' => $coupons,
            'q' => $request->q,
        ]);
    }

    public function store(CouponsPostRequest $request)
    {
        $validated = $request->validated();

        $reward = $validated['reward'];
        $quantity = (int) $validated['quantity'];
        $expires_in = (int) $validated['expiresAt'];
        $data = [
            'nb_days_expired' => $expires_in,
            'created_at' => now(),
        ];

        Promocodes::create(1, $reward, $data, $expires_in, $quantity, $is_disposable = false);

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Ajouter avec succès');
        return redirect()->route('admin.coupons.index');
    }

    public function destroy(Request $request)
    {
        $code = $request->get('code');
        if (is_null($code)) {
            return redirect()->route('admin.coupons.index');
        }
        Promocodes::disable($code);

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Supprimé avec succès');

        return redirect()->route('admin.coupons.index');
    }

    public function destroyAll(Request $request)
    {
        Promocodes::clearRedundant();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Supprimé avec succès');

        return redirect()->route('admin.coupons.index');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:promocodes,id',
            'reward' => 'required|numeric|gt:0',
            'quantity' => 'required|integer|gt:0',
            'expiresAt' => 'required|integer|gt:0',
        ]);
        $coupon = Promocode::findOrFail($validated['id']);
        $coupon->reward = (int) $validated['reward'];
        $coupon->quantity = (int) $validated['quantity'];
        $expiresAt = (int) $validated['expiresAt'];
        $created_at = $coupon->created_at;
        $coupon->expires_at = Carbon::parse($created_at)->setTimezone('Africa/Algiers')->addDays($expiresAt);
        $coupon->data = [
            'nb_days_expired' => $expiresAt,
            'created_at' => $created_at,
        ];
        $coupon->save();

        $request->session()->flash('type', 'success');
        $request->session()->flash('message', 'Modifier avec succès');
        return redirect()->route('admin.coupons.index');
    }
}
