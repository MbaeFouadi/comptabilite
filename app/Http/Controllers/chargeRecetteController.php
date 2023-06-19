<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class chargeRecetteController extends Controller
{
    //

    public function evolution_recette()
    {
        $composantes = DB::table("composantes")->get();
        return view("evolution_recette", compact("composantes"));
    }

    public function liste_evolution_recette(Request $request)
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $composante = DB::table("composantes")
            ->where("id", $request->composante_id)
            ->first();

        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", $request->composante_id)
            ->where("annee_civil_id", $anne_civil->id)
            ->where("date_enregistrement", "like", "%$date%")
            ->get();
        //   $da=$request->date;
        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->where("date_enregistrement", "like", "%$date%")
                ->select("type_recettes.designation", "type_recettes.prix", "recettes.date_enregistrement", "recettes.type_recette_id", "recettes.composante_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->where("date_enregistrement", "like", "%$date%")
                ->select("type_recettes.prix")

                ->sum("type_recettes.prix");


            return view("charge_recette_evolution", compact("recettes", "datas", "MontantTotal", "da", "composante", "date"));
        } else {


            $recettes = DB::table("type_recettes")
                ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                ->where("composantes_types_recettes.composante_id", $request->composante_id)
                ->select("type_recettes.*", "composantes_types_recettes.*")
                ->get();
            $messages = "Il n'y pas eu d'enregistrement sur ce type de recette ce jour là";

            return back()->with('error', "Il n'y pas eu d'enregistrement sur ce type de recette ce jour là");
        }
        // return view("charge_recette_evolution");
    }

    public function recette_preinscription()
    {
        return view("recette_préinscription");
    }

    public function recette_inscription()
    {
        return view("recette_inscription");
    }

    public function consolidation_recette()
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas = DB::table("recettes")
            ->join("composantes", "recettes.composante_id", "composantes.id")
            ->where("annee_civil_id", $anne_civil->id)
            ->select("designation_composante", "composantes.id as id_composante")
            ->distinct()
            ->get();


        return view("consolidation_recette", compact("datas"));
    }

    public function valider_depot()
    {
        $composantes = DB::table("composantes")
            ->get();
        return view("depot", compact("composantes"));
    }

    public function add_valider_depot(Request $request)
    {
        $request->validate([
            "montant" => "required",
            "composante_id" => "required",
            "transaction" => "required|unique:depot_validation"
        ]);

        $caisse = DB::table("caisse")
            ->where("composante_id", $request->composante_id)
            ->first();

        if (isset($caisse) && $caisse->montant >= $request->montant) {
            DB::table("depot_validation")->insert([
                "montant" => $request->montant,
                "composante_id" => $request->composante_id,
                "transaction" => $request->transaction,
                "date" => now(),
            ]);

            DB::table('caisse')
                ->where('composante_id', $request->composante_id)
                ->update(['montant' => $caisse->montant - $request->montant]);


            $compte = DB::table("comptes")
                ->where("composante_id", 1)
                ->first();

            if (isset($compte)) {
                DB::table('comptes')
                    ->where('composante_id', 1)
                    ->update(['montant' => $compte->montant + $request->montant]);

                return back()->with("success", "La validation du depôt a été effectuée avec succès");
            } else {
                DB::table("comptes")->insert([
                    "montant" => $request->montant,
                    "composante_id" => 1,

                ]);

                return back()->with("success", "La, validation est effectuée avec succès");
            }
        } else {
            return back()->with("error", "Ce montant est supérieur à celui qui est dans la caisse");
        }
    }

    public function evolution_recette_mensuel()
    {
        $composantes = DB::table("composantes")->get();
        return view("evolution_recette_composante", compact('composantes'));
    }
    public function liste_evolution_recette_mensuel(Request $request)
    {
        // $date = Carbon::createFromFormat($request->date, $request->date)
        //     ->format('Y-m-d');
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        // $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        // $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $mois = Carbon::parse($request->mois)->translatedFormat('m');

        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", $request->composante_id)
            ->where("annee_civil_id", $anne_civil->id)
            ->whereMonth("date_enregistrement", $mois)
            ->get();
        //   $da=$request->date;
        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->whereMonth("date_enregistrement", $mois)

                ->select("type_recettes.designation", "type_recettes.prix", "recettes.type_recette_id", "recettes.composante_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->whereMonth("recettes.date_enregistrement", $mois)
                ->select("type_recettes.prix")
                ->sum("type_recettes.prix");




            return view("liste_evolution_recette_mensuel", compact("recettes", "datas", "MontantTotal", "mois"));
        } else {


            $recettes = DB::table("type_recettes")
                ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                ->where("composantes_types_recettes.composante_id", $request->composante_id)
                ->select("type_recettes.*", "composantes_types_recettes.*")
                ->get();
            $messages = "Vous n'avez pas fait d'enregistrement sur ce type de recette ce jour là";

            return back()->with("error", "Vous n'avez pas fait d'enregistrement sur ce type de recette ce jour là");;
        }

        // return view("liste_consolidation_recette_mensuel",compact("mois"));
    }

    public function add_preinscription()
    {

        $client = new Client();


        $response = $client->get('http://127.0.0.1:801/api/droit_preinscription/', []);

        $datas = json_decode($response->getBody(), true);

        $droit = DB::table("recette_preins_inscription")
            ->where("type", 1)
            ->first();
        if (isset($droit)) {
            $data = $datas - $droit->montant;
        } else {
            $data = $datas;
        }

        return view("add_recette_preinscription", compact("data"));
    }

    public function add_inscription()
    {
        $client = new Client();


        $response = $client->get('http://127.0.0.1:801/api/droit_inscription/', []);

        $datas = json_decode($response->getBody(), true);

        $droit = DB::table("recette_preins_inscription")
            ->where("type", 2)
            ->first();

        if (isset($droit)) {
            $data = $datas - $droit->montant;
        } else {
            $data = $datas;
        }

        return view("add_recette_inscription", compact("data"));
    }

    public function store_preinscription(Request $request)
    {
        if ($request->droit > 0) {

            $droit = DB::table("recette_preins_inscription")
                ->where("type", 1)
                ->first();
            if (isset($droit)) {
                DB::table('recette_preins_inscription')
                    ->where('type', 1)
                    ->update(['montant' => $droit->montant + $request->droit]);
            } else {
                DB::table("recette_preins_inscription")->insert([
                    "montant" => $request->droit,
                    "type" => 1
                ]);
            }

            $compte = DB::table("comptes")
                ->where("composante_id", Auth::user()->composante_id)
                ->first();

            if (isset($compte)) {
                DB::table('comptes')
                    ->where("composante_id", Auth::user()->composante_id)
                    ->update(['montant' => $compte->montant + $request->droit]);
            } else {
                DB::table("comptes")->insert([
                    "montant" => $request->droit,
                    "composante_id" => Auth::user()->composante_id
                ]);
            }

            return back();
        } else {
            return back();
        }
    }

    public function store_inscription(Request $request)
    {
        if ($request->droit > 0) {
            $droit = DB::table("recette_preins_inscription")
                ->where("type", 2)
                ->first();
            if (isset($droit)) {
                DB::table('recette_preins_inscription')
                    ->where('type', 2)
                    ->update(['montant' => $droit->montant +  $request->droit]);
            } else {
                DB::table("recette_preins_inscription")->insert([
                    "montant" => $request->droit,
                    "type" => 2
                ]);
            }

            $compte = DB::table("comptes")
                ->where("composante_id", Auth::user()->composante_id)
                ->first();

            if (isset($compte)) {
                DB::table('comptes')
                    ->where("composante_id", Auth::user()->composante_id)
                    ->update(['montant' => $compte->montant + $request->droit]);
            } else {
                DB::table("comptes")->insert([
                    "montant" => $request->droit,
                    "composante_id" => Auth::user()->composante_id
                ]);
            }

            return back();
        } else {
            return back();
        }
    }

    public function historique_recette_annuel()
    {
        $composantes = DB::table("composantes")->get();
        return view("historique_annuelle_recette", compact("composantes"));
    }

    public function liste_historique_recette_annuel(Request $request)
    {
        // $date = Carbon::createFromFormat($request->date, $request->date)
        //     ->format('Y-m-d');
        $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        // $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        // $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $mois = Carbon::parse($request->mois)->translatedFormat('m');

        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", $request->composante_id)
            ->where("annee_civil_id", $annee_civil->id)

            ->get();
        //   $da=$request->date;
        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $annee_civil->id)


                ->select("type_recettes.designation", "type_recettes.prix", "recettes.type_recette_id", "recettes.composante_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", $request->composante_id)
                ->where("annee_civil_id", $annee_civil->id)

                ->select("type_recettes.prix")
                ->sum("type_recettes.prix");




            return view("liste_consolidation_recette_annuelle", compact("recettes", "datas", "MontantTotal", "annee_civil"));
        } else {


            $recettes = DB::table("type_recettes")
                ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                ->where("composantes_types_recettes.composante_id", $request->composante_id)
                ->select("type_recettes.*", "composantes_types_recettes.*")
                ->get();
            $messages = "Vous n'avez pas fait d'enregistrement sur ce type de recette";

            return back()->with("error", "Vous n'avez pas fait d'enregistrement sur ce type de recette");;
        }
    }

    public function show_solder_recette_par_composantes()
    {
        $soldes_recettes_par_composantes = DB::table("caisse")
        ->join("composantes", "composantes.id", "caisse.composante_id")
        ->get();
        return view('solder_recette_par_composantes', compact('soldes_recettes_par_composantes'));
    }
}
