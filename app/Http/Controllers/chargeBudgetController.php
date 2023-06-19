<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class chargeBudgetController extends Controller
{
    //

    public function evolution_depense_journaliere()
    {
        $composantes = DB::table("composantes")
            ->get();
        return view('evolution_depense', compact("composantes"));
    }

    public function liste_evolution_depense_journaliere(Request $request)
    {
        
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $date = Carbon::parse($request->date)->translatedFormat('Y-m-d');

        $datas=DB::table("depenses")
        ->join("cheques","depenses.numero_cheque","cheques.id")
        ->where("depenses.annee_civil_id",$anne_civil->id)
        ->where("cheques.composante_id",$request->composante_id)
        ->where("date",$date)
        ->distinct()
        ->select("cheques.numero_cheque as designation","cheques.montant as montant_cheque","cheques.id as cheque_id")
        ->get();

        if(count($datas) > 0)
        {
            return view("liste_evolution_depense_mensuel",compact("datas"));

        }

        else
        {
            return back()->with("error","Il n'y a pas eu dépense ce jour là dans cette composante");
        }
    }

    public function evolution_depense_mensuel()
    {
        $composantes = DB::table("composantes")
            ->get();
        return view("evolution_depense_mensuelle", compact("composantes"));
    }

    public function liste_evolution_depense_mensuel(Request $request)
    {

        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $mois = Carbon::parse($request->mois)->translatedFormat('m');

        $datas=DB::table("depenses")
        ->join("cheques","depenses.numero_cheque","cheques.id")
        ->where("depenses.annee_civil_id",$anne_civil->id)
        ->where("cheques.composante_id",$request->composante_id)
        ->whereMonth("date",$mois)
        ->distinct()
        ->select("cheques.numero_cheque as designation","cheques.montant as montant_cheque","cheques.id as cheque_id")
        ->get();

        if(count($datas) > 0)
        {
            return view("liste_evolution_depense_mensuel",compact("datas"));

        }

        else
        {
            return back()->with("error","Il n'y a pas eu dépense ce jour là dans cette composante");
        }

    }
    public function evolution_depense_annuel()
    {
        $composantes = DB::table("composantes")
            ->get();
        return view("evolution_depense_annuel", compact("composantes"));
    }
    public function liste_evolution_depense_annuel(Request $request)
    {

        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $mois = Carbon::parse($request->mois)->translatedFormat('m');

        $datas=DB::table("depenses")
        ->join("cheques","depenses.numero_cheque","cheques.id")
        ->where("depenses.annee_civil_id",$anne_civil->id)
        ->where("cheques.composante_id",$request->composante_id)
  
        ->distinct()
        ->select("cheques.numero_cheque as designation","cheques.montant as montant_cheque","cheques.id as cheque_id")
        ->get();

        if(count($datas) > 0)
        {
            return view("liste_evolution_depense_mensuel",compact("datas"));

        }

        else
        {
            return back()->with("error","Il n'y a pas eu dépense ce jour là dans cette composante");
        }

    }
    public function consolidation_depense()
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();

        $datas=DB::table("composantes")
        ->join("depenses","composantes.id","depenses.composante_id")
        ->where("annee_civil_id",$anne_civil->id)
        ->select("composantes.designation_composante","composantes.id as id_composante","code_composante")
        ->distinct()
        ->get();

        return view('consolidation_depense',compact("datas"));
    }

    public function liste_depense()
    {
        return view("liste_depense_chargée_budjget");
    }

    public function budget_realise()
    {
        $composantes=DB::table("composantes")
        ->get();
        return view("budget_realise",compact("composantes"));
    }

    public function detail_budget_realise(Request $request)
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas=DB::table("depenses")
        ->join("plan_comptable","depenses.plan_comptable_id","plan_comptable.id")
        ->where("composante_id", $request->composante_id)
        ->where("depenses.annee_civil_id", $anne_civil->id)
        ->select("numero_plan_comptable","designation","plan_comptable.id as plan_id","composante_id")
        ->distinct()
        ->get();

        if(count($datas)>0)
        {
            return view("petit_consolidation_depense",compact("datas"));
        }
        else
        {
            return back()->with("error","Il n'y a pas eu de dépenses dans ce mois");
        }

        
        // return view("detail_budjet_realise");
    }

    public function budget_previsionnel()
    {
        $composantes=DB::table("composantes")
        ->get();
        return view('budget_previsionel',compact("composantes"));
    }

    public function detail_budget_previsionnel(Request $request)
    {
        

        $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas=DB::table("depenses")
        ->join("plan_comptable","depenses.plan_comptable_id","plan_comptable.id")
        ->where("composante_id", $request->composante_id)
        ->where("depenses.annee_civil_id", $annee_civil->id)
        ->select("numero_plan_comptable","designation","plan_comptable.id as plan_id")
        ->distinct()
        ->get();

        if(count($datas)>0)
        {
            $composante_id=$request->composante_id;
            $composante=DB::table("composantes")
            ->where("id",Auth::user()->composante_id)
            ->first();

            return view("detail_budget_previsionnel",compact("datas","composante_id","annee_civil","composante"));
        }
        else
        {
            return back()->with("error","Il n'y a pas eu de dépenses dans ce mois");
        }
    }

    public function detail_budget_previsionnel_composante()
    {
        

        $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();
        $datas=DB::table("depenses")
        ->join("plan_comptable","depenses.plan_comptable_id","plan_comptable.id")
        ->where("composante_id", Auth::user()->composante_id)
        ->where("depenses.annee_civil_id", $annee_civil->id)
        ->select("numero_plan_comptable","designation","plan_comptable.id as plan_id")
        ->distinct()
        ->get();

        if(count($datas)>0)
        {
            $composante_id=Auth::user()->composante_id;

            $composante=DB::table("composantes")
            ->where("id",Auth::user()->composante_id)
            ->first();

            return view("detail_budget_previsionnel",compact("datas","composante_id","annee_civil","composante"));
        }
        else
        {
            return back()->with("error","Il n'y a pas eu de dépenses dans ce mois");
        }
    }

    public function add_detail_budget_previsionnel(Request $request)
    {
        $request->validate([
            "montant_prevu"=>"required",
        ]);

        $annee_civil = DB::table("annee_civil")->orderByDesc("id")->first();

        $budget = DB::table("budget_previsionnel")
        ->where("plan_comptable_id", $request->plan_comptable_id)
        ->where("composante_id", $request->composante_id)
        ->where("annee_civil_id", $annee_civil->id)
        ->first();

        if(!isset($budget))
        {
            DB::table("budget_previsionnel")->insert([

                "montant_previsionnel"=>$request->montant_prevu,
                "montant_realise"=>$request->montant_realise,
                "plan_comptable_id"=>$request->plan_comptable_id,
                "composante_id"=>$request->composante_id,
                "annee_civil_id"=>$annee_civil->id
            ]);

        return response()->json(['message'=>'données enregistre']);

        }
        
       

    
    }

    public function budget_global()
    {
        $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first(); 

        $datas=DB::table("depenses")
        ->join("plan_comptable","depenses.plan_comptable_id","plan_comptable.id")
        ->where("annee_civil_id",$anne_civil->id)
        ->select("plan_comptable.id as plan_id","plan_comptable.numero_plan_comptable","plan_comptable.designation")
        ->distinct()
        ->get();
        return view("budget_global",compact("datas"));
    }

    public function update_budget(Request $request)
    {
       


            DB::table("budget_previsionnel")
            ->where('id', $request->id)
            ->update(['montant_previsionnel' => $request->montant_prevu]);

            return response()->json(['message'=>'données enregistre']);


       
    }
}
