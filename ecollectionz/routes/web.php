<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@getProfile')->name('profile');
Route::get('/history', 'HomeController@getHistory')->name('history');
Route::get('/feedback', 'HomeController@feedback')->name('feedback');
Route::post('/feedbacksent', 'HomeController@getFeedback')->name('feedback.send');
Route::post('/updateprofile', 'HomeController@updateProfile')->name('profile.update');
Route::get('/policy', 'HomeController@newPolicy')->name('newPolicy');
Route::get('/linked', 'HomeController@linkedAccounts')->name('linked');
Route::get('/linked', 'HomeController@linkedAccounts')->name('linked');
Route::resource('/addpolicy', 'HomeController', ['only' => [ 'store']]);
Route::get('/{id}/policies', ['as' => 'clients.policies', 'uses' => 'HomeController@getPolicies']);
Route::get('lpolicies/{phone}/{id}', ['as' => 'clients.lpolicies', 'uses' => 'HomeController@getLinkedPolicies']);
Route::get('/{rid}/{draft}/DOWNLOAD', ['as' => 'clients.download', 'uses' => 'HomeController@downloadReceipt']);
Route::get('/{id}/checkout', ['as' => 'clients.checkout', 'uses' => 'HomeController@checkOut']);
Route::get('/{id}/checkoutlinked', ['as' => 'clients.checkout_linked', 'uses' => 'HomeController@checkOutLinked']);
Route::get('/{txtIndex}/{signature}/changesignature', ['as' => 'clients.checkoutorder', 'uses' => 'HomeController@checkOutOrderID']);
Route::post('/payment_status', ['as' => 'clients.status_', 'uses' => 'HomeController@paymentStatus']);
Route::post('/order', ['as' => 'clients.order', 'uses' => 'HomeController@paymentStatus']);
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');
Route::get('/getPDF/{id}', ['as' => 'clients.getPDF', 'uses' => 'HomeController@getPDF']);
//notifications
Route::get('/notifications', 'UserNotificationsController@getNotifications')->name('user.notifications');
Route::get('/{id}/read', 'UserNotificationsController@marAsRead')->name('user.markread');

