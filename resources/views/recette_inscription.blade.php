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

                            <h4 class="header-title text-center">Recette pour les inscriptions</h4><br> <br>

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

                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                            <th>#</th>
                                            <th>Composante</th>
                                            <th>Niveau</th>
                                            <th>Montant</th>

                                        </tr>
                                </thead>


                                <tbody>
                                        <tr>
                                            <th rowspan="5" scope="row">1</th>
                                            <td rowspan="5">FDSE</td>
                                            <td>Licence 1</td>
                                            <td>3500000</td>

                                        </tr>
                                       
                                        <tr>
                                           
                                         
                                            <td>Licence 2</td>

                                           
                                            <td>4500000</td>

                                        </tr>
                                        <tr>
                                            
                                         
                                            <td>Licence 3</td>
                                            <td>1500000</td>

                                        </tr>
                                        <tr>
                                          
                                         
                                            <td>Master 1</td>
                                            <td>300000</td>

                                        </tr>
                                        <tr>
                                            
                                          
                                            <td>Master 2</td>
                                            <td>2500000</td>

                                        </tr>
                                        
                                        <tr>
                                        <td rowspan="5">2</td>
                    
                                            <td rowspan="5">FST</td>
                                            <td>Licence 1</td>
                                            <td>3500000</td>

                                        </tr>
                                       
                                        <tr>
                                           
                                         
                                            <td>Licence 2</td>

                                           
                                            <td>4500000</td>

                                        </tr>
                                        <tr>
                                            
                                         
                                            <td>Licence 3</td>
                                            <td>1500000</td>

                                        </tr>
                                        <tr>
                                            
                                         
                                            <td>Master 1</td>
                                            <td>300000</td>

                                        </tr>
                                        <tr>
                                            
                                          
                                            <td>Master 2</td>
                                            <td>2500000</td>

                                        </tr>

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

@endsection