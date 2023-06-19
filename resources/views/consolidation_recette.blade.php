<?php

use Illuminate\Support\Facades\DB;

?>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Consolidation realisation des recetes</h4><br> <br>



                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>

                                        <th>Composante</th>
                                        <th>Type de recette</th>
                                        <th>Nombres</th>
                                        <th>Prix unitaire</th>
                                        <th>Montant</th>


                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                    $previousComposante = '';
                                    @endphp
                                    @foreach ($datas as $data)
                                    <?php
                                    $recettes = DB::table("recettes")
                                        ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                        ->where("recettes.composante_id", $data->id_composante)
                                        ->select("type_recettes.designation", "recettes.type_recette_id", "type_recettes.prix", "recettes.composante_id")
                                        ->distinct()
                                        ->get();

                                    $rec = DB::table("recettes")
                                        ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id",)
                                        ->where("recettes.composante_id", $data->id_composante)
                                        ->select("type_recettes.designation", "recettes.type_recette_id", "type_recettes.prix", "recettes.composante_id")
                                        ->distinct()
                                        ->get();



                                    $nbre = count($recettes);
                                    ?>
                                    <tr>
                                        <td rowspan="{{ $nbre }}">
                                            @if ($previousComposante != $data->designation_composante)
                                            {{ $data->designation_composante }}
                                            @php
                                            $previousComposante = $data->designation_composante;
                                            @endphp
                                            @endif
                                        </td>

                                        @foreach ($recettes as $key => $recette)
                                        <?php
                                        $somme_montant = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("recettes.composante_id", $recette->composante_id)
                                            ->where("recettes.type_recette_id", $recette->type_recette_id)
                                            ->select("prix")
                                            ->sum("prix");

                                        $loca = DB::table("recettes")
                                            ->join("recette_locations", "recettes.recette_location_id", "recette_locations.id")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("composante_id", $recette->composante_id)
                                            ->where("recettes.type_recette_id", $recette->type_recette_id)
                                            ->select("recettes.*", "type_recettes.*", "recette_locations.*")
                                            ->first();

                                        $somme_nombres = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("recettes.composante_id", $recette->composante_id)
                                            ->where("recettes.type_recette_id", $recette->type_recette_id)
                                            ->select("recettes.type_recette_id")
                                            ->get();

                                        $MontantTotal = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("composante_id", $recette->composante_id)
                                            ->where("location", 0)
                                            ->select("type_recettes.prix")
                                            ->sum("type_recettes.prix");



                                        $sum = DB::table("recettes")
                                            ->join("recette_locations", "recettes.recette_location_id", "recette_locations.id")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("composante_id", $recette->composante_id)
                                            ->where("recettes.type_recette_id", $recette->type_recette_id)
                                            ->select("recettes.*", "type_recettes.*", "recette_locations.*")
                                            ->sum("nbre_jour");

                                        $somme_nombre = count($somme_nombres);
                                        $prix = $recette->prix;

                                        $MontantGlobal = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")

                                            ->select("type_recettes.prix")
                                            ->sum("type_recettes.prix");

                                        $MontantLocas = DB::table("recettes")
                                            ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                            ->where("location", 1)
                                            ->select("type_recettes.prix")
                                            ->first();

                                        $MontantGlobal = $MontantGlobal + $MontantLocas->prix * $sum;

                                        if (isset($loca->location) && $loca->location == 1) {

                                            $MontantLoca = DB::table("recettes")
                                                ->join("type_recettes", "recettes.type_recette_id", "type_recettes.id")
                                                ->where("recettes.composante_id", $recette->composante_id)
                                                ->where("location", 1)
                                                ->select("type_recettes.prix")
                                                ->first();

                                            $MontantTotal = $MontantTotal + $MontantLoca->prix * $sum;



                                            $somme_nombre = $sum;
                                            $somme_montant = $somme_nombre *  $MontantLoca->prix;
                                        }


                                        ?>
                                        @if ($key > 0)
                                    <tr>
                                        @endif
                                        <td>
                                            {{ $recette->designation }}
                                        </td>

                                        <td>{{$somme_nombre}}</td>
                                        <td>{{$recette->prix}}</td>
                                        <td>{{$somme_montant}} KMF</td>
                                    </tr>
                                    @endforeach
                                    <tr style="background-color:yellow;">
                                        <td colspan="0">Total :</td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td> <strong>{{$MontantTotal}} KMF</strong></td>

                                    </tr>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <td>Montant Global</td>
                                        <td> </td>
                                        <td> </td>
                                        <td> </td>
                                        <td>{{$MontantGlobal}} KMF</td>

                                    </tr>

                                </tfoot> -->
                            </table>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">

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