// admin routes  {!! Form::open(['action'=>'HomeController@store', 'method'=>'POST', 'enctype' => 'multipart/form-data']) !!}
Route::prefix('admin')->group(function() {
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/profile', 'AdminController@getProfile')->name('admin.profile');
    Route::post('/updateprofile', 'AdminController@updateProfile')->name('admin.profile.update');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/corporate', 'PagesController@corporate')->name('admin.corporateadmin');
    //feedback
    Route::resource('/feedback', 'Admins\FeedbackController', ['only' => ['index', 'show', 'store', 'edit']]);
    Route::get('/feedback/{id}/read', ['as' => 'admin.feedback.read', 'uses' => 'Admins\FeedbackController@markAsRead']);
    // Reports
    Route::get('/reports', 'Admins\ReportsController@reports')->name('admin.reports');
    //adv
    Route::post('/saveit', 'Admins\AdvController@saveIt')->name('admin.adv.update');
    Route::get('/adv', 'Admins\AdvController@index')->name('admin.adv');
    Route::get('/advanced', 'Admins\ReportsController@advanced')->name('admin.advanced');
    Route::get('/{corp}/{status}/{datetype}/{dates}/getsearch', 'Admins\ReportsController@search')->name('admin.search');

    // CORPORATES ADMIN
    Route::resource('/corporate', 'Admins\AdminCpController', ['only' => ['index', 'show', 'store', 'edit']]);
    Route::post('/corporate/{id}/update', 'Admins\AdminCpController@update')->name('admin.corporate.update'); //this route only for updating the corporate
    Route::get('/corporate/{id}/delete', ['as' => 'admin.corporate.delete', 'uses' => 'Admins\AdminCpController@destroy']);
    Route::get('/corporate/{id}/activate', ['as' => 'admin.corporate.activate', 'uses' => 'Admins\AdminCpController@activate']);
    Route::get('/corporate/{id}/brokers', ['as' => 'admin.corporate.getbrokers', 'uses' => 'Admins\AdminCpController@getBrokers']);
    Route::get('/corporate/{id}/clients', ['as' => 'admin.corporate.getclients', 'uses' => 'Admins\AdminCpController@getClients']);
    Route::get('/corporate/{id}/clientsdata', ['as' => 'admin.corporate.getclientsdata', 'uses' => 'Admins\AdminCpController@getClientsData']);
    Route::get('/corporate/{id}/policies', ['as' => 'admin.corporate.getpolicies', 'uses' => 'Admins\AdminCpController@getPolicies']);
    Route::get('/corporate/{id}/getdatatable', ['as' => 'admin.corporate.datatable', 'uses' => 'Admins\AdminCpController@getdatatable']);
    Route::get('/{id}/status', ['as' => 'admin.getstatus', 'uses' => 'Admins\AdminCpController@getPoliciesByStatus']);
    Route::get('/poli', ['as' => 'admin.poli', 'uses' => 'AdminController@getPoli']);
    Route::get('/poli1', ['as' => 'admin.poli1', 'uses' => 'AdminController@getPoli1']);
    Route::get('/poli2', ['as' => 'admin.poli2', 'uses' => 'AdminController@getPoli2']);

    // BROKERS ADMIN
    Route::get('/brokers/index', 'PagesController@brokers');
    Route::resource('/brokers', 'Admins\AdminBrokersController', ['only' => ['index', 'show', 'store', 'edit']]);
    Route::post('/brokers/{id}/update', 'Admins\AdminBrokersController@update')->name('admin.brokers.update'); //this route only for updating the corporate
    Route::get('/brokers/{id}/delete', ['as' => 'admin.brokers.delete', 'uses' => 'Admins\AdminBrokersController@destroy']);
    Route::get('/brokers/{id}/activate', ['as' => 'admin.brokers.activate', 'uses' => 'Admins\AdminBrokersController@activate']);
    //excel management
    Route::get('/excel', 'Admins\ExcelController@excelView')->name('admin.excel');
    Route::post('downloadExcel/', 'Admins\ExcelController@downloadExcel')->name('admin.export');
    Route::post('importExcel', 'Admins\ExcelController@importExcel');
    //receipts management
    Route::get('/receipts', 'Admins\ReceiptsController@index')->name('admin.receipts');
    //Route::get('/receipts/generate-pdf/{$RID}', ['as' => 'admin.generatepdf', 'uses' => 'Admins\ReceiptsController@generatePDF']);
    Route::get('/getPDF/{id}', ['as' => 'adm.getPDF', 'uses' => 'Admins\ReceiptsController@getPDF']);
    //clients
    Route::resource('/policies_', 'Admins\PoliciesController', ['only' => ['index']]);
    Route::get('/{cust}/getdatatable',['as' => 'adm.getdatatable', 'uses' => 'Admins\PoliciesController@getDatatable']);
    Route::get('/{id}/history', ['as' => 'admin.history', 'uses' => 'Admins\PoliciesController@getHistory']);
    Route::resource('/unrclients', 'Admins\ClientsController', ['only' => ['index']]);
    Route::get('/rclients', ['as' => 'admin.rclients', 'uses' => 'Admins\ClientsController@getUsers']);
    Route::get('/{id}/policy', ['as' => 'adm.policies', 'uses' => 'Admins\PoliciesController@getPoliciesByClient']);
    //policies request
    Route::resource('/p_requests', 'Admins\PRequestsController', ['only' => ['index', 'show', 'store']]);
    Route::get('/{id}/send_to_cp', ['as' => 'admin.sendtocp', 'uses' => 'Admins\PRequestsController@sendToCp']);
    Route::get('/{id}/confirm', ['as' => 'admin.p_confirm', 'uses' => 'Admins\PRequestsController@policyConfirm']);
    Route::get('/{id}/decline', ['as' => 'admin.p_decline', 'uses' => 'Admins\PRequestsController@policyDecline']);

    //notifications
    Route::get('/notifications', 'Admins\NotificationsController@getNotifications')->name('admin.notifications');
    Route::get('{id}/read', 'Admins\NotificationsController@marAsRead')->name('admin.markread');

    //comments
    Route::get('{id}/comments', 'Admins\CommentsController@getComments')->name('admin.comments');
    Route::post('/addreply', ['as' => 'admin.addreply', 'uses' => 'Admins\CommentsController@insertReply']);
    Route::post('{id}/addcomment', ['as' => 'admin.addcomment', 'uses' => 'Admins\CommentsController@addComment']);
});

