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
                            <h3 class="header-title text-center">Informations</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" novalidate method="POST" action="{{route('recette.store')}}">
                                @csrf
                            <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <h6> Matricule: {{$data['mat_etud']}}</h6> 
                                      <input type="hidden" name="mat_etud" value="{{$data['mat_etud']}}">
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                      <h6> Nom: {{$data['nom']}}</h6> 
                                      <input type="hidden" name="nom" value="">

                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <h6>Prénom: {{$data['prenom']}}</h6> 
                                      <input type="hidden" name="prenom" value="">

                                         
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <h6>Adresse: {{$data['Adr_Etud']}}</h6> 
                                    <input type="hidden" name="" value="">                                        
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <h6>Téléphone: {{$data['Tel_Etud']}}</h6>  
                                      <input type="hidden" name="" value="">

                                         
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <h6>Type de recette: {{$recette->designation}}</h6> 
                                    <input type="hidden" name="type_recette" value="{{$recette->id}}">

                                    
                                    </div>
                                    <div class="col-md-6 mb-3">
                                      <h6>Montant: {{$recette->prix}} KMF</h6> 
                                      <input type="hidden" name="" value="">

                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <h6>Composante: {{$data['design_facult']}}</h6> 
                                    <input type="hidden" name="" value="">
                                     
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    <h6>Département: {{$data['design_depart']}}</h6> 
                                    <input type="hidden" name="" value="">
                                     
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <h6>Niveau d'étude: {{$data['intit_niv']}}</h6> 
                                    <input type="hidden" name="" value="">
                                     
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    <h6>Année: {{$data['annee']}}</h6> 
                                    <input type="hidden" name="annee" value="{{$annee_id}}">
                                    <input type="hidden" name="annees" value="{{$data['annee']}}">
                                     
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