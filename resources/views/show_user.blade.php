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

                            <h4 class="header-title text-center">Liste des utilisateurs</h4><br> <br>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Adresse</th>
                                        <th>Téléphone</th>
                                        <th>Catégorie</th>
                                        <th>Composante</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($users as $user )
                                    <tr>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->adresse}}</td>
                                        <td>{{$user->telephone}}</td>
                                        <td>{{$user->display_name}}</td>
                                        <td>{{$user->code_composante}}</td>
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