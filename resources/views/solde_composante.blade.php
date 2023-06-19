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

                            <h4 class="header-title text-center">Solde</h4><br> <br>

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
                                        <th>#</th>
                                        <th>Composante</th>
                                        <th>Montant</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach ($datas as $data )
                                    @if ($data->composante_id !=1)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{$data->code_composante}}</td>
                                        <td>{{$data->montant}}</td>

                                    </tr>
                                    @endif
                                   
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