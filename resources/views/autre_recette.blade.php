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
                            <h3 class="header-title text-center">Autres recettes pour l'UDC</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form method="POST" action="{{route('autre_recette')}}"  enctype="multipart/form-data">
                                @csrf
                                @if (session()->has('success'))
                                <div class="alert alert-success"> {{ session()->get('success') }}</div>
                                @endif

                                @if (session()->has('error'))
                                <div class="alert alert-warning"> {{ session()->get('error') }}</div>
                                @endif
                                <div class="row">
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
                                    @error('montant')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    @error('composante_id')
                                    <div class="alert alert-warning">{{$message}}</div>
                                    @enderror
                                  
                                    <div class="col-md-6 mb-3">
                                        <label>Composantes</label>
                                        <select class="custom-select" required name="composante_id">
                                            <option value="">Sélectionner</option>
                                           @foreach ($composantes as $composante)
                                               <option value="{{$composante->id}}">{{$composante->designation_composante}}</option>
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