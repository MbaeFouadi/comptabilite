<?php

use App\Http\Controllers\agentComptableController;
use App\Http\Controllers\chargeBudgetController;
use App\Http\Controllers\chargeRecetteController;
use App\Http\Controllers\ControleurFinancierController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\gestionnaireController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\presidentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\TypeRecetteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


 Route::get('/laratrust',function(){
    return view("vendor.laratrust.panel.layout");
 });
Route::middleware('auth')->group(function () {

    Route::get('/accueil', [homeController::class, 'index'])->name("accueil");
    Route::get('/category', [homeController::class, 'category'])->name("category");
    Route::post('/add_category', [homeController::class, 'add_category'])->name("add_category");
    Route::get('/add_user', [homeController::class, 'add_user'])->name("add_user");
    Route::get('/add_employe', [homeController::class, 'add_employe'])->name("add_employe");
    Route::get('/show_user', [homeController::class, 'show_user'])->name("show_user");
    Route::get('/plan-comptable', [homeController::class, 'plan_comptable'])->name("plan_comptable");
    Route::post('/add_plan_comptable', [homeController::class, 'add_plan_comptable'])->name("add_plan_comptable");
    Route::get('/annee', [homeController::class, 'annee'])->name("annee");
    Route::POST('/add_annee', [homeController::class, 'add_annee'])->name("add_annee");
    Route::get('/type-recette-par-composante', [homeController::class, 'type_recette'])->name("type-recette-par-composante");
    Route::get('/add-type-depenses', [homeController::class, 'add_type_depense'])->name("add_type_depense");
    // Route::post('/add_type_depenses', [homeController::class, 'add_type_depenses'])->name("add_type_depenses");
    // Route::get('/type-depense-par-composante', [homeController::class, 'type_depense'])->name("type-depense-par-composante");
    // Route::get('/login',function(){

    //     return view('login');
    // });

    

    Route::post('/add_type_depenses', [homeController::class, 'add_type_depenses'])->name("add_type_depenses");
    Route::post('/add_affecte_type_depenses', [homeController::class, 'add_affecte_type_depenses'])->name("add_affecte_type_depenses");
    Route::get('/type-depense-par-composante', [homeController::class, 'type_depense'])->name("type-depense-par-composante");





    Route::resource('type_recette', TypeRecetteController::class);
    Route::resource('employe',EmployeeController::class);
    Route::post('/type-recette-par-composante', [TypeRecetteController::class, 'affectation_recette'])->name("type-recette-par-composante");
    Route::post('/liste-type_recette-par-composante', [TypeRecetteController::class, 'liste_affectation_recette'])->name("liste-recette-par-composante");
    Route::resource('recette', RecetteController::class);
    Route::get('recu', [RecetteController::class, 'recu'])->name("recu");
    Route::get('historique-recette', [RecetteController::class, 'historique'])->name("historique-recette");
    Route::post('liste-recette', [RecetteController::class, 'liste'])->name("liste_recette");
    Route::get('caisse_journalier', [RecetteController::class, 'caisse_journalier'])->name("caisse_journalier");

    Route::get('caisse', [RecetteController::class, 'caisse'])->name("caisse");
    // Route::post('detail_caisse', [RecetteController::class, 'detail_caisse'])->name("detail_caisse");
    Route::post('show_info', [RecetteController::class, 'show_info'])->name("show_info");
    Route::get('add-recette-location', [RecetteController::class, 'add_recette_location'])->name("add-recette-location");
    Route::post('store-recette-location', [RecetteController::class, 'store_recette_location'])->name("store-recette-location");
    Route::post('/liste_type_depense_par_composante', [TypeRecetteController::class, 'liste_type_depense_par_composante'])->name("liste_type_depense_par_composante");



    // Route::controller(EmployeeController::class)->group(function(){
    //     Route::resource('etudiant');
    // });

    Route::controller(gestionnaireController::class)->group(function () {
        Route::get('/gestionnaire/petit_consolidation_recette/', 'consolidation_recette')->name('petit_consolidation_recette');
        Route::get('/gestionnaire/depense/retrait_cheque', 'retrait_cheque')->name('retrait_cheque');
        Route::post('/gestionnaire/depense/add_retrait_cheque', 'add_retrait_cheque')->name('add_retrait_cheque');
        Route::get('/gestionnaire/enregistrement-depense', 'enregistrement_depense')->name('enregistrement-depense');
        Route::post('/gestionnaire/add-enregistrement-depense', 'add_enregistrement_depense')->name('add-enregistrement-depense');
        Route::get('/gestionnaire/historique-depense', 'historique_depense')->name('historique-depense');
        Route::get('/gestionnaire/liste-depense', 'liste_depense')->name('liste-depense');
        Route::get('/gestionnaire/detail-liste-depense/{id}', 'detail_liste_depense')->name('detail_liste-depense');
        Route::get('/gestionnaire/petit-consolidation-depense/', 'consolidation_depense')->name('petit-consolidation-depense');
        Route::get('/gestionnaire/recette-en-espece/', 'recette_espece')->name('recette_espece');
        Route::get('/gestionnaire/compte/', 'compte')->name('compte');
        Route::get('/gestionnaire/consolidation-recette-mensuel/', 'consolidation_recette_mensuel')->name('consolidation_recette_mensuel');
        Route::post('/gestionnaire/liste-consolidation-recette-mensuel/', 'liste_consolidation_recette_mensuel')->name('liste_consolidation_recette_mensuel');
    });

    Route::controller(chargeRecetteController::class)->group(function () {
        Route::get('/charge-recette/evolution-recette/', 'evolution_recette')->name('evolution_recette');
        Route::get('/charge-recette/historique-recette-annuel/', 'historique_recette_annuel')->name('historique_recette_annuel');
        Route::post('/charge-recette/historique-recette-annuel/', 'liste_historique_recette_annuel')->name('historique_recette_annuel');
        Route::post('/charge-recette/liste-evolution-recette', 'liste_evolution_recette')->name('liste-evolution-recette');
        Route::get('/charge-recette/recette_preinscription', 'recette_preinscription')->name('recette_preinscription');
        Route::get('/charge-recette/recette_inscription', 'recette_inscription')->name('recette_inscription');
        Route::get('/charge-recette/consolidation-recette', 'consolidation_recette')->name('consolidation-recette');
        Route::get('/charge-recette/valider-depot', 'valider_depot')->name('valider_depot');
        Route::post('/charge-recette/add-valider-depot', 'add_valider_depot')->name('add_valider_depot');
        Route::get('/charge-recette/evolution-recette-mensuel/', 'evolution_recette_mensuel')->name('evolution_recette_mensuel');
        Route::post('/charge-recette/liste-evolution-recette-mensuel', 'liste_evolution_recette_mensuel')->name('liste-evolution-recette-mensuel');
        Route::get('/charge-recette/add-preinscription', 'add_preinscription')->name('add-preinscription');
        Route::post('/charge-recette/add-preinscription', 'store_preinscription')->name('add-preinscription');
        Route::get('/charge-recette/add-inscription', 'add_inscription')->name('add-inscription');
        Route::post('/charge-recette/add-inscription', 'store_inscription')->name('add-inscription');
        Route::get('/charge-recette/solder-recette-par-composantes', 'show_solder_recette_par_composantes')->name('solder-recette-par-composantes');
        Route::get('/charge-recette/add-recette-inscription', 'add_recette_inscription')->name('add-recette-inscription');
        Route::post('/charge-recette/add-recette-inscription', 'store_recette_inscription')->name('add-recette-inscription');
        Route::get('/charge-recette/add-recette-preinscription', 'add_recette_preinscription')->name('add-recette-preinscription');
        Route::post('/charge-recette/add-recette-preinscription', 'store_recette_preinscription')->name('add-recette-preinscription');



    });

    Route::controller(chargeBudgetController::class)->group(function () {

        Route::get('/charge-budget/evolution-depense-journaliere/', 'evolution_depense_journaliere')->name('evolution-depense-journaliere');
        Route::post('/charge-budget/liste-evolution-depense-journaliere/', 'liste_evolution_depense_journaliere')->name('liste-evolution-depense-journaliere');
        Route::get('/charge-budget/evolution-depense-mensuel/', 'evolution_depense_mensuel')->name('evolution-depense-mensuel');
        Route::post('/charge-budget/liste-evolution-depense-mensuel/', 'liste_evolution_depense_mensuel')->name('liste-evolution-depense-mensuel');
        Route::get('/charge-budget/evolution-depense-annuel/', 'evolution_depense_annuel')->name('evolution-depense-annuel');
        Route::post('/charge-budget/liste-evolution-depense-annuel/', 'liste_evolution_depense_annuel')->name('liste-evolution-depense-annuel');
        Route::get('/charge-budget/liste-depense/', 'liste_depense')->name('liste-depense');
        Route::get('/charge-budget/consolidation-depense/', 'consolidation_depense')->name('consolidation-depense');
        Route::get('/charge-budget/budget-realise/', 'budget_realise')->name('budget_realise');
        Route::post('/charge-budget/detail-budget-realise/', 'detail_budget_realise')->name('detail_budget_realise');
        Route::get('/charge-budget/budget-previsionnel/', 'budget_previsionnel')->name('budget_previsionnel');
        Route::post('/charge-budget/detail-budget-previsionnel/', 'detail_budget_previsionnel')->name('detail_budget_previsionnel');
        Route::get('/charge-budget_composante/detail-budget-previsionnel_composante/', 'detail_budget_previsionnel_composante')->name('detail_budget_previsionnel_composante');
        Route::post('/charge-budget/add-detail-budget-previsionnel', 'add_detail_budget_previsionnel')->name('add-detail_budget_previsionnel');
        Route::get('/charge-budget/budget-global/', 'budget_global')->name('budget_global');
        Route::post('/charge-budget/update_budget/', 'update_budget')->name('update_budget');
    });

    Route::controller(ControleurFinancierController::class)->group(function () {
        Route::get('/controleur-financier/evolution-recette/', 'evolution_recette')->name('controleur_financier_evolution_recette');
        Route::get('/controleur-financier/evolution-depense/', 'evolution_depense')->name('controleur_financier_evolution-depense');
        Route::get('/controleur-financier/grande-consolidation-recette/', 'consolidation_recette')->name('grande_consolidation_recette');
        Route::get('/controleur-financier/grande-consolidation-depense/', 'consolidation_depense')->name('grande_consolidation_depense');
        Route::get('/controleur-financier/annulation-recu', 'annulation_recu')->name('annulation_recu');
        Route::post('/controleur-financier/suppression-recu', 'suppression_recu')->name('suppression_recu');
        Route::post('/controleur-financier/add-suppression-recu', 'add_suppression_recu')->name('add_suppression_recu');

    });

    Route::controller(agentComptableController::class)->group(function () {
        Route::get('/agent-comptable/depense/', 'depense')->name('agent-comptable-depense');
        Route::get('/agent-comptable/virement/', 'virement')->name('agent-comptable-virement');
        Route::post('/agent-comptable/add-virement/', 'add_virement')->name('add_virement');
        Route::get('/agent-comptable/autres-depenses-comptes/', 'frais_des_comptes')->name('autres-depenses-comptes');
        Route::post('/agent-comptable/add-frais-des-comptes/', 'add_frais_des_comptes')->name('add-frais-des-comptes');
        Route::get('/agent-comptable/depenses-salaires/', 'depenses_salaires')->name('depenses-salaires');
        Route::get('/agent-comptable/hologramme/', 'hologramme')->name('hologramme');
        Route::post('/agent-comptable/add_hologramme/', 'add_hologramme')->name('add_hologramme');
        Route::get('/agent-comptable/entree-hologramme/', 'entree_hologramme')->name('entree_hologramme');
        Route::post('/agent-comptable/add_entree_hologramme/', 'add_entree_hologramme')->name('add_entree_hologramme');
        Route::get('/agent-comptable/evolution-recette/', 'evolution_recette')->name('agent-comptable-evolution_recette');
        Route::get('/agent-comptable/evolution-depense/', 'evolution_depense')->name('agent-comptable-evolution-depense');
        Route::get('/agent-comptable/recette-preinscription/', 'recette_preinscription')->name('agent-comptable-recette_preinscription');
        Route::get('/agent-comptable/recette-inscription/', 'recette_inscription')->name('agent-comptable-recette_inscription');
        Route::get('/agent-comptable/evolution-hologramme/', 'evolution_hologramme')->name('evolution_hologramme');
        Route::get('/agent-comptable/solde-composante/', 'solde_composante')->name('solde-composante');
        Route::get('/agent-comptable/solde-compte-principal/', 'solde_compte_principal')->name('solde-compte-principal');
        Route::get('/agent-comptable/add_budget/', 'add_budget')->name('add-budget');
        Route::post('/agent-comptable/add_budget/', 'store_budget')->name('add-budget');
        Route::get('/agent-comptable/detail_budget/', 'detail_budget')->name('detail-budget');
        Route::post('/agent-comptable/liste_detail_budget/', 'liste_budget')->name('liste-detail-budget');
        Route::get('/agent-comptable/hologramme_affecte/', 'hologramme_affecte')->name('hologramme_affecte');
        Route::get('/agent-comptable/autre_recette/', 'autre_recette')->name('autre_recette');
        Route::post('/agent-comptable/autre_recette/', 'store_autre_recette')->name('autre_recette');


    });

    Route::controller(presidentController::class)->group(function () {
        Route::get('president/depense', 'solde_compte')->name('solde');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});

require __DIR__ . '/auth.php';
