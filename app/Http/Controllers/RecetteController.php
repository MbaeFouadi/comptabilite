<?php

namespace App\Http\Controllers;

use App\Models\recette;
use Carbon\Carbon;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecetteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $annees = DB::table("annee")->orderBy("id", "desc")->get();
        $recettes = DB::table("type_recettes")
            ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
            ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
            ->where("employe", "=", 0)
            ->where("location", "=", 0)
            ->where("etat", "=", 0)
            ->where("droit_inscription", "=", 0)
            ->select("type_recettes.id as id_type_recette", "type_recettes.*", "composantes_types_recettes.*")
            ->get();
        return view('add_recette', compact("recettes", "annees"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //*

        // $client = new Client();
        // $response = $client->get('http://127.0.0.1:801/api/etudiant');
        // $data = json_decode($response->getBody(), true);

        $client = new Client();


        $response = $client->post('http://127.0.0.1:801/api/etudiant', [
            'form_params' => [
                'mat_etud' => $request->mat_etud,
                'annee' => $request->annee_id,
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return view("show_information_etudiant", compact("data"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $request->validate([
        //     "type_recette"=>'required',
        //     "mat_etud"=>'required',
        //     "annee"
        // ]
        $civil = DB::table("annee_civil")
            ->orderByDesc("id")
            ->first();

        $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');

        $rece=DB::table("recettes")
        ->where("type_recette_id",$request->type_recette)
        ->where("matricule",$request->mat_etud)
        ->where("annee_civil_id",$civil->id)
        ->where("composante_id",Auth::user()->composante_id)
        ->where("date_enregistrement",$date)
        ->first();

        if(!isset($rece))
        {
            DB::table("recettes")->insertOrIgnore([
                "type_recette_id" => $request->type_recette,
                "matricule" => $request->mat_etud,
                "annee_civil_id" => $civil->id,
                "composante_id" => Auth::user()->composante_id,
                "date_enregistrement" => now(),
            ]);
    
        }
       
        $montant = DB::table("type_recettes")
            ->where("id", $request->type_recette)
            ->first();

        if ($montant->hologramme == 1) {

            $holo = DB::table("hologrammes")
                ->where("composante_id", Auth::user()->composante_id)
                ->first();

            DB::table('hologrammes')
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['holo_restant' => $holo->holo_restant - 1]);
        }

        $caisse = DB::table("caisse")->where("composante_id", Auth::user()->composante_id)
            ->first();
        if (isset($caisse)) {
            $somme = $caisse->montant + $montant->prix;

            DB::table("caisse")
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['montant' => $somme]);
        } else {
            $somme = $montant->prix;

            DB::table("caisse")
                ->insert([
                    "montant" => $somme,
                    "composante_id" => Auth::user()->composante_id,
                ]);
        }

        $client = new Client();


        $response = $client->post('http://127.0.0.1:801/api/etudiant', [
            'form_params' => [
                'mat_etud' => $request->mat_etud,
                'annee' => $request->annees,
            ]
        ]);


        $data = json_decode($response->getBody(), true);

        $recette=DB::table("recettes")
        ->join("type_recettes","type_recettes.id","recettes.type_recette_id")
        ->where("type_recette_id",$request->type_recette)
        ->select("recettes.id as recette_id","type_recettes.*")
        ->orderByDesc("recettes.id")
        ->first();

        return view("reçu_recette", compact("data","montant","recette"));
    }

    /**
     * Display the specified resource.
     */
    public function show(recette $recette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recette $recette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recette $recette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(recette $recette)
    {
        //
    }

    public function recu()
    {
        return view("reçu_recette");
    }

    public function historique()
    {

        $recettes = DB::table("type_recettes")
            ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
            ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
            ->select("type_recettes.*", "composantes_types_recettes.*")
            ->get();

        return view("historique", compact("recettes"));
    }

    public function liste(Request $request)
    {




        // $date = Carbon::createFromFormat($request->date, $request->date)
        //     ->format('Y-m-d');
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", Auth::user()->composante_id)
            ->where("annee_civil_id", $anne_civil->id)
            ->where("date_enregistrement", "like", "%$date%")
            ->get();
        //   $da=$request->date;
        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->where("date_enregistrement", "like", "%$date%")
                ->select("type_recettes.designation", "type_recettes.prix","recettes.date_enregistrement", "recettes.type_recette_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("annee_civil_id", $anne_civil->id)
                ->where("date_enregistrement", "like", "%$date%")
                ->select("type_recettes.prix")

                ->sum("type_recettes.prix");


            return view("liste_recette", compact("recettes", "datas", "MontantTotal","da"));
        } else {


            $recettes = DB::table("type_recettes")
                ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
                ->select("type_recettes.*", "composantes_types_recettes.*")
                ->get();
            $messages = "Vous n'avez pas fait d'enregistrement sur ce type de recette ce jour là";

            return view("historique", compact("messages", 'recettes'));
        }
    }

    public function caisse_journalier()
    {
        return view("caissie_journalier");
    }
    public function caisse()
    {
        $caisse = DB::table("caisse")->where("composante_id", Auth::user()->composante_id)->first();
        return view('caisse', compact("caisse"));
    }


    public function postDataToApi()
    {
        $client = new Client();


        $response = $client->post('http://127.0.0.1:801/api/etudiant', [
            'form_params' => [
                'mat_etud' => 'value1',
                'param2' => 'value2',
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        return view('my-view', ['data' => $data]);
    }

    public function show_info(Request $request)
    {


        $holo = DB::table("hologrammes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();
            $recette = DB::table("type_recettes")
            ->where("id", $request->type_recette_id)
            ->first(); 
        if ((isset($holo) && $holo->holo_restant > 0 ) || ($recette->hologramme == 0)) {
            

            $client = new Client();


            $response = $client->post('http://127.0.0.1:801/api/etudiant', [
                'form_params' => [
                    'mat_etud' => $request->mat_etud,
                    'annee' => $request->annee,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
          
            // $type_recette=$request->type_recette;
            $annee = DB::table("annee")->where("designation_annee", $request->annee)->first();
            $annee_id = $annee->id;

            if (isset($data)) {
                return view("show_information_etudiant", compact("data", "recette", "annee_id"));
            } else {
                $messages = "cet étudiant n'est pas inscris l'année sélectionner";
                $annees = DB::table("annee")->orderBy("id", "desc")->get();
                $recettes = DB::table("type_recettes")
                    ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                    ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
                    ->where("employe", "=", 0)
                    ->select("type_recettes.id as id_type_recette", "type_recettes.*", "composantes_types_recettes.*")
                    ->get();
                return view('add_recette', compact("recettes", "annees", "messages"));
            }
        } else {
            $messages = "Vous avez épuisé le nombre d'hologramme";
            $annees = DB::table("annee")->orderBy("id", "desc")->get();
            $recettes = DB::table("type_recettes")
                    ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                    ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
                    ->where("employe", "=", 0)
                    ->select("type_recettes.id as id_type_recette", "type_recettes.*", "composantes_types_recettes.*")
                    ->get();
                return view('add_recette', compact("recettes", "annees", "messages"));
        }
    }

    public function detail_caisse(Request $request)
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", Auth::user()->composante_id)
            ->where("annee_civil_id", $anne_civil->id)
            ->where("date_enregistrement", "like", "%$date%")
            ->get();
        return view("caisse");
    }

    public function add_recette_location()
    {
        $recettes = DB::table("type_recettes")
        ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
        ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
     
        ->where("location", "=", 1)
        ->select("type_recettes.id as id_type_recette", "type_recettes.*", "composantes_types_recettes.*")
        ->get();
        return view("add_recette_location",compact("recettes"));
    }

    public function store_recette_location(Request $request)
    {
        $request->validate([
            "description"=>'required',
            "nbre_jour"=>'required',
            "facture"=>'required|mimes:pdf|max:2048',
            "type_recette_id"=>'required',
        ]);

        $facture = $request->description. '.' . $request->facture->extension();

        $request->facture->move(public_path('assets/facture_location'), $facture);
        
        DB::table("recette_locations")->insert([
            "description"=>$request->description,
            "nbre_jour"=>$request->nbre_jour,
            "facture"=>$facture,
           
        ]);

        $annee = DB::table("annee_civil")->orderByDesc("id")->first();
        $location = DB::table("recette_locations")->orderByDesc("id")->first();
        DB::table("recettes")->insert([
            "date_enregistrement" => now(),
            "type_recette_id" => $request->type_recette_id,
            "composante_id" => Auth::user()->composante_id,
            "recette_location_id" => $location->id,
            "annee_civil_id" => $annee->id
        ]);

        $data = DB::table("recette_locations")
            ->join("recettes", "recette_locations.id", "recettes.recette_location_id")
            ->join("type_recettes", "type_recettes.id", "recettes.type_recette_id")
            ->where("recettes.recette_location_id",$location->id)
            ->orderByDesc("recette_locations.id")->first();

        $caisse = DB::table("caisse")->where("composante_id", Auth::user()->composante_id)
            ->first();
        if (isset($caisse)) {
            $somme = $caisse->montant + ($data->prix * $data->nbre_jour);

            DB::table("caisse")
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['montant' => $somme]);
        } else {
            $somme = $data->prix*$data->nbre_jour;

            DB::table("caisse")
                ->insert([
                    "montant" => $somme,
                    "composante_id" => Auth::user()->composante_id,
                ]);
        }

        return back()->with("success","Enregistrement effectués avec succès");

     
    }
}
