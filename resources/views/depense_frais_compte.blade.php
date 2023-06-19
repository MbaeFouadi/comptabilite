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
                            <h3 class="header-title text-center">Auutres dépenses</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" action="{{route('add-frais-des-comptes')}}" method="post" >
                                @csrf
                                @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @if (session()->has('error'))
                                <div class="alert alert-warning">
                                    {{ session()->get('error') }}
                                </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Déscription</label>
                                        <input type="text" name="description" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de plan Comptable</label>
                                        <select name="plan_comptable_id" class="form-control" id="">
                                            <option value="">Sélectionner</option>
                                            @foreach($plan_comptables as $plan_comptable)
                                            <option value="{{$plan_comptable->id}}">{{ $plan_comptable->numero_plan_comptable }} ({{($plan_comptable->designation)}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Type de dépense</label>
                                        <select name="type_depense_id" class="form-control" id="">
                                     
                                            @foreach($depenses as $depense)
                                            <option value="{{$depense->depense_id}}">{{ $depense->design_depense }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Bénéficiaire</label>
                                        <input type="text" name="beneficiaire" class="form-control" id="validationCustom01" required>
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