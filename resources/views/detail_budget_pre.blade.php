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

                            <h4 class="header-title text-center">Budget</h4><br> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Composante</th>
                                        <th>Numero de plan comptable</th>
                                        <th>Montant realisé</th>
                                        <th>Montant prévu</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                    $previousComposante = '';
                                    @endphp
                                    @foreach ($datas as $data)
                                    <?php

                                    $plans = DB::table("plan_comptable")
                                        ->join("budget_previsionnel", "budget_previsionnel.plan_comptable_id", "plan_comptable.id")
                                        ->where("composante_id",$data->id)
                                        ->where("annee_civil_id",$annee_civil)
                                        ->select("plan_comptable.numero_plan_comptable", "plan_comptable.designation", "plan_comptable.id as id_plan","budget_previsionnel.*")
                                        ->distinct()
                                        ->get();



                                    $nbre = count($plans)

                                    ?>


                                    <td rowspan="{{$nbre}}">{{$data->code_composante}}</td>
                                    @foreach ($plans as $key =>$plan)
                                    <?php

                                    // $sum = DB::table("depenses")
                                    //     ->join("plan_comptable", "depenses.plan_comptable_id", "plan_comptable.id")
                                    //     ->where("depenses.composante_id", $data->id_composante)
                                    //     ->where("plan_comptable_id", $depense->id_plan)
                                    //     ->sum("montant");

                                    ?>

                                    @if ($key > 0)
                                    <tr>
                                        @endif

                                        <td>{{$plan->numero_plan_comptable}} : {{$plan->designation}}</td>
                                        <td>{{$plan->montant_realise}}</td>
                                        <td>{{$plan->montant_previsionnel}}</td>


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