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

                                        <th>Bénéficiaire</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Facture</th>
                                        
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach($datas as $data)
                                  
                                    <tr>
                                        <td>{{$data->beneficiaire}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>{{$data->montant}}</td>
                                        <td>{{$data->date}}</td>
                                        <td> <a href="{{asset('assets/facture_depense/'.$data->facture)}}" target="_blank">{{$data->facture}}</a></td>


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