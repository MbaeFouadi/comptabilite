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

                            <h3 class="header-title text-center">Soldes des recettes par composantes</h3> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Composantes</th>
                                        <th>Soldes</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($soldes_recettes_par_composantes as $soldes_recettes_par_composante)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$soldes_recettes_par_composante->designation_composante}}</td>
                                        <td>{{$soldes_recettes_par_composante->montant}} KMF</td>
                                    </tr>
                                    <?php $i++ ?>
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