//Brokers
Route::prefix('brokers')->group(function() {
    Route::get('/login', 'Auth\BrokersLoginController@showLoginForm')->name('brokers.login');
    Route::post('/login', 'Auth\BrokersLoginController@login')->name('brokers.login.submit');
    Route::get('/', 'BrokersController@index')->name('brokers.dashboard');
    Route::post('/logout', 'Auth\BrokersLoginController@logout')->name('brokers.logout');
    Route::get('/clients', 'BrokersController@getClients')->name('brokers.clients');
    Route::get('/{id}/status', ['as' => 'brokers.getstatus', 'uses' => 'BrokersController@getPoliciesByStatus']);
    Route::post('/password/email', 'Auth\BrokerForgotPasswordController@sendResetLinkEmail')->name('broker.password.email');
    Route::get('/password/reset', 'Auth\BrokerForgotPasswordController@showLinkRequestForm')->name('broker.password.request');
    Route::post('/password/reset', 'Auth\BrokerResetPasswordController@reset');
    Route::get('/profile', 'BrokersController@getProfile')->name('brokers.profile');
    Route::post('/updateprofile', 'BrokersController@updateProfile')->name('brokers.profile.update');
    Route::get('/password/reset/{token}', 'Auth\BrokerResetPasswordController@showResetForm')->name('broker.password.reset');
    Route::get('/{id}/policies', ['as' => 'brokers.policies', 'uses' => 'BrokersController@getPoliciesByClient']);
    Route::get('/allpolicies', ['as' => 'brokers.allpolicies', 'uses' => 'BrokersController@getAllPolicies']);
    Route::get('/getdatatable',['as' => 'brokers.getdatatable', 'uses' => 'BrokersController@getDatatable']);
    Route::get('/{id}/history', ['as' => 'brokers.history', 'uses' => 'BrokersController@getHistory']);
    Route::get('/{id}/status', ['as' => 'brokers.getstatus', 'uses' => 'BrokersController@getPoliciesByStatus']);
    Route::get('/{id}/comments', ['as' => 'brokers.comments', 'uses' => 'BrokersController@getComments']);
    Route::post('/addreply', ['as' => 'brokers.addreply', 'uses' => 'BrokersController@insertReply']);
    Route::get('/searchpolicies', ['as' => 'brokers.searchpolicies', 'uses' => 'BrokersController@searchPolicies']);
    Route::get('/getsearch', ['as' => 'brokers.getsearchget', 'uses' => 'BrokersController@searchPolicies']);
    Route::post('/getsearch', ['as' => 'brokers.getsearch', 'uses' => 'BrokersController@getSearchPolicies']);
    Route::post('{id}/addcomment', ['as' => 'brokers.addcomment', 'uses' => 'BrokersController@addComment']);
    Route::get('/requests', 'BrokersController@getRequests')->name('brokers.requests');
    Route::get('/{id}/confirm', ['as' => 'brokerss.p_confirm', 'uses' => 'BrokersController@policyConfirm']);
    Route::get('/{id}/decline', ['as' => 'brokerss.p_decline', 'uses' => 'BrokersController@policyDecline']);
    // reports
    Route::get('/advanced', 'BrokersController@advanced')->name('brokerss.advanced');
    Route::get('/reports', 'BrokersController@reports')->name('brokerss.reports');
    Route::post('/search', 'BrokersController@search');
    //notifications

    Route::get('/notifications', 'BKNotificationsController@getNotifications')->name('brokers.notifications');
    Route::get('{id}/read', 'BKNotificationsController@marAsRead')->name('brokers.markread');
});

