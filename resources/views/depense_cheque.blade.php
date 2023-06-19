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
                            <h3 class="header-title text-center">Ajouter une dépense </h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <!-- <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Déscription</label>
                                        <input type="text" name="design" class="form-control" id="validationCustom01"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Bénéficiaire</label>
                                        <input type="text" name="beneficaire" class="form-control" id="validationCustom01"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de chèque</label>
                                       <select name="" class="form-control" id="" name="numero_cheque">
                                        <option value="">Sélectionner</option>
                                        <option value="">0255445</option>
                                        <option value="">0255445</option>

                                       </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de chèque</label>
                                       <select name="" class="form-control" id="">
                                        <option value="">Sélectionner</option>
                                        <option value="">0255445</option>
                                        <option value="">0255445</option>

                                       </select>
                                    </div> -->
                                    <!-- <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant à dépenser</label>
                                        <input type="text" name="design" class="form-control" id="validationCustom01"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de plan Comptable</label>
                                       <select name="" class="form-control" id="" name="numero_plan_comptable">
                                        <option value="">Sélectionner</option>
                                        <option value="">60</option>
                                        <option value="">70</option>

                                       </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Déscription</label>
                                        <input type="text" name="description" class="form-control" id="validationCustom01"  required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Facture</label>
                                        <input type="file" name="facture" class="form-control" id="validationCustom01"  required>
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