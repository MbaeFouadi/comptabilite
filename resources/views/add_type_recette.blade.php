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
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center"> Veuillez ajouter un type de recette </h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" method="post" action="{{route('type_recette.store')}}">
                                @csrf
                                <div class="row">
                                    @error('designation')
                                    <div class=" alert alert-danger">{{$message}}</div>

                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Nom type recette</label>
                                        <input type="text" name="designation" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error('prix')
                                    <div class=" alert alert-danger">{{$message}}</div>

                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom02">Montant</label>
                                        <input type="text" name="prix" class="form-control" id="validationCustom02" >
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    @error('annee__id')
                                    <div class=" alert alert-danger">{{$message}}</div>

                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label>Années</label>
                                        <select class="custom-select" required name="annee_id">
                                            <option value="">Sélectionner l'année</option>
                                            @foreach ($annees as $annee )
                                            <option value="{{$annee->id}}">{{$annee->designation_annee}}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                    <div class="col-md-6">
                                        @error('hologramme')
                                        <div class=" alert alert-danger">{{$message}}</div>

                                        @enderror
                                        <!-- <div class="mt-4"> -->
                                        <h5 class="font-size-14 mb-3">Hologramme?</h5>
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="hologramme" value="1" id="inlineRadios1" value="option1">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="hologramme" value="0" id="inlineRadios2" value="option2" checked>
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    @error('employe')
                                    <div class=" alert alert-danger">{{$message}}</div>

                                    @enderror
                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mb-3">Employé?</h5>
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employe" value="1" id="inlineRadios1">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="employe" value="0" id="inlineRadios2" checked>
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mb-3">Location?</h5>
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="location" value="1" id="inlineRadios1">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="location" value="0" id="inlineRadios2" checked>
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mb-3">Etat?</h5>
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="etat" value="1" id="inlineRadios1">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="etat" value="0" id="inlineRadios2" checked>
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="font-size-14 mb-3">Droit d'inscription?</h5>
                                        <div class="mt-4">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="droit" value="1" id="inlineRadios1">
                                                <label class="form-check-label" for="inlineRadios1">
                                                    Oui
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="droit" value="0" id="inlineRadios2" checked>
                                                <label class="form-check-label" for="inlineRadios2">
                                                    Non
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center"> Veuillez affecter un type de recette à une composante </h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" method="post" action="{{route('type-recette-par-composante')}}">
                                @csrf
                                <div class="row">
                                    @if(isset($messages))
                                    <div class="alert alert-danger">
                                        {{$messages}}
                                    </div>
                                    @endif

                                    @if(isset($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">

                                        <label>Type des recettes</label>
                                        <select class="custom-select" required name="type_recette_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($type_recettes as $type_recette )
                                            <option value="{{$type_recette->id}}">{{$type_recette->designation}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Composantes</label>
                                        <select class="custom-select" required name="composante_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($composantes as $composante )
                                            <option value="{{$composante->id}}">{{$composante->designation_composante}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>

                                </div>
                                <!-- <div class="row">
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>Année</label>
                                        <select class="custom-select" required>
                                            <option value="">Sélectionner l'année</option>
                                            <option value="1">2023</option>
                                            <option value="2">2021</option>
                                            <option value="3">2022</option>
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                    
                                </div> -->

                                <button class="btn btn-primary" type="submit">Valider</button>
                            </form>
                        </div>
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