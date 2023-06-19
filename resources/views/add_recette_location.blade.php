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
                            <h3 class="header-title text-center"> Recette pour location</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form method="POST" action="{{route('store-recette-location')}}" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                @if (session()->has('success'))
                                <div class="alert alert-success"> {{ session()->get('success') }}</div>
                                @endif
                                <div class="row">
                                    @error('description')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Déscription</label>
                                        <input type="text" name="description" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error('nbre_jour')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Nombre de jours</label>
                                        <input type="text" name="nbre_jour" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="row">
                                @error('facture')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Pièces justificatives</label>
                                        <input type="file" name="facture" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error('type_recette_id')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
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