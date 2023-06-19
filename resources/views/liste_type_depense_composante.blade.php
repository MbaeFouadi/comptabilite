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

                            <h3 class="header-title text-center">Liste d'affectation des types de recette pour {{$composante->designation_composante}}</h3> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Désignation</th>
                                        <th>Prix</th>
                                        <th>Année</th>
                                        <th>Hologramme</th>

                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $data )
                                    <tr>
                                        <td>{{$data->designation}}</td>
                                        <td>{{$data->prix}} KMF</td>
                                        <td>{{$data->designation_annee}}</td>
                                       
                                            @if ($data->hologramme==1)
                                            <td> Oui</td>
                                            @else
                                            <td>Non </td>   
                                            @endif
                                         
                                        

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