//Supervisor
Route::prefix('supervisor')->group(function() {
    Route::get('/login', 'Auth\SupervisorLoginController@showLoginForm')->name('supervisor.login');
    Route::post('/login', 'Auth\SupervisorLoginController@login')->name('supervisor.login.submit');
    Route::get('/', 'SupervisorController@index')->name('supervisor.dashboard');
    Route::post('/logout', 'Auth\SupervisorLoginController@logout')->name('supervisor.logout');
    //notification
    Route::get('/notifications', 'UserNotificationsController@getNotifications')->name('user.notifications');
    Route::get('/{id}/read', 'UserNotificationsController@marAsRead')->name('user.markread');
    Route::post('/password/email', 'Auth\SupervisorForgotPasswordController@sendResetLinkEmail')->name('supervisor.password.email');
    Route::get('/password/reset', 'Auth\SupervisorForgotPasswordController@showLinkRequestForm')->name('supervisor.password.request');
    Route::post('/password/reset', 'Auth\SupervisorResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\SupervisorResetPasswordController@showResetForm')->name('supervisor.password.reset');


});
//corporate
Route::prefix('corporate')->group(function() {
    Route::get('/login', 'Auth\CorporateLoginController@showLoginForm')->name('corporate.login');
    Route::post('/login', 'Auth\CorporateLoginController@login')->name('corporate.login.submit');
    Route::get('/', 'CorporateController@index')->name('corporates.dashboard');
    Route::get('/profile', 'CorporateController@getProfile')->name('corporates.profile');
    Route::post('/updateprofile', 'CorporateController@updateProfile')->name('corporates.profile.update');
    Route::get('/clients', 'CorporateController@getClients')->name('corporates.clients');
    Route::post('/logout', 'Auth\CorporateLoginController@logout')->name('corporate.logout');
    Route::get('/{id}/policies', ['as' => 'corporate.policies', 'uses' => 'CorporateController@getPoliciesByClient']);
    Route::get('/allpolicies', ['as' => 'corporate.allpolicies', 'uses' => 'CorporateController@getAllPolicies']);
    Route::get('/getdatatable',['as' => 'corp.getdatatable', 'uses' => 'CorporateController@getDatatable']);
    Route::get('/{id}/history', ['as' => 'corp.history', 'uses' => 'CorporateController@getHistory']);
    Route::get('/{id}/status', ['as' => 'corporate.getstatus', 'uses' => 'CorporateController@getPoliciesByStatus']);
    Route::get('/{id}/comments', ['as' => 'corporate.comments', 'uses' => 'CorporateController@getComments']);
    Route::post('/addreply', ['as' => 'corporate.addreply', 'uses' => 'CorporateController@insertReply']);
    Route::get('/searchpolicies', ['as' => 'corporate.searchpolicies', 'uses' => 'CorporateController@searchPolicies']);
    Route::get('/getsearch', ['as' => 'corporate.getsearchget', 'uses' => 'CorporateController@searchPolicies']);
    Route::post('/getsearch', ['as' => 'corporate.getsearch', 'uses' => 'CorporateController@getSearchPolicies']);
    Route::post('{id}/addcomment', ['as' => 'corporate.addcomment', 'uses' => 'CorporateController@addComment']);
    Route::get('/requests', 'CorporateController@getRequests')->name('corporates.requests');
    Route::get('/{id}/confirm', ['as' => 'corporates.p_confirm', 'uses' => 'CorporateController@policyConfirm']);
    Route::get('/{id}/decline', ['as' => 'corporates.p_decline', 'uses' => 'CorporateController@policyDecline']);
    // reports
    Route::get('/advanced', 'CorporateController@advanced')->name('corporates.advanced');
    Route::get('/reports', 'CorporateController@reports')->name('corporates.reports');
    Route::post('/search', 'CorporateController@search');

//notifications
    Route::get('/notifications', 'CPNotificationsController@getNotifications')->name('user.notifications');
    Route::get('/{id}/read', 'CPNotificationsController@marAsRead')->name('user.markread');
    Route::post('/password/email', 'Auth\CorporateForgotPasswordController@sendResetLinkEmail')->name('corporate.password.email');
    Route::get('/password/reset', 'Auth\CorporateForgotPasswordController@showLinkRequestForm')->name('corporate.password.request');
    Route::post('/password/reset', 'Auth\CorporateResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\CorporateResetPasswordController@showResetForm')->name('corporate.password.reset');

    
});



Route::get('/verify', 'VerifyController@getVerify')->name('getVerify');
Route::post('/verify', 'VerifyController@postVerify')->name('verify');
Route::get('{phone}/resendcode', 'VerifyController@resendCode')->name('resendverify');

//Route::get('email', 'EmailRegController@sendEmail');
