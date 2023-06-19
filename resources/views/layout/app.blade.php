<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/xoric/layouts/blue/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 May 2023 13:17:00 GMT -->

<head>
    <meta charset="utf-8" />
    <title>UDC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/udc.png')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <!-- datepicker -->
    <link href="{{asset('assets/libs/air-datepicker/css/datepicker.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{asset('assets/libs/jqvmap/jqvmap.min.css')}}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href=" {{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}} " rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}} " rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}} " rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}} " rel="stylesheet" type="text/css" />

</head>
<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>

<body data-topbar="colored">

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="{{route('/')}}" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/udc.jpg')}} " alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/udc.jpg')}} " alt="" height="80">
                            </span>
                        </a>

                        <a href="{{route('/')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{asset('assets/images/udc.jpg')}} " alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{asset('assets/images/udc.jpg')}} " alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                        <i class="mdi mdi-backburger"></i>
                    </button>

                    <!-- App Search-->
                    <form class="app-search d-none d-lg-block">
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Recherche">
                            <span class="mdi mdi-magnify"></span>
                        </div>
                    </form>
                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block d-lg-none ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>




                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{asset('assets/images/users/avatar-1.jpg')}}" alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1">{{Auth::user()->nom}} {{Auth::user()->prenom}} </span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                      
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('deconnexion') }}">
                                @csrf

                                <x-dropdown-link :href="route('deconnexion')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>

                </div>
            </div> <br>

        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>

                        <li>
                            <a href="{{route('/')}}" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span style="color:white">Tableau du bord</span>
                            </a>
                        </li>
                        @if(Auth::user()->hasRole('Super Administrateur'))
                        <li class="menu-title">Super Administrateur</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                                <span>User</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{{route('category')}}">Ajouter une catégorie</a></li>
                                <li><a href="{{route('add_user')}}">Ajouter un utilisateur</a></li>
                                <li><a href="{{route('show_user')}}">Liste des utilisateurs</a></li>

                            </ul>
                        </li>

                        <li>
                            <a href="{{route('plan_comptable')}}" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span>Plan comptable</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                                <span>Recettes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{{route('type_recette.create')}}">Ajouter un type de recette</a></li>
                                <li><a href="{{route('type-recette-par-composante')}}">Liste type de recette par composante</a></li>

                            </ul>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                                <span>Dépenses</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{{route('add_type_depense')}}">Ajouter un type de dépense</a></li>
                                <li><a href="{{route('type-depense-par-composante')}}">Liste type de dépenses par composante</a></li>


                            </ul>
                        </li>
                        <li>
                            <a href="{{route('annee')}}" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span>Année</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('Caissier') || Auth::user()->hasRole('Super Administrateur'))
                        <li class="menu-title">Caissier</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                                <span>Enregistrement d'un reçu</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{{route('recette.index')}}">Etudiant(e)</a></li>
                                <li><a href="{{route('add_employe')}}">Employé(e)</a></li>


                            </ul>
                        </li>
                        <!-- <li>
                            <a href="{{route('historique-recette')}}" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span>Historiques</span>
                            </a>
                        </li> -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                                <span>Evolution des recettes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('historique-recette')}}">Journalière</a></li>
                                <li><a href="{{route('consolidation_recette_mensuel')}}">Mensuel</a></li>
                                <li><a href="{{route('petit_consolidation_recette')}}">Annuel</a></li>
                            </ul>
                        </li>
                    <li><a href="{{route('hologramme_affecte')}}">Evolution hologrammes</a></li>

                        <li>
                            <a href="{{route('caisse')}}" class="waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                <span>Caisse</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::user()->hasRole('Gestionnaire') || Auth::user()->hasRole('Super Administrateur'))


                        <li class="menu-title">Gestionnaires</li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                                <span>Recettes</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{route('recette.index')}}">Faire un reçu</a></li>
                                <li><a href="{{route('add-recette-location')}}">Recette location </a></li>
                                <li>
                                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                                        <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                                        <span>Consolidation</span>
                                    </a>
                                    <ul class="sub-menu" aria-expanded="false">
                                        <li><a href="{{route('historique-recette')}}">Journalière</a></li>
                                        <li><a href="{{route('consolidation_recette_mensuel')}}">Mensuel</a></li>
                                        <li><a href="{{route('petit_consolidation_recette')}}">Annuel</a></li>
                                    </ul>
                                </li>


                        </li>

                    </ul>

                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-layer-group"></i></div>
                            <span>Dépenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('retrait_cheque')}}">Ajouter un chèque pour retrait</a></li>
                            <li><a href="{{route('enregistrement-depense')}}">Enregistrer une depense</a></li>
                            <li><a href="{{route('historique-depense')}}">Historique des depenses</a></li>
                            <li><a href="{{route('petit-consolidation-depense')}}">Consolidation des dépenses</a></li>
                            <li><a href="{{route('detail_budget_previsionnel_composante')}}">Budjets prévisionels</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('hologramme_affecte')}}">Evolution hologrammes</a></li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Mes soldes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('caisse')}}">Recettes en espèce</a></li>
                            <li><a href="{{route('compte')}}">Compte principal</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('Chargé des recettes') || Auth::user()->hasRole('Super Administrateur'))


                    <li class="menu-title">Chargé des recettes</li>
                    <!-- <li>
                        <a href="{{route('evolution_recette')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Evolution des recettes</span>
                        </a>
                    </li> -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Recettes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{{route('recette_preinscription')}}">Préinscriptions </a></li>
                            <li><a href="{{route('recette_inscription')}}">Inscriptions</a></li>
                            <li><a href="{{route('add-preinscription')}}">Enregistrer recette préinscriptions</a></li>
                            <li><a href="{{route('add-inscription')}}">Enregistrer recette inscriptions</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Evolution des recettes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('evolution_recette')}}">Journalière</a></li>
                            <li><a href="{{route('evolution_recette_mensuel')}}">Mensuel</a></li>
                            <li><a href="{{route('historique_recette_annuel')}}">Annuel</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('consolidation-recette')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Consolidation des recettes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('solder-recette-par-composantes')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Solde en espèce par composante</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('valider_depot')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Valider un dépôt</span>
                        </a>
                    </li>

                    @endif
                    @if(Auth::user()->hasRole('Chargé du budget') || Auth::user()->hasRole('Super Administrateur'))
                    <li class="menu-title">Chargé du budget</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Evolution des dépenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('evolution-depense-journaliere')}}">Journalière</a></li>
                            <li><a href="{{route('evolution-depense-mensuel')}}">Mensuel</a></li>
                            <li><a href="{{route('evolution-depense-annuel')}}">Annuelle</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('consolidation-depense')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Consolidation des dépenses</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Budgets</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{{route('budget_realise')}}">Budgets realisés par composante </a></li>
                            <li><a href="{{route('budget_previsionnel')}}">Budjets prévisionels par composante</a></li>
                            <li><a href="{{route('budget_global')}}">Budjets global</a></li>
                            <li><a href="{{route('add-budget')}}">Ajouter un budget</a></li>
                            <li><a href="{{route('detail-budget')}}">Detail budget</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('Contrôleur financier') || Auth::user()->hasRole('Super Administrateur'))

                    <li class="menu-title">Contrôleur financier</li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Evolution des recettes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('evolution_recette')}}">Journalière</a></li>
                            <li><a href="{{route('evolution_recette_mensuel')}}">Mensuel</a></li>
                            <li><a href="{{route('historique_recette_annuel')}}">Annuel</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Evolution des dépenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('evolution-depense-journaliere')}}">Journalière</a></li>
                            <li><a href="{{route('evolution-depense-mensuel')}}">Mensuel</a></li>
                            <li><a href="{{route('evolution-depense-annuel')}}">Annuelle</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('consolidation-recette')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Consolidation des recettes</span>

                        </a>
                    </li>
                    <li>
                        <a href="{{route('consolidation-depense')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Consolidation des dépenses</span>

                        </a>
                    </li>
                    <li>
                        <a href="{{route('solder-recette-par-composantes')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Solde en espèce par composante</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('annulation_recu')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Annulation d'un reçu</span>

                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('Agent Comptable') || Auth::user()->hasRole('Super Administrateur'))
                    <li class="menu-title">Agent comptable</li>
                    <li>
                        <a href="{{route('retrait_cheque')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Enregistrer un chèque</span>
                        </a>
                    </li>
                    <li>

                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Dépenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{{route('enregistrement-depense')}}">Ajouter une dépense</a></li>
                            <li><a href="{{route('autres-depenses-comptes')}}">Autre depenses</a></li>
                            <li><a href="{{route('agent-comptable-virement')}}">Virement composante</a></li>
                            <!-- <li><a href="{{route('depenses-salaires')}}">Salaires</a></li> -->
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Hologramme</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{{route('hologramme')}}">Affecter un hologramme à une composante</a></li>
                            <li><a href="{{route('entree_hologramme')}}">Ajouter un hologramme à une composante</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Evolution</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                                    <span>Recettes</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('evolution_recette')}}">Journalière</a></li>
                                    <li><a href="{{route('evolution_recette_mensuel')}}">Mensuel</a></li>
                                    <li><a href="{{route('historique_recette_annuel')}}">Annuel</a></li>

                                    <li>
                                        <a href="{{route('consolidation-recette')}}" class="waves-effect">
                                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                            <span>Consolidation des recettes</span>

                                        </a>
                                    </li>
                                    <li><a href="{{route('agent-comptable-recette_preinscription')}}">Recettes préinscriptions</a></li>
                                    <li><a href="{{route('agent-comptable-recette_inscription')}}">Recettes inscriptions</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                                    <span>Dépenses</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('evolution-depense-journaliere')}}">Journalière</a></li>
                                    <li><a href="{{route('evolution-depense-mensuel')}}">Mensuel</a></li>
                                    <li><a href="{{route('evolution-depense-annuel')}}">Annuelle</a></li>
                                    <li>
                                        <a href="{{route('consolidation-depense')}}" class="waves-effect">
                                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                            <span>Consolidation des dépenses</span>

                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li><a href="{{route('evolution_hologramme')}}">Hologramme</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('solder-recette-par-composantes')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Solde en espèce par composante</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-box"></i></div>
                            <span>Soldes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{{route('solde-composante')}}">Composantes</a></li>
                            <li><a href="{{route('solde-compte-principal')}}">Compte Principal UDC</a></li>

                        </ul>
                    </li>
                    @endif
                    @if(Auth::user()->hasRole('Président') || Auth::user()->hasRole('Super Administrateur'))

                    <li class="menu-title">Président</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-object-ungroup"></i></div>
                            <span>Evolution des dépenses</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('evolution-depense-journaliere')}}">Journalière</a></li>
                            <li><a href="{{route('evolution-depense-mensuel')}}">Mensuel</a></li>
                            <li><a href="{{route('evolution-depense-annuel')}}">Annuelle</a></li>
                            <li>
                                <a href="{{route('consolidation-depense')}}" class="waves-effect">
                                    <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                                    <span>Consolidation des dépenses</span>

                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('solde-compte-principal')}}" class="waves-effect">
                            <div class="d-inline-block icons-sm mr-1"><i class="uim uim-airplay"></i></div>
                            <span>Compte Principal</span>


                        </a>
                    </li>
                    @endif

                    </ul>

                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            @yield('content')
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2023 © UDC.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Developpé  par <a href="https://1.envato.market/themesdesign" target="_blank">xD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="{{asset('assets/libs/jquery/jquery.min.js')}} "></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}} "></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}} "></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}} "></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}} "></script>

    <script src="../../../../../unicons.iconscout.com/release/v2.0.1/script/monochrome/bundle.js"></script>

    <!-- datepicker -->
    <script src="{{asset('assets/libs/air-datepicker/js/datepicker.min.js')}} "></script>
    <script src="{{asset('assets/libs/air-datepicker/js/i18n/datepicker.en.js')}} "></script>

    <!-- apexcharts -->
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}} "></script>

    <script src="{{asset('assets/libs/jquery-knob/jquery.knob.min.js')}} "></script>

    <!-- Jq vector map -->
    <script src="{{asset('assets/libs/jqvmap/jquery.vmap.min.js')}} "></script>
    <script src="{{asset('assets/libs/jqvmap/maps/jquery.vmap.usa.js')}} "></script>

    <script src="{{asset('assets/js/pages/dashboard.init.js')}} "></script>

    <script src="{{asset('assets/js/app.js')}} "></script>


    <!-- Required datatable js -->
    <script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}} "></script>
    <!-- Buttons examples -->
    <script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}} "></script>
    <script src="{{asset('assets/libs/jszip/jszip.min.js')}} "></script>
    <script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}} "></script>
    <script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}} "></script>
    <!-- Responsive examples -->
    <script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}} "></script>
    <script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{asset('assets/js/pages/datatables.init.js')}} "></script>


</body>

<!-- Mirrored from themesdesign.in/xoric/layouts/blue/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 May 2023 13:18:32 GMT -->

</html>