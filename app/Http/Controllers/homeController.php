<?php

namespace App\Http\Controllers;

use App\Http\Requests\affecteTypeDepenseRequest;
use App\Http\Requests\typeDepenseRequest;
use App\Http\Requests\validateFormAnneeRequest;
use App\Http\Requests\validateFormCategorytRequest;
use App\Http\Requests\validateFormPlanComptableRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    //

    public function index()
    {
        return view("index");
    }


    public function category()
    {
        return view("add_category");
    }

    public function add_category(Role $role, validateFormCategorytRequest $validateFormCategorytRequest)
    {
        $verify = $validateFormCategorytRequest;

        if ($verify) {

            Role::create([
                'name' => $validateFormCategorytRequest->design,
                'display_name' => $validateFormCategorytRequest->design,
                'description' => $validateFormCategorytRequest->design,
            ]);

            return redirect()->back()->with('success', 'Une nouvelle catégorie viens d\'être en registrer');
        } else {
            "Mauvaise manipulation";
        }
    }


    public function add_user()
    {
        $roles = DB::table("roles")->get();
        $composantes = DB::table("composantes")->get();
        return view("add_user", compact('roles', 'composantes'));
    }
    public function show_user()
    {

        $users = DB::table("users")
            ->join("role_user", "users.id", "role_user.user_id")
            ->join("roles", "roles.id", "role_user.role_id")
            ->leftJoin("composantes", "users.composante_id", "composantes.id")
            ->select("users.*", "role_user.*", "roles.*", "composantes.*")
            ->get();
        return view("show_user", compact("users"));
    }

    public function plan_comptable()
    {
        $plan_comptables = DB::table('plan_comptable')->get();
        return view("plan_comptable", compact('plan_comptables'));
    }

    public function add_plan_comptable(validateFormPlanComptableRequest $validateFormPlanComptableRequest)
    {

        DB::table('plan_comptable')->insert([
            'numero_plan_comptable' => $validateFormPlanComptableRequest->numero,
            'designation' => $validateFormPlanComptableRequest->designation,
        ]);

        return redirect()->back()->with('success', "Vous venez d'ajouter une chapitre plus son numéro de comptable");
    }

    public function annee()
    {
        return view("annee");
    }

    public function type_recette()
    {

        $composantes = DB::table("composantes")->get();
        return view("type_recette_composante", compact("composantes"));
    }

    public function add_employe()
    {

        $recettes = DB::table("type_recettes")
            ->join("composantes_types_recettes", 'type_recettes.id', 'composantes_types_recettes.type_recette_id')
            ->where("composantes_types_recettes.composante_id", Auth::user()->composante_id)
            ->where("employe", "=", 1)

            ->select("type_recettes.*", "composantes_types_recettes.*")
            ->get();
        return view("add_employe", compact("recettes"));
    }

    public function add_annee(validateFormAnneeRequest $validateFormAnneeRequest)
    {
        $verify = $validateFormAnneeRequest;

        if ($verify) {

            DB::table("annee")->insert([
                "designation_annee" => $validateFormAnneeRequest->annee,
            ]);

            return redirect()->back()->with('success', 'Une nouvelle année viens d\'être ajouter');
        } else {
            "Mauvaise manipulation";
        }
    }

    // public function add_type_depense()
    // {
    //     $depenses=DB::table("type_depense")
    //     ->join("composante_type_depense","composante_type_depense.type_depense_id","type_depense.id")
    //     ->join("composantes","composante_type_depense.composante_id","composantes.id")
    //     ->select("composantes.*","type_depense.id as depense_id","type_depense.*","composante_type_depense.*")
    //     ->get();
    //     $composantes=DB::table("composantes")->get();
    //     return view("add_type_depense",compact("composantes","depenses"));
    // }
    
    public function add_type_depense()
    {
        $depenses=DB::table("type_depense")
        ->join("composante_type_depense","composante_type_depense.type_depense_id","type_depense.id")
        ->join("composantes","composante_type_depense.composante_id","composantes.id")
        ->select("composantes.*","type_depense.id as depense_id","type_depense.*","composante_type_depense.*")
        ->get();
        $composantes=DB::table("composantes")->get();
        $type_depenses=DB::table("type_depense")->get();
        return view("add_type_depense",compact("composantes","depenses","type_depenses"));
    }


    public function type_depense()
    {
        $composantes = DB::table("composantes")->get();

        return view("type_depense_composante",compact("composantes"));
    }

    public function add_type_depenses(typeDepenseRequest $typeDepenseRequest)
    {
        $verify = $typeDepenseRequest;

        if ($verify) {

            DB::table("type_depense")->insert([
                "design_depense" => $typeDepenseRequest->designation,
            ]);

            return redirect()->back()->with('success', 'L\'enregistrement est bien effectuée');
        }
    }

    public function add_affecte_type_depenses (affecteTypeDepenseRequest $affecteTypeDepenseRequest)
    {
        $verify = $affecteTypeDepenseRequest;

        if ($verify) {

            DB::table("composante_type_depense")->insert([
                "composante_id" => $affecteTypeDepenseRequest->composante_id,
                "type_depense_id" => $affecteTypeDepenseRequest->type_depense_id,
            ]);

            return redirect()->back()->with('success', 'L\'affectation est bien effectuée');
        }
    }

}
