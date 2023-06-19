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
                            <!-- <h3 class="header-title text-center">Information</h3> <br> -->
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{asset('assets/images/udc.jpg')}}" width="70px" height="70px" alt="">
                                </div>
                                <div class="col-md-8">
                                    <h4 class="text-center"> <strong>Université des Comores</strong></h4>
                                    <p class="text-center">******************</p>
                                    <p class="text-center">Administration centrale</p>
                                    <p class="text-right text-bold">Recu N°{{$recette->recette_id}}</p>
                                

                                    <hr>
                                <h3 style="font-weight: bold;" class="text-center">Service de la comptabilité</h3>
                                </div>
                            </div>
                            <div class="container" style="font-weight: bolder;font-size:15px">
                                <p class="text-center text-blod" style="border: 1px solid black;">Reçu de {{$recette->designation}}</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Nom :{{$data['nom']}} </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Montant : {{$montant->prix}} KMF</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Prénom : {{$data['prenom']}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Matricule : {{$data['mat_etud']}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Niveau  d'étude: {{$data['intit_niv']}} </p>
                                    </div>
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Faculté :  {{$data['design_facult']}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Département: {{$data['design_depart']}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Téléphone : {{$data['Tel_Etud']}}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Visa du caisier  </p> <br> <br>
                                        <p>Fait à Mavingouni le .../.../</p>
                                    </div>
                       
                                </div>
                            </div>
                            <button class="btn btn-primary">Imprimer</button>
                        
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