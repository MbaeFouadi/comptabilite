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
                            <h3 class="header-title text-center">Retrait chèque</h3> <br>
                            <!-- <p class="card-title-desc">For custom Bootstrap form validation messages, you’ll need to add the <code>novalidate</code> boolean attribute to your <code>&lt;form&gt;</code>.</p> -->

                            <form class="needs-validation" method="post" action="{{route('add_retrait_cheque')}}">
                                @csrf
                                
                                @if (isset($messages))
                                <div class="alert alert-warning">{{$messages}}</div>
                                @endif
                                @error("numero_cheque")
                                <div class="alert alert-warning">{{$message}}</div>
                                @enderror
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="validationCustom01">Numero chèque</label>
                                        <input type="text" name="numero_cheque" class="form-control" id="validationCustom01" required>
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
                                <!-- <div class="row">
                                  
                                    <div class="col-md-6 mb-3">
                                        <label for="validationCustom01">Description</label>
                                        <textarea name="" class="form-control" id="" cols="100" rows="5"></textarea>
                                    </div>
                                    
                                </div>
                                -->

                                <button class="btn btn-primary" type="submit">Valider</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Mes chèques</h4><br> <br>



                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Numero de chèques</th>
                                        <th>Montant</th>


                                    </tr>
                                </thead>


                                <tbody>

                                    @foreach ($datas as $data )
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>{{$data->numero_cheque}}</td>
                                        <td>{{$data->montant}} KMF</td>


                                    </tr>
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