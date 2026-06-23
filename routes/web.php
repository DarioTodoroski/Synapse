<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// Add these Facade imports to fix the editor errors
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

// Frontend Controllers
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ApplicationController;

// Models (Used in Admin Closure)
use App\Models\Contact;
use App\Models\Application;
use App\Models\Question;
use App\Models\Event;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

// Home / Events Grid Page 
Route::get('/', [EventController::class, 'index'])->name('events.index');

Route::get('/sitemap.xml', function () {
    $configuredUrl = rtrim((string) config('app.url'), '/');
    $baseUrl = $configuredUrl && ! str_contains($configuredUrl, 'localhost')
        ? $configuredUrl
        : 'https://synapsehr.mk';

    $urls = [
        [
            'loc' => $baseUrl.'/',
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ],
        [
            'loc' => $baseUrl.'/academy',
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ],
    ];

    Event::query()
        ->whereNotNull('slug')
        ->where('slug', '!=', '')
        ->orderBy('id')
        ->get(['slug', 'updated_at'])
        ->each(function (Event $event) use (&$urls, $baseUrl) {
            $urls[] = [
                'loc' => $baseUrl.'/events/'.rawurlencode($event->slug),
                'lastmod' => optional($event->updated_at)->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        });

    $escape = fn ($value) => htmlspecialchars((string) $value, ENT_XML1 | ENT_QUOTES, 'UTF-8');

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

    foreach ($urls as $url) {
        $xml .= "    <url>\n";
        $xml .= '        <loc>'.$escape($url['loc'])."</loc>\n";

        if (! empty($url['lastmod'])) {
            $xml .= '        <lastmod>'.$escape($url['lastmod'])."</lastmod>\n";
        }

        $xml .= '        <changefreq>'.$escape($url['changefreq'])."</changefreq>\n";
        $xml .= '        <priority>'.$escape($url['priority'])."</priority>\n";
        $xml .= "    </url>\n";
    }

    $xml .= '</urlset>'."\n";

    return response($xml, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
});

// Single Event View Page 
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

// Academy Pages & Form Submissions
Route::get('/academy', function () {
    return View::make('academy'); // Changed to View::make
});
Route::post('/academy', [ContactController::class, 'store'])->name('academy.store');
Route::post('/academy/apply', [ApplicationController::class, 'store'])->name('applications.store');

// Questions Form Submission
Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');


/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', function () {
    return View::make('admin.login'); // Changed to View::make
})->name('admin.login');

Route::post('/admin/login', function (Request $request) {
    if ($request->password === env('ADMIN_PASSWORD')) {
        
        Session::put('admin_authenticated', true); // Changed to Session::put

        return Redirect::to('/admin'); // Changed to Redirect::to
    }

    return Redirect::back()->withErrors([ // Changed to Redirect::back
        'password' => 'Incorrect password.'
    ]);
});


/*
|--------------------------------------------------------------------------
| Protected Admin Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::middleware('admin.password')->prefix('admin')->group(function () {

    // Main Dashboard Overview
  Route::get('/', function () {
        $contacts = Contact::latest()->get();
        $applications = Application::latest()->get();
        $questions = Question::latest()->get();
        
        // ADD THIS LINE: Fetch the events
        $events = Event::latest()->get(); 

        // UPDATE THIS LINE: Add 'events' to the compact array
        return View::make('admin.admin', compact('contacts', 'applications', 'questions', 'events'));
    });
    // Custom Admin Event Management
    Route::get('/events', [EventController::class, 'adminIndex'])->name('admin.events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('admin.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('admin.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('admin.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('admin.events.destroy');
    

});
Route::post('/events/{event}/increment-views', [App\Http\Controllers\EventController::class, 'incrementViews'])->name('events.increment-views');
