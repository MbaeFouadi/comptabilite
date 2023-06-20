<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class gestionnaireController extends Controller
{
    //
    public function consolidation_recette()
    {

        // $date = Carbon::createFromFormat($request->date, $request->date)
        //     ->format('Y-m-d');
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        // $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        // $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $date = "2023-06-06";
        $da = "2023-06-06";

        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("droit_inscription", 0)
            ->where("etat", 0)
            ->where("recettes.composante_id", Auth::user()->composante_id)
            ->where("annee_civil_id", $anne_civil->id)

            ->get();

        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("droit_inscription", 0)
                ->where("etat", 0)
                ->where("annee_civil_id", $anne_civil->id)

                ->select("type_recettes.designation", "type_recettes.prix", "recettes.type_recette_id", "recettes.composante_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("droit_inscription", 0)
                ->where("etat", 0)

                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("annee_civil_id", $anne_civil->id)

                ->select("type_recettes.prix")

                ->sum("type_recettes.prix");


            return view("petit_consolidation_recette", compact("recettes", "datas", "MontantTotal", "da"));
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

    public function retrait_cheque()
    {
        $datas = DB::table("cheques")
            ->where("composante_id", Auth::user()->composante_id)
            ->get();

        return view("retrait_cheque", compact("datas"));
    }

    public function add_retrait_cheque(Request $request)
    {
        $request->validate([
            "numero_cheque" => "required|unique:cheques",
            "montant" => "required"
        ]);

        $compte = DB::table("comptes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();

        if (isset($compte) && ($compte->montant >= $request->montant)) {
            $datas = DB::table("cheques")
                ->where("composante_id", Auth::user()->composante_id)
                ->get();

            DB::table("cheques")->insert([
                "numero_cheque" =>  $request->numero_cheque,
                "montant" => $request->montant,
                "composante_id" => Auth::user()->composante_id,
            ]);

            return redirect('gestionnaire/depense/retrait_cheque');
        } else {
            $messages = "Vous n'avez pas le solde suffissant pour cette opération";
            $datas = DB::table("cheques")
                ->where("composante_id", Auth::user()->composante_id)
                ->get();

            return view("retrait_cheque", compact("datas", "messages"));
        }
    }

    public function enregistrement_depense()
    {
        $cheques = DB::table("cheques")
            ->where("composante_id", Auth::user()->composante_id)
            ->orderByDesc("id")
            ->get();
        $depenses = DB::table("type_depense")
            // ->join("composantes","type_depense.composante_id","composantes.id")
            ->join("composante_type_depense", "composante_type_depense.type_depense_id", "type_depense.id")
            ->where("composante_id", Auth::user()->composante_id)
            ->get();
        $plans = DB::table("plan_comptable")->get();
        return view("enregistrement-depense", compact("cheques", "depenses", "plans"));
    }

    public function add_enregistrement_depense(Request $request)
    {
        $request->validate([
            "beneficiaire" => "required",
            "numero_cheque" => "required",
            "numero_plan" => "required",
            "description" => "required",
            "montant" => "required",
            "type_depense_id" => "required",
            "facture" => "required|image|mimes:jpeg,png,jpg|max:1048",
        ]);

        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();

        $facture = $request->description . '.' . $request->facture->extension();

        $request->facture->move(public_path('assets/facture_depense'), $facture);

        $compte = DB::table("comptes")

            ->where("composante_id", Auth::user()->composante_id)
            ->first();

        $cheque = DB::table("cheques")
            ->where("composante_id", Auth::user()->composante_id)
            ->where("id", $request->numero_cheque)
            ->first();

        $somme_depense = DB::table("depenses")
            ->where("composante_id", Auth::user()->composante_id)
            ->where("numero_cheque", $request->numero_cheque)
            ->sum("montant");
        $dep = DB::table("depenses")
            ->where("composante_id", Auth::user()->composante_id)
            ->where("numero_cheque", $request->numero_cheque)
            ->get();
        if ($dep->count() == 0) {
            $somme_depense = 0;
        }

        $somme_restant = $cheque->montant - $somme_depense;
        if ($request->montant <= $cheque->montant) {
            if ($cheque->montant >= $somme_depense) {
                if ($request->montant <= $somme_restant) {

                    $an = date('Y');
                    $annee = $an - 1;

                    $anne_civile = DB::table("annee_civil")
                        ->where("annee_civil", $annee)
                        ->first();

                    $montant_depense = DB::table("depenses")
                        ->where("composante_id", Auth::user()->composante_id)
                        ->where("plan_comptable_id", $request->numero_plan)
                        ->where("annee_civil_id", $anne_civil->id)
                        ->sum("montant");

                    $montant_prev = DB::table("budget_previsionnel")
                        ->where("composante_id", Auth::user()->composante_id)
                        ->where("plan_comptable_id", $request->numero_plan)
                        ->where("annee_civil_id", $anne_civile->id)
                        ->first();
                    $som = $montant_depense + $request->montant;
                    if (isset($montant_prev) && $montant_prev->montant_previsionnel >= $montant_depense && $montant_prev->montant_previsionnel >= $request->montant && $montant_prev->montant_previsionnel >= $som) {

                        DB::table("depenses")
                            ->insert([
                                "montant" => $request->montant,
                                "description" => $request->description,
                                "date" => now(),
                                "numero_cheque" => $request->numero_cheque,
                                "beneficiaire" => $request->beneficiaire,
                                "facture" => $facture,
                                "composante_id" => Auth::user()->composante_id,
                                "annee_civil_id" => $anne_civil->id,
                                "plan_comptable_id" => $request->numero_plan,
                                "type_depense_id" => $request->type_depense_id
                            ]);


                        $solde = $compte->montant - $request->montant;

                        DB::table("comptes")
                            ->where('composante_id', Auth::user()->composante_id)
                            ->update(['montant' => $solde]);

                        return redirect("gestionnaire/historique-depense");
                    } else {

                        return back()->with("messages", "Le solde de votre numero de ligne comptable n'est pas suffisant pour cettte opération");
                    }
                } else {
                    return back()->with("messages", "Le solde restant du chèque est insuffisant par rapport à votre dépense, il vous reste " . $somme_restant . " KMF");
                }
            } else {
                return back()->with("messages", "Vous avez déjà épuisé le montant de ce chèque");
            }
        } else {
            $messages = "Vous avez déjà épuisé le montant de ce chèque";

            return back()->with("messages", "Le montant est superieur à celui de votre chèque");
        }
    }

    public function historique_depense()
    {

        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas = DB::table("depenses")
            ->join("cheques", "depenses.numero_cheque", "cheques.id")
            ->where("cheques.composante_id", Auth::user()->composante_id)
            ->where("depenses.annee_civil_id", $anne_civil->id)
            ->select("cheques.numero_cheque as designation", "cheques.montant as montant_cheque", "cheques.id as cheque_id")
            ->distinct()
            ->get();
        return view("liste_depenses", compact("datas"));
    }

    public function detail_liste_depense($id)
    {

        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();

        $datas = DB::table("depenses")
            ->where("numero_cheque", $id)
            // ->where("composante_id", Auth::user()->composante_id)
            ->where("annee_civil_id", $anne_civil->id)
            ->get();

        return view("detail_liste_depense", compact("datas"));
    }
    public function liste_depense()
    {
        return view("liste_depenses");
    }

    public function consolidation_depense()
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas = DB::table("depenses")
            ->join("plan_comptable", "depenses.plan_comptable_id", "plan_comptable.id")
            ->where("composante_id", Auth::user()->composante_id)
            ->where("depenses.annee_civil_id", $anne_civil->id)
            ->select("numero_plan_comptable", "designation", "plan_comptable.id as plan_id", "composante_id")
            ->distinct()
            ->get();

        return view("petit_consolidation_depense", compact("datas"));
    }

    public function recette_espece()
    {
        return view('recette_gestionnaire');
    }

    public function compte()
    {
        $solde = DB::table("comptes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();

        return view("compte_gestionnaire", compact("solde"));
    }

    public function consolidation_recette_mensuel()
    {
        return view("historique_mensuel_recette");
    }

    public function liste_consolidation_recette_mensuel(Request $request)
    {
        // $date = Carbon::createFromFormat($request->date, $request->date)
        //     ->format('Y-m-d');
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        // $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');
        // $da = Carbon::parse($request->date)->translatedFormat('d-m-Y');
        $mois = Carbon::parse($request->mois)->translatedFormat('m');

        $recettes = DB::table("recettes")
            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
            ->where("recettes.composante_id", Auth::user()->composante_id)
            ->where("droit_inscription", 0)
            ->where("etat", 0)
            ->where("annee_civil_id", $anne_civil->id)
            ->whereMonth("date_enregistrement", $mois)
            ->get();
        //   $da=$request->date;
        if ($recettes->count() > 0) {

            $datas = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("droit_inscription", 0)
                ->where("etat", 0)
                ->where("annee_civil_id", $anne_civil->id)
                ->whereMonth("date_enregistrement", $mois)

                ->select("type_recettes.designation", "type_recettes.prix", "recettes.type_recette_id")
                ->distinct()
                ->get();

            $MontantTotal = DB::table("recettes")
                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                ->where("recettes.composante_id", Auth::user()->composante_id)
                ->where("droit_inscription", 0)
                ->where("etat", 0)
                ->where("annee_civil_id", $anne_civil->id)
                ->whereMonth("date_enregistrement", $mois)

                ->select("type_recettes.prix")

                ->sum("type_recettes.prix");


            return view("liste_consolidation_recette_mensuel", compact("recettes", "datas", "MontantTotal", "mois"));
        } else {


            $recettes = DB::table("type_recettes")
                ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
                ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
                ->select("type_recettes.*", "composantes_types_recettes.*")
                ->get();
            $messages = "Vous n'avez pas fait d'enregistrement sur ce type de recette ce jour là";

            return view("historique_mensuel_recette", compact("messages", 'recettes'));
        }

        // return view("liste_consolidation_recette_mensuel",compact("mois"));
    }
}
