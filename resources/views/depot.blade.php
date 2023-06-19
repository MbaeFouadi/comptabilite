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
                            <h3 class="header-title text-center"> Validation depot </h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" method="post" action="{{route('add_valider_depot')}}">
                                @csrf
                                @if (session()->has('error'))
                                <div class="alert alert-warning"> {{ session()->get('error') }}</div>
                                @endif
                                @if (session()->has('success'))
                                <div class="alert alert-success"> {{ session()->get('success') }}</div>
                                @endif
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        @error('montant')
                                        <div class="alert alert-warning">{{$message}}</div>

                                        @enderror
                                        <label for="validationCustom01">Montant</label>
                                        <input type="text" name="montant" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        @error('composante_id')
                                        <div class="alert alert-warning">{{$message}}</div>

                                        @enderror
                                        <label>Composantes</label>
                                        <select class="custom-select" name="composante_id" required>
                                            <option value="">Sélectionner</option>
                                            @foreach ($composantes as $composante )
                                            <option value="{{$composante->id}}">{{$composante->designation_composante}}</option>

                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        @error('transaction')
                                        <div class="alert alert-warning">{{$message}}</div>

                                        @enderror
                                        <label for="validationCustom01">Transaction</label>
                                        <input type="text" name="transaction" class="form-control" id="validationCustom01" required>
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