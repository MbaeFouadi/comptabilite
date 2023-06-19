<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ControleurFinancierController extends Controller
{
    //

    public function evolution_depense()
    {
        return view('evolution_depense');
    }

    public function evolution_recette()
    {
        return view("evolution_recette");
    }

    public function consolidation_recette ()
    {
        $composantes=DB::table("composantes")
        ->join("recettes","composantes.id","recettes.composante_id")
        ->select("composantes.id as id_composante","composantes.code_composante")
        ->distinct()
        ->get();

        $headers=$composantes->pluck('code_composante')->toArray();
        return view("grande_consolidation_recette",compact("composantes","headers"));
    }

    public function consolidation_depense ()
    {
        return view("grande_consolidation_depense");
    }

    public function annulation_recu()
    {
        return view('annulation_recu');
    }

    public function suppression_recu(Request $request)
    {
        $request->validate([
            "recu"=>"required"
        ]);

        $recette=DB::table("recettes")
        ->join("type_recettes","recettes.type_recette_id","type_recettes.id")
        ->where("recettes.id",$request->recu)
        ->select("recettes.id as recette_id","recettes.*","type_recettes.*")
        ->first();
        if(isset($recette))
        {
            $client = new Client();


            $response = $client->post('http://127.0.0.1:801/api/info_etudiant', [
                'form_params' => [
                    'mat_etud' => $recette->matricule,
                ]
            ]);
    
    
            $data = json_decode($response->getBody(), true);
    
            return view('suppression_recu',compact("recette","data"));
        }
        else
        {
            return back()->with("error","Ce numéro de reçu n'existe pas");
        }

       
    }

    public function add_suppression_recu(Request $request)
    {
        $recette=DB::table("recettes")
        ->join("type_recettes","recettes.type_recette_id","type_recettes.id")
        ->where("recettes.id",$request->recu)
        ->select("recettes.*","type_recettes.*")
        ->first();

        $compte=DB::table("caisse")
        ->where("composante_id",$recette->composante_id)
        ->first();

        DB::table('caisse')
        ->where('composante_id',$recette->composante_id)
        ->update(['montant' => $compte->montant - $recette->prix]);

        DB::table('recettes')->where('id', '=',$request->recu)->delete();
     
        return redirect("/charge-recette/evolution-recettee");
    }

}
