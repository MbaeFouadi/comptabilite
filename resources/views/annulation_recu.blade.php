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
                            <h3 class="header-title text-center">Suppression d'un reçu</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" method="post" action="{{route('suppression_recu')}}">
                                @csrf
                                <div class="row">

                                    @error('recu')
                                    <div class="alert alert-success">
                                        {{$message}}
                                    </div>
                                    @enderror
                                    <div class="col-md-6 mb-3">
                                        @if (session()->has('error'))
                                        <div class="alert alert-warning">
                                            {{ session()->get('error') }}
                                        </div>
                                        @endif

                                        <label for="validationCustom01">Numero de reçu</label>
                                        <input type="text" name="recu" placeholder="Veuilez saisir le numero de reçu" class="form-control" id="validationCustom01" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">

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