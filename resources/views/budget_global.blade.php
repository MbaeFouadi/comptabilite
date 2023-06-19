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
                <!-- <div class="col-md-1"></div> -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="header-title text-center">Budget global</h4><br> <br>


                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive responsive" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>

                                        <th>Compte</th>
                                        <th>Designation</th>
                                        <th>Montant Realisé</th>
                                        <th>Montant prévu</th>
                                        <th>Ecart</th>
                                        <th>Realisation</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($datas as $data )
                                    @php
                                    $sum=DB::table("depenses")
                                    ->where("plan_comptable_id",$data->plan_id)
                                    ->sum('montant');

                                    $an=date('Y');
                                    $annee=$an-1;
                                    $anne_civil = DB::table("annee_civil")->where('annee_civil',$annee)->first();

                                    $montant_previ=DB::table("budget_previsionnel")
                                    ->where('plan_comptable_id',$data->plan_id)
                                    ->where('annee_civil_id',$anne_civil->id)
                                    ->first();

                                    @endphp
                                    <tr>
                                        <td>{{$data->numero_plan_comptable}}</td>
                                        <td>{{$data->designation}}</td>
                                        <td>{{ intval($sum)}} KMF</td>
                                        @if (isset($montant_previ))
                                        <td>{{$montant_previ->montant_previsionnel}} KMF</td>
                                        <td>{{$montant_previ->montant_previsionnel - $sum}} KMF</td>
                                        <td>{{intval($sum/$montant_previ->montant_previsionnel * 100)}}%</td>
                                        @else
                                        <td>NULL</td>
                                        <td>NULL</td>
                                        <td>NULL</td> 
                                        @endif
                                   
                                    </tr>
                                    @endforeach








                                </tbody>
                            </table>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-1"> -->

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