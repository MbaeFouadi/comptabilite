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
                            <h3 class="header-title text-center">Virement</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form method="post" action="{{route('add_virement')}}">
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
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                        {{ $error }}
                                        @endforeach
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">

                                        <label for="validationCustom01">Bénéficiaire</label>
                                        <select class="custom-select" required name="composante_id">
                                            <option value="">Sélectionner</option>
                                            @foreach($composantes as $composante)
                                            <option value="{{$composante->id}}">{{$composante->designation_composante}}</option>
                                            @endforeach
                                        </select>

                                        <div class="invalid-feedback">Example invalid custom select feedback</div>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de plan Comptable</label>
                                        <select name="plan_comptable_id" class="form-control" id="">
                                            <option value="">Sélectionner</option>
                                            @foreach($plan_comptables as $plan_comptable)
                                            <option value="{{$plan_comptable->id}}">{{ $plan_comptable->numero_plan_comptable }} ({{($plan_comptable->designation)}})</option>
                                            @endforeach
                                        </select>
                                    </div> -->
                                </div>
                                <div class="row">
                                </div>
                                <div class="row">
                                    <!-- <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Type de dépense</label>
                                        <select name="type_depense_id" class="form-control" id="type_depense_id">

                                            @foreach($depenses as $depense)
                                            <option value="{{$depense->depense_id}}">{{ $depense->design_depense }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Numero de plan Comptable</label>
                                        <select name="plan_comptable_id" class="form-control" id="plan_id">
                                            <option value="">Sélectionner</option>
                                            @foreach($plan_comptables as $plan_comptable)
                                            <option value="{{$plan_comptable->id}}">{{ $plan_comptable->numero_plan_comptable }} ({{($plan_comptable->designation)}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="row">


                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Type de dépense</label>
                                        <select name="type_depense_id" class="form-control" id="">
                                      
                                            @foreach($depenses as $depense)
                                            <option value="{{$depense->depense_id}}">{{ $depense->design_depense }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> -->
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
<script>
    $(document).ready(function() {

        $("#plan").hide();

        var plan = $('#plan_id').val();

        $("#type_depense_id").change(function() {

            var plans = $(this).val();


            if (plans == 3 || plans == 4) {
            

                $("#plan").show();
            } else {
                $("#plan").hide();

            }
        })

    });
</script>
@endsection