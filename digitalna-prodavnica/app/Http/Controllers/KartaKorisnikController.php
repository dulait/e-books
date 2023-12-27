<?php

namespace App\Http\Controllers;

use App\Models\Karta;
use App\Models\KartaKorisnik;
use App\Models\Korisnik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KartaKorisnikController extends Controller
{
    public function dodajKartu(Request $request, $korisnikId, $brojKarte)
    {
        $korisnik = Korisnik::where('korisnikId', $korisnikId)->first();

        if ($request->user()->id !== $korisnik->id) {
            return response()->json(['greska' => 'Nije dozvoljen pristup'], 400);
        }

        $karta = Karta::where('brojKarte', $brojKarte)->first();

        if (!$karta) {
            return response()->json(['poruka' => 'Ne postoji karta sa brojem: ' . $brojKarte], 400);
        }

        if ($karta->kolicina > 0) {
            $karta->kolicina--;
            $karta->save();

            $kartaKorisnik = new KartaKorisnik([
                'kartaId' => $karta->kartaId,
                'korisnikId' => $korisnik->korisnikId,
                'kolicina' => 1,
            ]);
            $kartaKorisnik->save();

            return response()->json([
                'poruka' => 'Karta dodata korisniku',
                'karta' => $karta,
                'korisnik' => $korisnik,
            ], 200);
        } else {
            return response()->json(['poruka' => 'Nema dovoljno karata na stanju'], 400);
        }
    }

    public function vratiSveKarte($korisnikId)
    {
        $korisnik = Korisnik::where('korisnikId', $korisnikId)->first();
        $karte = $korisnik->karte;

        return response()->json([
            'korisnik' => $korisnik,
        ]);
    }

    public function vratiKartu($korisnikId, $brojKarte)
    {
        $korisnik = Korisnik::where('korisnikId', $korisnikId)->first();

        if (!$korisnik) {
            return response()->json(['poruka' => 'Ne postoji dati korisnik']);
        }
        $karta = Karta::where('brojKarte', $brojKarte)->first();

        if (!$karta) {
            return response()->json(['poruka' => 'Korisnik nema datu kartu']);
        }

        return response()->json([
            'korisnik' => $korisnik,
            'karta' => $karta,
        ]);
    }
}