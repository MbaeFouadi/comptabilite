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
                            <h3 class="header-title text-center">Solde compte principal</h3> <br>
                           <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                            @if (isset($solde))
                                <h1 >Solde : <strong>{{$solde->montant}} KMF</strong></h1>
                                    
                                @else
                                <h1 >Solde : <strong>Aucun virement n'est effectué</strong></h1>
                                    
                                @endif
                            </div>
                            <div class="col-md-2"></div>

                           </div>

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