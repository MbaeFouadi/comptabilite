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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h3 class="header-title text-center">Historique dépenses</h3> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Numero de chèque</th>
                                        <th>Montant prévu</th>
                                        <th>Montant réalisé</th>
                                        <th>Montant restant</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach($datas as $data)
                                    <?php

                                    $montat_realise = DB::table("depenses")
                                        ->where("numero_cheque", $data->cheque_id)
                                        ->sum("depenses.montant");
                                     $montant_restant=$data->montant_cheque-$montat_realise;  
                                    ?>
                                    <tr>
                                        <td>{{$data->designation}}</td>
                                        <td>{{$data->montant_cheque}} KMF</td>
                                        <td>{{$montat_realise}} KMF</td>
                                        <td>{{$montant_restant}} KMF</td>

                                        <td> <a href="{{route('detail_liste-depense',$data->cheque_id)}}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Voir plus">
                                                <i class="mdi mdi-eye"></i>
                                            </a></td>

                                    </tr>
                                    @endforeach


                                </tbody>
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