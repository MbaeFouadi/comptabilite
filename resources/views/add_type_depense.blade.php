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
                <!-- <div class="col-md-2"></div> -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center">Type de dépense</h3> <br>
                            <form class="needs-validation" action="{{route('add_type_depenses')}}" method="post">
                                @csrf

                                @if (session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                                @endif
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                    {{ $error }}
                                    @endforeach
                                </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12  mb-3">
                                        <label for="validationCustom01">Désignation</label>
                                        <input type="text" name="designation" required class="form-control" value="{{old('designation')}}">

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Enregistrer</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center"> Veuillez affecter un type de dépense à une composante </h3> <br>

                            <form class="needs-validation" method="post" action="{{route('add_affecte_type_depenses')}}">
                                @csrf
                                <div class="row">
                                    @if(isset($messages))
                                    <div class="alert alert-danger">
                                        {{$messages}}
                                    </div>
                                    @endif

                                    @if(isset($success))
                                    <div class="alert alert-success">
                                        {{$success}}
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-3">

                                        <label>Type des depenses</label>
                                        <select class="custom-select" required name="type_depense_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($type_depenses as $type_depense )
                                            <option value="{{$type_depense->id}}">{{$type_depense->design_depense}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label>Composantes</label>
                                        <select class="custom-select" required name="composante_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($composantes as $composante )
                                            <option value="{{$composante->id}}">{{$composante->designation_composante}}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>

                                </div>
                                <!-- <div class="row">
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>Année</label>
                                        <select class="custom-select" required>
                                            <option value="">Sélectionner l'année</option>
                                            <option value="1">2023</option>
                                            <option value="2">2021</option>
                                            <option value="3">2022</option>
                                        </select>
                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                    </div>
                                    
                                </div> -->

                                <button class="btn btn-primary" type="submit">Valider</button>
                            </form>
                        </div>
                    </div>
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