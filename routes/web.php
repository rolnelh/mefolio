<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CreatifController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\TalentOfTheWeekController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\CreatifController as AdminCreatifController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\MissionController as AdminMissionController;
use App\Http\Controllers\Admin\ChallengeController as AdminChallengeController;
use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\SpotlightController as AdminSpotlightController;
use App\Http\Controllers\Admin\TalentNominationController as AdminTalentNominationController;
use App\Http\Controllers\Admin\NewsletterController as AdminNewsletterController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\AIAssistantController;

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

Route::get('/langue/{locale}', function (string $locale) {
    if (in_array($locale, \App\Http\Middleware\SetLocale::AVAILABLE_LOCALES, true)) {
        session(['locale' => $locale]);
    }

    return back();
})->name('locale.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/payment-methods', [ProfileController::class, 'updatePaymentMethods'])->name('profile.payment-methods.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::get('/projets/creer', [ProjectController::class, 'create'])->name('projets.create');
    Route::post('/projets', [ProjectController::class, 'store'])->name('projets.store');
    Route::get('/projets/{project}/edit', [ProjectController::class, 'edit'])->name('projets.edit');
    Route::put('/projets/{project}', [ProjectController::class, 'update'])->name('projets.update');
    Route::delete('/projets/{project}', [ProjectController::class, 'destroy'])->name('projets.destroy');

    Route::post('/projects/{project}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/projects/{project}/comments/ajax', [CommentController::class, 'storeAjax'])->name('comments.store.ajax');
    Route::post('/projects/{project}/like', [ProjectController::class, 'toggleLike'])->name('projects.like');

    Route::post('/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user:username}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user:username}', [MessageController::class, 'store'])->name('messages.store');

    Route::post('/dashboard/assistant', [AIAssistantController::class, 'chat'])
        ->middleware('throttle:15,1')
        ->name('assistant.chat');
});

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/creatifs/create', [CreatifController::class, 'create'])->name('creatifs.create');
    Route::post('/creatifs', [CreatifController::class, 'store'])->name('creatifs.store');
    Route::get('/creatifs/edit', [CreatifController::class, 'edit'])->name('creatifs.edit');
    Route::put('/creatifs/update', [CreatifController::class, 'update'])->name('creatifs.update');
    Route::put('/creatifs/pause', [CreatifController::class, 'togglePause'])->name('creatifs.pause');
});

Route::get('/creatifs', [CreatifController::class, 'index'])->name('creatifs.index');
Route::get('/creatifs/localisation', function () {
    return view('coming-soon', [
        'page' => __('Talents par localisation'),
        'description' => __('Trouvez des talents créatifs près de chez vous au Bénin et en Afrique.'),
    ]);
})->name('creatifs.localisation');
Route::get('/creatifs/domaine', function () {
    return view('coming-soon', [
        'page' => __('Talents par domaine'),
        'description' => __('Design, Développement, Photographie, Vidéo : trouvez le bon profil.'),
    ]);
})->name('creatifs.domaine');
Route::get('/creatifs/{slug}', [CreatifController::class, 'show'])->name('creatifs.show');

Route::get('blog', [PostController::class, 'index'])->name('blog');
Route::get('blog/{post}', [PostController::class, 'show'])->name('blog.show');

Route::get('/classement', [ClassementController::class, 'index'])->name('classement.index');

Route::get('/talentoftheweek', [TalentOfTheWeekController::class, 'index'])->name('talentoftheweek.index');
Route::middleware('auth')->post('/talentoftheweek/nominer', [TalentOfTheWeekController::class, 'nominate'])->name('talentoftheweek.nominate');

Route::get('/missions', [MissionController::class, 'index'])->name('missions.index');
Route::middleware(['auth'])->group(function () {
    Route::get('/missions/creer', [MissionController::class, 'create'])->name('missions.create');
    Route::post('/missions', [MissionController::class, 'store'])->name('missions.store');
    Route::get('/missions/mes-missions', [MissionController::class, 'mine'])->name('missions.mine');
    Route::get('/missions/{mission}/edit', [MissionController::class, 'edit'])->name('missions.edit');
    Route::put('/missions/{mission}', [MissionController::class, 'update'])->name('missions.update');
    Route::delete('/missions/{mission}', [MissionController::class, 'destroy'])->name('missions.destroy');
    Route::post('/missions/{mission}/postuler', [MissionController::class, 'apply'])->name('missions.apply');
    Route::put('/missions/{mission}/candidatures/{application}', [MissionController::class, 'updateApplicationStatus'])->name('missions.applications.update');
});
Route::get('/missions/{mission}', [MissionController::class, 'show'])->name('missions.show');

Route::get('/challenges', [ChallengeController::class, 'index'])->name('challenges.index');
Route::get('/challenges/{challenge}', [ChallengeController::class, 'show'])->name('challenges.show');
Route::middleware('auth')->post('/challenges/{challenge}/participer', [ChallengeController::class, 'participate'])->name('challenges.participate');

Route::get('/hackathons', [ProgramController::class, 'index'])->name('hackathons.index');

Route::get('/services', function () {
    return view('services.index', [
        'page' => 'Services',
        'description' => 'Commandez des services créatifs directement aux talents africains.',
    ]);
})->name('services.index');

/*
|--------------------------------------------------------------------------
| Espace administrateur
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role');
    Route::put('/users/{user}/ban', [AdminUserController::class, 'toggleBan'])->name('users.ban');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

    Route::get('/projects', [AdminProjectController::class, 'index'])->name('projects.index');
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/creatifs', [AdminCreatifController::class, 'index'])->name('creatifs.index');
    Route::delete('/creatifs/{creatif}', [AdminCreatifController::class, 'destroy'])->name('creatifs.destroy');

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');

    Route::resource('posts', AdminPostController::class)->except(['show']);

    Route::get('/missions', [AdminMissionController::class, 'index'])->name('missions.index');
    Route::put('/missions/{mission}/status', [AdminMissionController::class, 'updateStatus'])->name('missions.status');
    Route::delete('/missions/{mission}', [AdminMissionController::class, 'destroy'])->name('missions.destroy');

    Route::resource('challenges', AdminChallengeController::class)->except(['show']);
    Route::resource('programs', AdminProgramController::class)->except(['show']);

    Route::get('/spotlights', [AdminSpotlightController::class, 'index'])->name('spotlights.index');
    Route::post('/spotlights', [AdminSpotlightController::class, 'store'])->name('spotlights.store');
    Route::put('/spotlights/{spotlight}/current', [AdminSpotlightController::class, 'setCurrent'])->name('spotlights.current');
    Route::delete('/spotlights/{spotlight}', [AdminSpotlightController::class, 'destroy'])->name('spotlights.destroy');

    Route::get('/nominations', [AdminTalentNominationController::class, 'index'])->name('nominations.index');
    Route::put('/nominations/{nomination}/status', [AdminTalentNominationController::class, 'updateStatus'])->name('nominations.status');
    Route::delete('/nominations/{nomination}', [AdminTalentNominationController::class, 'destroy'])->name('nominations.destroy');

    Route::get('/newsletter', [AdminNewsletterController::class, 'index'])->name('newsletter.index');
    Route::delete('/newsletter/{subscriber}', [AdminNewsletterController::class, 'destroy'])->name('newsletter.destroy');

    Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
});

require __DIR__.'/auth.php';
