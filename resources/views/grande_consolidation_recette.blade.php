<?php

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

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Consolidation des recettes</h4><br> <br>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Type de recette</th>
                                        @foreach ($headers as $header)
                                        <th>{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($composantes as $composante)
                                    <?php
                                    $recettes = DB::table('type_recettes')
                                        ->join('recettes', 'recettes.type_recette_id', '=', 'type_recettes.id')
                                        ->where('recettes.composante_id', $composante->id_composante)
                                        ->select('type_recettes.designation')
                                        ->distinct()
                                        ->pluck('designation');
                                    ?>

                                    @php
                                    $recetteCount = count($recettes);
                                    @endphp

                                    @if ($recetteCount > 0)
                                    @for ($i = 0; $i < $recetteCount; $i++) <tr>
                                        @if ($i === 0)
                                        <td rowspan="{{ $recetteCount }}">
                                            @foreach ($recettes as $recette)
                                            <p>{{ $recette }}</p>
                                            @endforeach
                                        </td>
                                        @endif

                                        <td></td>
                                        <td>NN</td>
                                        <td>CC</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        </tr>
                                        @endfor
                                        @else
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        @endif
                                        @endforeach
                                </tbody>
                            </table>


                        </div>
                    </div>

                    </form>
                </div>
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