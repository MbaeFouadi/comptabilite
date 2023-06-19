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
                            <h3 class="header-title text-center">Type de dépense par composante</h3> <br>
                            <p class="card-title-desc">Veuillez choisir une date anterieur pour voir l'evolution des recettes des differentes Composantes.</p>

                            <form class="needs-validation" action="{{route('liste_type_depense_par_composante')}}" method="post" >
                                @csrf
                                <div class="row">
                                    <!-- <div class="col-md-4"></div> -->
                               
                                  
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