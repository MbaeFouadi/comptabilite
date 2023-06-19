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
                            <h3 class="header-title text-center"> Budget previsionnels</h3> <br>
                            <p class="card-title-desc">Veuillez choisir une année anterieur pour voir le budget.</p>

                            <form class="needs-validation" action="{{route('liste-detail-budget')}}" method="post">
                                @csrf
                                @if (session()->has('error'))
                                    <div class="alert alert-warning">
                                        {{ session()->get('error') }}
                                    </div>
                                    @endif
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    @error('anne_civil_id')
                                    <div class="alert alert-warning">
                                        {{ message }}
                                    </div>
                                    @enderror
                                        <label>Année</label>
                                        <select class="custom-select" required name="annee_civil_id">
                                            <option value="">Sélectionner</option>
                                            @foreach ($annees as $annee )
                                            <option value="{{$annee->id}}">{{$annee->annee_civil}}</option>
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