<?php

namespace App\Http\Controllers;

use App\Models\type_recette;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TypeRecetteController extends Controller
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
       
        $composantes=DB::table("composantes")->get();
        $type_recettes=DB::table("type_recettes")->get();
        $annees=DB::table("annee")->orderBy("id","desc")->get();
        return view("add_type_recette",compact("annees","type_recettes","composantes"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            "designation"=>'required|unique:type_recettes',
            "annee_id"=>'required',
            "hologramme"=>'required',
            "employe"=>'required',

        ]);

        DB::table("type_recettes")->insert([
            "designation"=>$request->designation,
            "prix"=>$request->prix,
            "annee_id"=>$request->annee_id,
            "hologramme"=>$request->hologramme,
            "employe"=>$request->employe,
            "location"=>$request->location,
            "etat"=>$request->etat,
            "droit_inscription"=>$request->droit,
        ]);

        return redirect("type_recette/create");

    }

    /**
     * Display the specified resource.
     */
    public function show(type_recette $type_recette)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(type_recette $type_recette)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, type_recette $type_recette)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(type_recette $type_recette)
    {
        //
    }

    public function affectation_recette(Request $request)
    {
        $request->validate([
            'type_recette_id'=>'required',
            'composante_id'=>'required'
        ]);

       $compo= DB::table('composantes_types_recettes')
        ->where("type_recette_id",$request->type_recette_id)
        ->where("composante_id",$request->composante_id)
        ->get();
        
        if($compo->count()==0)
        {
            DB::table('composantes_types_recettes')->insert([
                'statut'=>'1',
                'type_recette_id'=>$request->type_recette_id,
                'composante_id'=>$request->composante_id,
            ]);
    
            $success="L'affectation a été effecutée avec succès";

            $composantes=DB::table("composantes")->get();
            $type_recettes=DB::table("type_recettes")->get();
            $annees=DB::table("annee")->orderBy("id","desc")->get();
            return view("add_type_recette",compact("annees","type_recettes","composantes","success"));
        }
        else
        {
            $messages="Vous avez déjà affecter ce type de recette à cette composante";

            $composantes=DB::table("composantes")->get();
            $type_recettes=DB::table("type_recettes")->get();
            $annees=DB::table("annee")->orderBy("id","desc")->get();
            return view("add_type_recette",compact("annees","type_recettes","composantes","messages"));


        }
       

    }

    public function liste_affectation_recette(Request $request)
    {
       $datas= DB::table("type_recettes")
        ->join('composantes_types_recettes','type_recettes.id','composantes_types_recettes.type_recette_id')
        ->join("composantes","composantes_types_recettes.composante_id","composantes.id")
        ->join("annee","type_recettes.annee_id","annee.id")
        ->where("composantes_types_recettes.composante_id",$request->composante_id)
        ->select("type_recettes.*","composantes.*","composantes_types_recettes.*","annee.*")
        ->get();

        $composante= DB::table("type_recettes")
        ->join('composantes_types_recettes','type_recettes.id','composantes_types_recettes.type_recette_id')
        ->join("composantes","composantes_types_recettes.composante_id","composantes.id")
        ->join("annee","type_recettes.annee_id","annee.id")
        ->where("composantes_types_recettes.composante_id",$request->composante_id)
        ->select("type_recettes.*","composantes.*","composantes_types_recettes.*","annee.*")
        ->first();

        return view("liste_type_depense_composante",compact("datas","composante"));
    }

    public function liste_type_depense_par_composante(Request $request)
    {
        $datas= DB::table("composante_type_depense")
        ->join('type_depense','type_depense.id','composante_type_depense.type_depense_id')
        ->join("composantes","composante_type_depense.composante_id","composantes.id")
        ->where("composante_type_depense.composante_id",$request->composante_id)
        ->select("type_depense.*","composante_type_depense.*","composantes.*")
        ->get();

        $composantes= DB::table("composantes")
        ->where("composantes.id",$request->composante_id)
        ->first();
        // dd($composantes);

        return view('detail_type_recette_par_composante',compact("datas",'composantes'));
    }

}
