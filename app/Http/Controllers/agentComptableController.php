<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateFormHologra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class agentComptableController extends Controller
{
    //

    public function depense()
    {
        return view('depense_cheque');
    }

    public function virement()
    {
        $depenses = DB::table("type_depense")
            ->join("composante_type_depense", "composante_type_depense.type_depense_id", "type_depense.id")
            ->join("composantes", "composante_type_depense.composante_id", "composantes.id")
            ->where("composante_id", Auth::user()->composante_id)
            ->select("composantes.*", "type_depense.id as depense_id", "type_depense.*", "composante_type_depense.*")
            ->get();
        $composantes = DB::table("composantes")->get();
        $plan_comptables = DB::table("plan_comptable")->get();
        return view('depense_virement', compact("composantes", "plan_comptables", "depenses"));
    }
    public function add_virement(Request $request)
    {
        // $request->validate([

        //     "composante_id" => "required",

        //     "montant" => "required",
        //     "description" => "required",

        // ]);



        $compte_udc = DB::table("comptes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();

        if (isset($compte_udc->montant) && $compte_udc->montant > $request->montant) {
            $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();
            $composante = DB::table("composantes")
                ->where("id", $request->composante_id)
                ->first();

            if (isset($request->plan_comptable_id)) {

                DB::table("depenses")->insert([
                    "montant" => $request->montant,
                    "description" => $request->description,
                    "date" => now(),
                    "beneficiaire" => $composante->code_composante,
                    "composante_id" => Auth::user()->composante_id,
                    "annee_civil_id" => $annee_civil->id,
                    "plan_comptable_id" => $request->plan_comptable_id,
                    "type_depense_id" => $request->type_depense_id,
                ]);
            }


            DB::table("virements")->insert([
                "montant" => $request->montant,
                "description" => $request->description,
                "date_enregistrement" => now(),
                "plan_comptable_id" => $request->plan_comptable_id,
                "type_depense_id" => $request->type_depense_id,
                "composante_id" => $request->composante_id,

            ]);

            $compte = DB::table("comptes")
                ->where("composante_id", $request->composante_id)
                ->first();
            if (isset($compte)) {
                DB::table("comptes")
                    ->where('composante_id', $request->composante_id)
                    ->update(['montant' => $compte->montant + $request->montant]);
            } else {
                DB::table("comptes")
                    ->insert([
                        'composante_id' => $request->composante_id,
                        'montant' => $request->montant
                    ]);
            }

            DB::table("comptes")
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['montant' => $compte_udc->montant - $request->montant]);

            return back()->with("success", "Virement effectué avec succès");
        } else {
            return back()->with("error", "Vous n'avez pas le solde suffisant pour effectuer ce virement");
        }
    }
    public function frais_des_comptes()
    {
        $plan_comptables = DB::table("plan_comptable")->get();
        $depenses = DB::table("type_depense")
            ->join("composante_type_depense", "composante_type_depense.type_depense_id", "type_depense.id")
            ->join("composantes", "composante_type_depense.composante_id", "composantes.id")
            ->where("composante_id", Auth::user()->composante_id)
            ->select("composantes.*", "type_depense.id as depense_id", "type_depense.*", "composante_type_depense.*")
            ->get();
        return view("depense_frais_compte", compact("plan_comptables", "depenses"));
    }

    public function add_frais_des_comptes(Request $request)
    {
        $request->validate([
            "description" => "required",
            "montant" => "required",
            "plan_comptable_id" => "required",
            "type_depense_id" => "required",
        ]);


        $compte_udc = DB::table("comptes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();

        if (isset($compte_udc->montant) && $compte_udc->montant > $request->montant) {
            $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();


            DB::table("depenses")->insert([
                "montant" => $request->montant,
                "description" => $request->description,
                "date" => now(),
                "beneficiaire" => $request->beneficiaire,
                "composante_id" => Auth::user()->composante_id,
                "annee_civil_id" => $annee_civil->id,
                "plan_comptable_id" => $request->plan_comptable_id,
                "type_depense_id" => $request->type_depense_id,
            ]);

            DB::table("comptes")
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['montant' => $compte_udc->montant - $request->montant]);

            return back()->with("success", "Opération effectuée avec succès");
        } else {
            return back()->with("error", "Vous n'avez pas le solde suffisant pour cette opération");
        }
    }

    public function depenses_salaires()
    {
        return view('depense_salaire');
    }

    public function hologramme()
    {
        $composantes = DB::table("composantes")->get();
        return view('add_hologramme', compact('composantes'));
    }

    public function add_hologramme(validateFormHologra $validateFormHologra)
    {
        $verify = $validateFormHologra;

        if ($verify) {

            $composent_id = $validateFormHologra->composent_id;

            $composantesExiste = DB::table("hologrammes")
                ->where('composante_id', '=', $composent_id)
                ->first();

            if (isset($composantesExiste)) {



                return redirect()->back()->with('danger', "Désole ce composante à déjà eu une affectation, allez fair une AJOUT!");
            } else {

                DB::table('hologrammes')->insert([
                    "nombre" => $validateFormHologra->nombre,
                    "composante_id" => $validateFormHologra->composent_id,
                    "holo_restant" => $validateFormHologra->nombre,
                ]);

                DB::table('entree_hologramme')->insert([
                    "nombre" => $validateFormHologra->nombre,
                    "composante_id" => $validateFormHologra->composent_id,
                ]);

                return redirect()->back()->with('success', "Une nouvelle affectation d'hologramme viens d'être enregistrer!");
            }
        } else {
            return redirect()->back()->with('success', "mauvaise manipulation !");
        }
    }

    public function entree_hologramme()
    {
        $composantes = DB::table("composantes")->get();
        return view('entree_hologramme', compact('composantes'));
    }

    public function add_entree_hologramme(validateFormHologra $validateFormHologra)
    {
        $id_composante = $validateFormHologra->composent_id;
        $nombre = $validateFormHologra->nombre;

        $composantesExisteHologramme = DB::table("hologrammes")
            ->where('composante_id', '=', $id_composante)
            ->first();

        $composantesExiste = DB::table("entree_hologramme")
            ->where('composante_id', '=', $id_composante)
            ->first();

        if (isset($composantesExisteHologramme)) {

            $somme_hologrammeRestant_hologrammeNouveau = $composantesExisteHologramme->holo_restant + $validateFormHologra->nombre;
            // echo 'Somme:'. $somme_hologrammeRestant_hologrammeNouveau;

            DB::table('hologrammes')
                ->where(
                    'composante_id',
                    $id_composante
                )
                ->update(
                    [
                        'nombre' => $somme_hologrammeRestant_hologrammeNouveau,
                        'holo_restant' => $somme_hologrammeRestant_hologrammeNouveau
                    ]
                );

            DB::table('entree_hologramme')->insert([
                "nombre" => $nombre,
                "composante_id" => $validateFormHologra->composent_id,
            ]);
            return redirect()->back()->with('success', 'Vous venez d\'ajouter un hologramme');
        } else {

            return redirect()->back()->with('danger', 'Vous devriez faire une affectation d\'abord');
        }
    }

    public function evolution_recette()
    {
        return view('evolution_recette');
    }

    public function evolution_depense()
    {
        return view('evolution_depense');
    }

    public function recette_preinscription()
    {
        return view('recette_préinscription');
    }

    public function recette_inscription()
    {
        return view('recette_inscription');
    }

    public function evolution_hologramme()
    {
        $hologrammes = DB::table('hologrammes')
            ->join('composantes', 'hologrammes.composante_id', '=', 'composantes.id')
            ->select('composantes.*', 'hologrammes.nombre', 'hologrammes.holo_restant')
            ->get();


        return view('evolution_hologramme', compact('hologrammes'));
    }

    public function solde_composante()
    {

        $datas = DB::table("composantes")
            ->join("comptes", "composantes.id", "comptes.composante_id")
            ->get();
        return view('solde_composante', compact("datas"));
    }

    public function solde_compte_principal()
    {
        $solde = DB::table("comptes")
            ->where("composante_id", Auth::user()->composante_id)
            ->first();
        return view('solde_compte_principal', compact("solde"));
    }

    public function add_budget()
    {
        $plans = DB::table("plan_comptable")->get();
        $composantes = DB::table("composantes")->get();
        return view("add_budget_global", compact('composantes', "plans"));
    }
    public function store_budget(Request $request)
    {
        $request->validate([
            "montant_realise" => "required",
            "montant_prevu" => "required",
            "plan_comptable_id" => "required",
            "composante_id" => "required"
        ]);

        $annee_civil = DB::table("annee_civil")->first();

        $budget = DB::table("budget_previsionnel")
            ->where("plan_comptable_id", $request->plan_comptable_id)
            ->where("composante_id", $request->composante_id)
            ->where("annee_civil_id", $annee_civil->id)
            ->first();

        if (isset($budget)) {
            return back()->with("error", "Vous avez déjà inséré ce numero comptable");
        } else {

            DB::table("budget_previsionnel")
                ->insert([
                    "montant_realise" => $request->montant_realise,
                    "montant_previsionnel" => $request->montant_prevu,
                    "plan_comptable_id" => $request->plan_comptable_id,
                    "composante_id" => $request->composante_id,
                    "annee_civil_id" => $annee_civil->id
                ]);

            return back()->with("success", "Enregistrement effectuer avec succès");
        }
    }

    public function detail_budget()
    {
        $annees = DB::table("annee_civil")->get();
        return view("detail_budget", compact("annees"));
    }

    public function liste_budget(Request $request)
    {
        $request->validate([
            "annee_civil_id" => "required",
        ]);

        $datas = DB::table("budget_previsionnel")
            // ->join("plan_comptable","budget_previsionnel.plan_comptable_id","plan_comptable.id")
            ->join("composantes", "composantes.id", "budget_previsionnel.composante_id")
            ->where("annee_civil_id", $request->annee_civil_id)
            ->select("composantes.*")
            ->distinct()
            ->get();

        $annee_civil = $request->annee_civil_id;

        if (count($datas) > 0) {
            return view("detail_budget_pre", compact("datas", "annee_civil"));
        } else {
            return back()->with("error", "il n'y a pas eu de budget cette année");
        }
    }

    public function hologramme_affecte()
    {
        $hologrammesAffectes = DB::table('hologrammes')
            ->where('composante_id', Auth::user()->composante_id)
            ->get();

        // dd($hologrammesAffectes);
        return view('hologrammme-affecte', compact('hologrammesAffectes'));
    }

    public function autre_recette()
    {
        $composantes = DB::table("composantes")

            ->get();

        $recettes = DB::table("type_recettes")
            ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
            ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
            ->where("etat", 1)
            ->select("type_recettes.*", "type_recettes.id as id_type_recette", "composantes_types_recettes.*")
            ->get();

        return view("autre_recette", compact("composantes", "recettes"));
    }

    public function store_autre_recette(Request $request)
    {
        $request->validate([
            "type_recette_id" => "required",
            "montant" => "required",
            "composante_id" => "required"
        ]);

        $civil = DB::table("annee_civil")->orderByDesc("id")->first();

        $data = DB::table("recettes")
            ->where("type_recette_id", $request->type_recette_id)
            ->where("composante_id", $request->composante_id)
            ->first();

        if (!isset($data)) {
            DB::table("recettes")->insert([
                "type_recette_id" => $request->type_recette_id,
                "montant" => $request->montant,
                "annee_civil_id" => $civil->id,
                "composante_id" => $request->composante_id,
                "date_enregistrement" => now(),
            ]);

            return back()->with("success", "Recette enregistré avec success");
        } else {
            return back()->with("error", "Vous avez déjà enregistrer ce type de recettte");
        }
    }
}
