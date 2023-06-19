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

                            <h3 class="header-title text-center">Liste d'affectation des types de dépense pour {{$composantes->designation_composante}}</h3> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Type de dépense</th>
                                        <th>Composantes</th>
                                        <!-- <th>Désignation</th> -->
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $data )
                                    <tr>
                                        <td>{{$data->design_depense}}</td>
                                        <td>{{$data->designation_composante}}</td>
                                        <!-- <td>{{$data->type_depense_id}}</td> -->
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