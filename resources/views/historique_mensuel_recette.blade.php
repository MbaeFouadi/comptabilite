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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center"> Consolidation mensuel </h3> <br>
                            <p class="card-title-desc">Veuillez choisir une date anterieur pour voir l'etat des recettes.</p>

                            <form class="needs-validation" method="POST" action="{{route('liste_consolidation_recette_mensuel')}}">
                                @csrf
                                @if (isset($messages))
                                <div class="alert alert-warning">
                                    {{$messages}}
                                </div>
                                @endif
                                <div class="row">
                                    <!-- <div class="col-md-4"></div> -->
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Date</label>
                                        <input type="month" name="mois" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>




                                </div>

                                <button class="btn btn-primary" type="submit">Valider</button>

                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">

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