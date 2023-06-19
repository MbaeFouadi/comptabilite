t<?php

    use Illuminate\Support\Facades\DB;

    ?>
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
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Budget </h4><br> <br>

                            <!-- 
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Type de recette</th>
                                            <th>Montant</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Certification de diplômes</td>
                                            <td>25000 KMF</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Photocopies</td>
                                            <td>15000 KMF</td>

                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Total</td>
                                            <td>50000 KMF</td>

                                        </tr>

                                    </tbody>
                                </table>
                            </div> -->

                            <table id="datatable-buttons" class="table " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Numero de plan comptable</th>
                                        <th>Montant realisé</th>
                                        <th>Montant prévisonnel</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>


                                <tbody>
                                    @php
                                    $i=1;
                                    @endphp
                                    @foreach ($datas as $data)
                                    <?php

                                    $montant_realise = DB::table("depenses")
                                        ->where("plan_comptable_id", $data->plan_id)
                                        ->where("composante_id", $composante_id)
                                        ->where("annee_civil_id", $annee_civil->id)
                                        ->sum("depenses.montant");
                                    $budget = DB::table("budget_previsionnel")
                                        ->where("plan_comptable_id", $data->plan_id)
                                        ->where("composante_id", $composante_id)
                                        ->where("annee_civil_id", $annee_civil->id)
                                        ->first();
                                    ?>
                                    <tr>
                                        <td>{{$data->numero_plan_comptable}} ({{$data->designation}})</td>
                                        <td>{{$montant_realise}} KMF</td>
                                        @if(isset($budget))
                                        <td>{{$budget->montant_previsionnel}} KMF</td>
                                        @if(Auth::user()->hasRole('Chargé du budget'))

                                        <div class="modal fade" id="exampleModal{{$i}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Message</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" class="update" method="POST" data-id="{{$budget->id}}">
                                                        @csrf
                                                            <input type="text" class="form-control" name="montant_prevu" id="" value="{{$budget->montant_previsionnel}}">
                                                            <input type="hidden" class="form-control" name="id" id="" value="{{$budget->id}}">

                                                            <div class="modal-footer">

                                                                <input type="submit" class="btn btn-primary" name="submit" value="Enregistrez">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermez</button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <td><a href="#modal" data-bs-target="#exampleModal{{$i}}" data-bs-toggle="modal" data-id="{{$data->plan_id}}" class="btn btn-primary">Modifier</a></td>

                                        @endif
                                        @else
                                        <td>
                                            <form method="POST" class="forms" action="" data-id="{{$data->plan_id}}">
                                                @csrf


                                                <input type="hidden" class="form-control" value="{{$montant_realise}}" name="montant_realise" id="montant_realise">
                                                <input type="hidden" class="form-control" value="{{$data->plan_id}}" name="plan_comptable_id" id="plan_comptable_id">
                                                <input type="hidden" class="form-control" value="{{$composante_id}}" name="composante_id" id="composante_id">
                                                <input type="text" class="form-control" name="montant_prevu" required id="montant_prevu">

                                        <td><input type="submit" id="forms" class="btn btn-sm btn-primary" value="Valider"></td>
                                        </td>
                                        @endif

                                        @php
                                        $i++;
                                        @endphp
                                    </tr>
                                    </form>
                                    @endforeach




                                </tbody>
                            </table>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">

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

        $(".forms").submit(function(event) {

            event.preventDefault();
            var doc = $(this).serializeArray();

            var formData = new FormData(this);


            console.log(formData);

            $.ajax({
                _token: '{{csrf_token()}}',
                type: "POST",
                url: "{{route('add-detail_budget_previsionnel')}}",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {

                    location.reload();
                },

                error: function(jqXHR, status, error) {
                    jsonValue = jQuery.parseJSON(jqXHR.responseText);
                    console.log(jsonValue);

                    $("#messaged").empty();
                    $("#messaged").append("<div class='alert alert-warning'>Le document doit être de type pdf et de taille inférieure ou égale à 2Mo </div>")
                    // $("#messaged").append("<div class='alert alert-warning'>"+jsonValue.errors.document[0]+"</div>")

                }
            });
        });


        $(".update").submit(function(event) {

            event.preventDefault();
            var doc = $(this).serializeArray();

            var formData = new FormData(this);


            console.log(formData);

            $.ajax({
                _token: '{{csrf_token()}}',
                type: "POST",
                url: "{{route('update_budget')}}",
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                success: function(res) {

                    location.reload();
                },

                error: function(jqXHR, status, error) {
                    jsonValue = jQuery.parseJSON(jqXHR.responseText);
                    console.log(jsonValue);
                    location.reload();
                    $("#messaged").empty();
                    $("#messaged").append("<div class='alert alert-warning'>Le document doit être de type pdf et de taille inférieure ou égale à 2Mo </div>")
                    // $("#messaged").append("<div class='alert alert-warning'>"+jsonValue.errors.document[0]+"</div>")

                }
            });
        });




    });
</script>
@endsection