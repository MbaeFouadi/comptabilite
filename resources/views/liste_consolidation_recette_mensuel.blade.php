<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

?>
@ext
@extends('layout.app')
@section('content')
<div class="page-content">

    <!-- Page-Title -->
    <div class="page-title-box">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">

                </div>

            </div>

        </div>
    </div>
    <!-- end page title end breadcrumb -->

    <div class="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="header-title text-center">Etat des recettes </h3> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Type de recette</th>
                                        <th>Nombre</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant Total</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $data)
                                    <?php
                                    $anne_civil = DB::table("annee_civil")->orderByDesc("id")->first();

                                    $nbre_recette = DB::table("recettes")
                                        ->where("type_recette_id", $data->type_recette_id)
                                        ->where("composante_id", Auth::user()->composante_id)
                                        ->whereMonth("recettes.date_enregistrement", $mois)

                                        ->count();
                                    $prix = $data->prix;
                                    $loca = DB::table("recettes")
                                        ->join("recette_locations", "recettes.recette_location_id", "recette_locations.id")
                                        ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")

                                        ->where("composante_id", Auth::user()->composante_id)
                                        ->where("recettes.type_recette_id", $data->type_recette_id)
                                        ->whereMonth("recettes.date_enregistrement", $mois)

                                        ->select("recettes.*", "type_recettes.*", "recette_locations.*")
                                        ->first();

                                    $sum = DB::table("recettes")
                                        ->join("recette_locations", "recettes.recette_location_id", "recette_locations.id")
                                        ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")

                                        ->where("composante_id", Auth::user()->composante_id)
                                        ->where("recettes.type_recette_id", $data->type_recette_id)
                                        ->whereMonth("recettes.date_enregistrement", $mois)
                                        ->select("recettes.*", "type_recettes.*", "recette_locations.*")
                                        ->sum("nbre_jour");

                                    $MontantTotal = DB::table("recettes")
                                        ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                        ->where("recettes.composante_id", Auth::user()->composante_id)
                                        ->where("annee_civil_id", $anne_civil->id)
                                        ->whereMonth("recettes.date_enregistrement", $mois)
                                        ->where("location", 0)
                                        ->select("type_recettes.prix")
                                        ->sum("type_recettes.prix");

                                    $total = $nbre_recette * $prix;
                                    if (isset($loca->location) && $loca->location == 1) {



                                        $MontantLoca = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("recettes.composante_id", Auth::user()->composante_id)
                                            ->where("annee_civil_id", $anne_civil->id)
                                            ->where("location", 1)
                                            ->whereMonth("recettes.date_enregistrement", $mois)

                                            ->select("type_recettes.prix")
                                            ->first();

                                        $MontantTotal = $MontantTotal + $MontantLoca->prix * $sum;

                                        // $sum_nbre=DB::table("recettes")
                                        // ->join("recette_locations", "recettes.recette_location_id", "recette_locations.id")
                                        // ->where("date_enregistrement", $data->date_enregistrement)
                                        // ->where("composante_id", Auth::user()->composante_id)
                                        // ->where("recettes.type_recette_id", $data->type_recette_id)
                                        // ->select("recettes.*", "type_recettes.*", "recette_locations.*")
                                        // ->sum("nbre_jour");

                                        $nbre_recette = $sum;
                                        $total = $prix * $sum;
                                    }
                                    //    if($data->location==1){

                                    //    } 
                                    ?>
                                    <tr>
                                        <td>{{$data->designation}}</td>
                                        <td>{{$nbre_recette}}</td>
                                        <td>{{$prix}} KMF</td>
                                        <td>{{$total}} KMF</td>
                                    </tr>
                                    @endforeach


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Montant global</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$MontantTotal}} KMF</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- <div class="col-md-2"> -->
        </div>

    </div>

</div>

<!-- end row -->


<!-- end row -->

<!-- end row -->
</div>
<!-- end container-fluid -->
</div>
<!-- end page-content-wrapper -->
</div>

@endsection