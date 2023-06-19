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

                            <h4 class="header-title text-center">Consolidation</h4><br> <br>

                            <!-- 
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Type de recette</th>
                                            <th>Montant</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Certification de diplômes</td>
                                            <td>25000 KMF</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Photocopies</td>
                                            <td>15000 KMF</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Total</td>
                                            <td>50000 KMF</td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div> -->

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Numero de plan comptable</th>
                                        <th>Montant realisé</th>
                                        <th>Montant prévu</th>
                                        <th>Montant Restant</th>


                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $data)
                                    <?php

                                    $montant_realise = DB::table("depenses")
                                        ->where("plan_comptable_id", $data->plan_id)
                                        ->where("composante_id", $data->composante_id)
                                        ->sum("depenses.montant");

                                    $date = date("Y");
                                    $dates = $date - 1;
                                    $annee = DB::table("annee_civil")
                                        ->where("annee_civil", $dates)
                                        ->first();

                                    $budjet = DB::table("budget_previsionnel")
                                        ->where("plan_comptable_id", $data->plan_id)
                                        ->where("composante_id", $data->composante_id)
                                        ->where("annee_civil_id", $annee->id)
                                        ->first();

                                    ?>
                                    <tr>
                                        <td>{{$data->numero_plan_comptable}} ({{$data->designation}})</td>
                                        <td>{{$montant_realise}} KMF</td>
                                        @if (isset($budjet))
                                        
                                        <td>{{$budjet->montant_previsionnel}} KMF</td>
                                        <td>{{$budjet->montant_previsionnel-$montant_realise}} KMF</td>


                                        @else
                                        <td>Pas encore établi</td>
                                        <td>NULL</td>

                                        @endif

                                    </tr>
                                    @endforeach




                                </tbody>
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