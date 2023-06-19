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
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="header-title text-center">Plan comptable</h3> <br>
                            <form class="needs-validation" action="{{route('add_plan_comptable')}}" method="post">
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
                                        <input type="text" name="designation" required class="form-control" id="validationCustom01" value="{{old('designation')}}">
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="validationCustom01">Numéro</label>
                                        <input type="text" name="numero" required class="form-control" id="validationCustom01" value="{{old('numero')}}">
                                        
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Plan comptable</h4><br> <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Désignation</th>
                                    <th>Numéro</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($plan_comptables as $plan_comptable)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <td>{{ $plan_comptable->designation }}</td>
                                        <td>{{ $plan_comptable->numero_plan_comptable }}</td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
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