<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\SupportAgentController;
use App\Http\Controllers\FAQController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
Route::get('/faq/create', [FAQController::class, 'create'])->name('faq.create');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tickets/new', [HomeController::class, 'new'])->name('new');

Route::get('/ticket/search', [TicketController::class, 'search'])->name('search');
Route::get('/tickets/agent', [TicketController::class, 'agentIndex'])->name('agentIndex');
Route::get('/tickets/answered', [TicketController::class, 'answeredIndex'])->name('answeredIndex');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::post('/tickets/new', [TicketController::class, 'store'])->name('tickets.new');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('ticket.update');
Route::put('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('ticket.updateStatus');


Route::post('/tickets/{ticket}/comments', [CommentsController::class, 'store'])->name('comments.store');
Route::get('/comments/{comment}', [CommentsController::class, 'show'])->name('comments.show');

Route::get('/access', [AccessController::class, 'index'])->name('access');
Route::get('/access/access_level', [AccessController::class, 'accessLevel'])->name('access.access_level');
Route::put('/access/{id}/update_access_level', [AccessController::class, 'updateAccessLevel'])->name('access.update_access_level');
Route::get('/access/search', [AccessController::class, 'search'])->name('access.search');

Route::get('/open', [SupportAgentController::class, 'index'])->name('support_agent.index');
Route::get('/open/{ticket}', [SupportAgentController::class, 'show'])->name('support_agent.show');
Route::put('/open/{ticket}', [SupportAgentController::class, 'update'])->name('support_agent.update');

Route::get('/faq/{block}', [FAQController::class, 'show'])->name('faq.show');
Route::get('/faq/{block}/edit', [FAQController::class, 'edit'])->name('faq.edit');
Route::get('/faq/{block}/{section}', [FAQController::class, 'section'])->name('faq.section');
Route::post('/faq', [FAQController::class, 'store'])->name('faq.store');
Route::put('/faq/{block}', [FAQController::class, 'update'])->name('faq.update');
Route::delete('/faq/{block}', [FAQController::class, 'destroy'])->name('faq.destroy');
Route::post('/faq/{block}/section', [FAQController::class, 'addSection'])->name('faq.section.add');
Route::get('faq/{block}/{section}/edit', [FAQController::class,'editSection'])->name('faq.section.edit');
Route::put('/faq/{block}/{section}/edit', [FAQController::class, 'updateSection'])->name('faq.section.update');
Route::get('/faq/{block}/section/create', [FAQController::class, 'createSection'])->name('faq.create_section');
Route::delete('/faq/{block}/{section}/edit', [FAQController::class, 'deleteSection'])->name('faq.section.delete');
