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

                            <h4 class="header-title text-center">Affectation hologramme</h4><br> <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Composantes</th> -->
                                    <th>Nombres affectés</th>
                                    <th>Nombres restants</th>
                                  
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($hologrammesAffectes as $hologrammesAffecte)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{ $hologrammesAffecte->nombre }}</td>
                                        <td>{{ $hologrammesAffecte->holo_restant }}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
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