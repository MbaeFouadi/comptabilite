<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //

        $request->validate([
            "nom" => 'required',
            "prenom" => 'required',
            "fonction" => 'required',
            "telephone" => 'required',
            "type_recette_id" => 'required',
        ]);
        DB::table("employees")->insert([
            "nom" => $request->nom,
            "prenom" => $request->prenom,
            "fonction" => $request->fonction,
            "telephone" => $request->telephone,
            
        ]);

        $annee = DB::table("annee_civil")->orderByDesc("id")->first();
        $employee = DB::table("employees")->orderByDesc("id")->first();
        DB::table("recettes")->insert([
            "date_enregistrement" => now(),
            "type_recette_id" => $request->type_recette_id,
            "composante_id" => Auth::user()->composante_id,
            "employee_id" => $employee->id,
            "annee_civil_id" => $annee->id
        ]);

        $data = DB::table("employees")
            ->join("recettes", "employees.id", "recettes.employee_id")
            ->join("type_recettes", "type_recettes.id", "recettes.type_recette_id")
            ->where("recettes.employee_id",$employee->id)
            ->orderByDesc("employees.id")->first();

        $caisse = DB::table("caisse")->where("composante_id", Auth::user()->composante_id)
            ->first();
        if (isset($caisse)) {
            $somme = $caisse->montant + $data->prix;

            DB::table("caisse")
                ->where('composante_id', Auth::user()->composante_id)
                ->update(['montant' => $somme]);
        } else {
            $somme = $data->prix;

            DB::table("caisse")
                ->insert([
                    "montant" => $somme,
                    "composante_id" => Auth::user()->composante_id,
                ]);
        }


        $recette=DB::table("recettes")
        ->join("type_recettes","type_recettes.id","recettes.type_recette_id")
        ->where("type_recette_id",$request->type_recette_id)
        ->select("recettes.id as recette_id","type_recettes.*")
        ->orderByDesc("recettes.id")
        ->first();

        return view("recu_employe", compact("data","recette"));
    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        //
    }
}
