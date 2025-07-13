<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\TreinoController;
use App\Http\Controllers\DietaController;
use App\Http\Controllers\EvolucaoController;
use App\Http\Controllers\MensalidadeController;



    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/pagamento/pix/{id}', [PagamentoController::class, 'gerarPix'])->name('pagamentos.pix');
    Route::post('/pagamento/confirmar/{id}', [PagamentoController::class, 'confirmar'])->name('pagamentos.confirmar');
    Route::get('/recibo/{id}', [ReciboController::class, 'gerar'])->name('recibos.gerar');
    Route::post('/presenca/entrada/{aluno_id}', [PresencaController::class, 'registrarEntrada'])->name('presenca.entrada');
    Route::post('/presenca/saida/{aluno_id}', [PresencaController::class, 'registrarSaida'])->name('presenca.saida');
    Route::get('/presenca/historico/{aluno_id}', [PresencaController::class, 'historico'])->name('presenca.historico');
    Route::get('/pagamentos/pixmanual', [PixController::class, 'gerarPix']);
    Route::middleware(['auth'])->group(function () {
    Route::get('/mensalidades', [MensalidadeController::class, 'index'])->name('mensalidades.index');
    Route::get('/mensalidades/create', [MensalidadeController::class, 'create'])->name('mensalidades.create');
    Route::post('/mensalidades/store', [MensalidadeController::class, 'store'])->name('mensalidades.store');
    Route::post('/mensalidades/{id}/pagar', [MensalidadeController::class, 'pagar'])->name('mensalidades.pagar');
});


Route::get('/evolucoes', [EvolucaoController::class, 'index'])->name('evolucoes.index');
Route::get('/evolucoes/create', [EvolucaoController::class, 'create'])->name('evolucoes.create');
Route::post('/evolucoes', [EvolucaoController::class, 'store'])->name('evolucoes.store');


Route::get('/dietas', [DietaController::class, 'index'])->name('dietas.index');
Route::get('/dietas/create', [DietaController::class, 'create'])->name('dietas.create');
Route::post('/dietas', [DietaController::class, 'store'])->name('dietas.store');

Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/treinos', [TreinoController::class, 'index'])->name('treinos.index');
Route::get('/treinos/create', [TreinoController::class, 'create'])->name('treinos.create');
Route::post('/treinos', [TreinoController::class, 'store'])->name('treinos.store');

require __DIR__ . '/auth.php';
