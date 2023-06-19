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

                            <form class="needs-validation" method="post" action="{{route('add-enregistrement-depense')}}" enctype="multipart/form-data">
                                @csrf
                                @if (session()->has('messages'))
                                <div class="alert alert-success"> {{ session()->get('messages') }}</div>
                                @endif
                                <div class="row">
                                    @error("beneficiaire")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Bénéficiaire</label>
                                        <input type="text" name="beneficiaire" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error("numero_cheque")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numéro de chèque</label>
                                        <select class="form-control" id="" name="numero_cheque" required>
                                            @if (isset($cheques))
                                            @foreach ($cheques as $cheque)
                                            <option value="{{$cheque->id}}">{{$cheque->numero_cheque}}</option>
                                            @endforeach
                                                
                                            @else
                                                <option value="">Veuillez ajouter un chèque pour faire une dépense</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                          
                                <div class="row">
                                @error("numero_plan")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numéro de plan comptable</label>
                                        <select class="form-control" id="" name="numero_plan" required>
                                            <option value="">Sélectionner</option>
                                            @foreach ($plans as $plan)
                                               <option value="{{$plan->id}}">{{$plan->numero_plan_comptable}} ({{$plan->designation}})</option> 
                                            @endforeach

                                        </select>
                                    </div>
                                    @error("description")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Déscription</label>
                                        <input type="text" name="description" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                @error("montant")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    @error("facture")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Facture</label>
                                        <input type="file" name="facture" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                @error("type_depense_id")
                                    <div class="alert alert-warning">{{$message}}</div>
                                        
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Type de dépense</label>
                                        <select class="form-control" name="type_depense_id" id="" required>
                                            @foreach ($depenses as $depense )
                                            <option value="{{$depense->id}}">{{$depense->design_depense}}</option>
                                            @endforeach
                                        </select>
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