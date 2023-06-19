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
                            <h3 class="header-title text-center"> Veuillez ajouter un employe pour le reçu</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form method="POST" action="{{route('employe.store')}}" class="needs-validation">
                                @csrf
                                <div class="row">
                                  
                                    <div class="col-md-6 mb-3">
                                          @error('nom')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                        <label for="validationCustom01">Nom</label>
                                        <input type="text" name="nom" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error('prenom')
                                    <div class="alert alert-warning">{{$message}}</div>

                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Prénom</label>
                                        <input type="text" name="prenom" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 mb-3">
                                        <label for="validationCustom01">Adresse email</label>
                                        <input type="email" name="email" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                @error('fonction')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Fonction</label>
                                        <input type="text" name="fonction" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error('telephone')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Téléphone</label>
                                        <input type="text" name="telephone" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                @error('type_recette_id')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label>Type des recettes</label>
                                        <select class="custom-select" required name="type_recette_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($recettes as $recette )
                                            <option value="{{$recette->id}}">{{$recette->designation}}</option>

                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                </div>
                                <input class="btn btn-primary" type="submit" value="Valider">

                        </div>

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