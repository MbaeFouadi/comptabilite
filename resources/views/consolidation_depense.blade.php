<?php

use Illuminate\Support\Facades\Auth;
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

                            <h4 class="header-title text-center">Consolidation des dépenses</h4><br> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Composante</th>
                                        <th>Numero de plan comptable</th>
                                        <th>Montant realisé</th>
                                        <th>Montant prévisionnel</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                    $previousComposante = '';
                                    @endphp
                                    @foreach ($datas as $data)
                                    <?php

                                    $depenses = DB::table("depenses")
                                        ->join("plan_comptable", "depenses.plan_comptable_id", "plan_comptable.id")
                                        ->where("depenses.composante_id", $data->id_composante)
                                        ->select("plan_comptable.numero_plan_comptable", "plan_comptable.designation", "plan_comptable.id as id_plan")
                                        ->distinct()
                                        ->get();



                                    $nbre = count($depenses)

                                    ?>


                                    <td rowspan="{{$nbre}}">{{$data->code_composante}}</td>
                                    @foreach ($depenses as $key => $depense)
                                    <?php

                                    $sum = DB::table("depenses")
                                        ->join("plan_comptable", "depenses.plan_comptable_id", "plan_comptable.id")
                                        ->where("depenses.composante_id", $data->id_composante)
                                        ->where("plan_comptable_id", $depense->id_plan)
                                        ->sum("montant");

                                    $date = date("Y");
                                    $dates = $date - 1;
                                    $annee = DB::table("annee_civil")
                                        ->where("annee_civil", $dates)
                                        ->first();

                                    $budjet = DB::table("budget_previsionnel")
                                        ->where("plan_comptable_id", $depense->id_plan)
                                        ->where("composante_id", $data->id_composante)
                                        ->where("annee_civil_id",$annee->id)
                                        ->first();
                                    ?>

                                    @if ($key > 0)
                                    <tr>
                                        @endif

                                        <td>{{$depense->numero_plan_comptable}} : {{$depense->designation}}</td>
                                        <td>{{$sum}} KMF</td>
                                      

                                        @if (isset($budjet))
                                        <td>{{$budjet->montant_previsionnel}} KMF</td>
                                            
                                        @else
                                        <td>Pas encore établi</td>
                                            
                                        @endif
                                      

                                    </tr>

                                    @endforeach


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