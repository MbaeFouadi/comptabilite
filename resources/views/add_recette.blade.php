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
                            <h3 class="header-title text-center">Enregistrement d'un reçu </h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form method="POST" action="{{route('show_info')}}" class="needs-validation">
                                @csrf
                                @if (isset($messages))
                                    <div class="alert alert-warning" role="alert">{{$messages}}</div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Matricule</label>
                                        <input type="text" name="mat_etud" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Type des recettes</label>
                                        <select class="custom-select" required name="type_recette_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($recettes as $recette )
                                            <option value="{{$recette->id_type_recette}}">{{$recette->designation}}</option>

                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label>Année</label>
                                        <select class="custom-select" name="annee" required>
                                            <option value="">Sélectionner l'année</option>
                                            @foreach ($annees as $annee )
                                            <option value="{{$annee->designation_annee}}">{{$annee->designation_annee}}</option>
                                                
                                            @endforeach
                                        
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
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