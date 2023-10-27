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

use Illuminate\Support\Facades\Artisan;

Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('add-to-log', 'HomeController@myTestAddToLog');

Route::get('logActivity', 'HomeController@logActivity');
//تالار گفتمان
Route::get('/challenge/create', 'ChallengeController@create');
Route::post('/challenge/store', 'ChallengeController@store');
Route::get('/challenge/show', 'ChallengeController@show')->name('challenge.show');
Route::any('/challenge/changStatus', 'ChallengeController@changeStatus');
Route::get('/challenge/delete/{id}', 'ChallengeController@destroy');


Route::get('/Answer/store', 'AnswerController@store');
Route::any('/Answer/changStatus', 'AnswerController@changStatus');
Route::get('/PAnswer/store', 'PAnswerController@store');
Route::any('/PAnswer/changStatus', 'PAnswerController@changStatus');
// پایان تالار گفتمان

//Auth
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login')->middleware('newMiddleware');
Route::post('login', 'Auth\LoginController@login')->middleware('newMiddleware');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register')->middleware('newMiddleware');
Route::post('register', 'Auth\RegisterController@register')->middleware('newMiddleware');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::group(['prefix' => '/', 'namespace' => 'Auth'], function () {
    Route::get('/password/forgot', 'PasswordController@index');
    Route::post('/password/forgot', 'PasswordController@checkMobile');
    Route::get('/password/forgot/phone', 'PasswordController@verify');
    Route::get('/password/forgot/again', 'PasswordController@againSmsVerify');
    Route::post('/password/forgot/verify', 'PasswordController@check');
    Route::get('/password/resets', 'PasswordController@reset');
    Route::post('/password/resets', 'PasswordController@resetPassword');
});
//end Auth

// home
Route::get('/', 'HomeController@index')->name('home')->middleware('newMiddleware');
Route::get('/view/{place}', 'HomeController@view');
Route::get('/single', 'HomeController@single');
Route::get('/blogs', 'HomeController@blogs')->name('blogs');
Route::get('/blogs/create', 'HomeController@blogscreate');
Route::post('/blogs/store', 'HomeController@blogsstore');
Route::get('/blogs/single/{id}', 'HomeController@blogssingle')->name('single.blog');
Route::get('/blogs/like/{id}', 'HomeController@blogslike');
Route::get('/question', 'HomeController@question')->name('question');
Route::get('/question/create', 'HomeController@questioncreate');
Route::post('/question/store', 'HomeController@questionstore');
Route::get('/question/single/{id}', 'HomeController@questionsingle');

Route::get('/single/{id}', 'HomeController@single');
Route::get('/view/tag/{id}', 'HomeController@viewtag');
Route::get('/view/all/protfolio', 'HomeController@viewprotfolio');
Route::get('/view/all/recent', 'HomeController@viewrecent');
Route::get('/view/all/service', 'HomeController@viewservice');
Route::get('/view/all/consultants', 'HomeController@viewconsultants');
Route::get('/view/all/service2', 'HomeController@viewservice2');
Route::get('/view/all/consultants2', 'HomeController@viewconsultants2');
Route::post('/rtamas', 'HomeController@rtamas');
Route::any('/search', 'HomeController@search');
Route::get('/phoneme', 'HomeController@phoneme');
Route::get('/pre-registration', 'HomeController@pre_registration');
Route::post('/registration/school', 'HomeController@registration');
Route::get('/manage', 'HomeController@manage');
Route::get('/about_us', 'HomeController@about_us');
//end home

//comment
//comment
Route::post('/comment/store/{id}', 'CommentController@store');
Route::post('/pcomment/store/{matlabid}/{commentid}', 'CommentController@pstore');
Route::any('admin/comment/changeStatus', 'CommentController@changeStatus');
Route::any('admin/pcomment/changeStatus', 'CommentController@pchangeStatus');

Route::get('/home', 'HomeController@login')->name('home');


// routs for download from questions table
Route::get('question/save/{id}', [
    'as' => 'question.download', 'uses' => 'TestController@questiondownloadImage']);
Route::resource('books', 'TestController');
//End routs for download from questions table

// routs for download from film table
Route::get('film/save/{id}', [
    'as' => 'film.download', 'uses' => 'TestController@film']);
Route::resource('film', 'TestController');
$this::get('film/count/{id}', 'FilmController@count');

$this::get('myfilm/{id}', 'FilmController@index');
//End routs for download from film table

// routs for download from Tamrin table
Route::get('books/save/{id}', [
    'as' => 'books.download', 'uses' => 'TestController@tamrindownloadImage']);
Route::resource('books', 'TestController');
Route::get('jtamrinteacher/save/{id}', [
    'as' => 'jtamrinteacher.download', 'uses' => 'TestController@jtamrinteacher']);
Route::resource('books', 'TestController');
//End routs for download from Tamrin table

// routs for download from JTamrin table
Route::get('jtamrin/save/{id}', [
    'as' => 'jtamrin.download', 'uses' => 'TestController@jtamrindownloadImage']);
Route::resource('books', 'TestController');
//End routs for download from JTamrin table

// routs for download from MAIl table
Route::get('mail/save/{id}', [
    'as' => 'mail.download', 'uses' => 'TestController@mail']);
Route::resource('books', 'TestController');
Route::get('mailmodel/save/{id}', [
    'as' => 'mailmodel.download', 'uses' => 'TestController@mailmodel']);
Route::resource('books', 'TestController');
//end routs for download from MAIl table

// routs for download from barname table
Route::get('barname/save/{id}', [
    'as' => 'barname.download', 'uses' => 'TestController@barname']);
Route::resource('books', 'TestController');
//end // routs for download from barname table

// routs for download from barname table student
Route::get('barnamedars/save/{idc}', [
    'as' => 'barnamedars.download', 'uses' => 'TestController@barnamedars']);
Route::resource('books', 'TestController');

Route::get('barnameemtehan/save/{idc}', [
    'as' => 'barnameemtehan.download', 'uses' => 'TestController@barnameemtehan']);
Route::resource('books', 'TestController');

Route::get('barnamedarsmoshaver/save/{idc}', [
    'as' => 'barname.moshaver.download', 'uses' => 'TestController@barnamemoshaver']);
Route::resource('books', 'TestController');

Route::get('class/save/{idc}', [
    'as' => 'class.download', 'uses' => 'TestController@class']);
Route::resource('books', 'TestController');
//end routs for download from barname table student

Route::get('exam/save/{id}', ['as' => 'exam.download', 'uses' => 'TestController@exam']);
Route::get('exam_question/save/{idc}', ['as' => 'exam_question.download', 'uses' => 'TestController@exam_question']);
Route::get('exam_answer/save/{idc}', ['as' => 'exam_answer.download', 'uses' => 'TestController@exam_answer']);


//profile
$this::resource('profile', 'ProfileController')->middleware('ExpireCheck');
$this::put('profile/update/{id}', 'ProfileController@update');
$this::any('profile/times/{id}', 'ProfileController@times');
$this::any('profile/updatepassword/{id}', 'ProfileController@updatepassword');
//end profile

//routs for Students

Route::get('finance/save/{id}', [
    'as' => 'finance.download', 'uses' => 'TestController@finance']);
Route::resource('books', 'TestController');

$this::get('/online/records/{id}', 'FilmController@recordOnlineList');

//    بخش مالی
$this::get('/student/finance', 'student\FinanceController@index');
$this::post('/student/finance/upload', 'student\FinanceController@upload');
$this::post('/student/finance/finance/online', 'student\FinanceController@pay');

Route::group(['prefix' => 'student', 'middleware' => ['ExpireCheck', 'StatusCheck', 'FinanceCheck'], 'namespace' => 'student'], function () {


    $this::get('/pattern', 'PatternController@index');
    $this::get('/pattern/doros/{id}', 'PatternController@doros');
    $this::get('/pattern/date/{id}', 'PatternController@date');
    $this->post('/pattern/sabt', 'PatternController@sabt');
    $this->post('/pattern/sabt/dars', 'PatternController@sabtDars');


    $this::get('/online/join/{id}', 'OnlineClassController@join');
    $this::get('/online/index', 'OnlineClassController@index');
    $this::get('/online/record/{id}', 'OnlineClassController@record');


    $this::get('/dars/{id}', 'StudentsController@dars');

//    انتخابات
    $this::get('/selection', 'SelectionController@index');
    $this::get('/selection/past', 'SelectionController@past');
    $this::get('/selection/sabt/{id}', 'SelectionController@sabt');
    $this::post('/selection/store', 'SelectionController@store');
    $this::get('/selection/view/{id}', 'SelectionController@view');


//    برنامه کلاسی
    $this::get('tagvim', 'StudentsController@tagvim');


//    مشاوره
    $this->get('moshaver', 'MoshaverController@index');
    $this->get('moshaver/detail/{id}', 'MoshaverController@detail');
    $this->get('moshaver/barname', 'MoshaverController@barname');
    $this::get('moshaver/records/{id}', 'MoshaverController@record');
    $this::get('moshaver/join/{id}', 'MoshaverController@join');
//
//    آزمون آنلاین
    $this->get('exam', 'ExamController@index');
    $this->get('finish/{id}', 'ExamController@finish');
    $this->get('takeexam/{id}', 'ExamController@takeexam');
    $this->get('/exam/view/{id}', 'ExamController@view');
    $this->POST('exam/tik', 'ExamController@tik');
    $this->post('exam/descriptive/answer', 'ExamController@answerDescriptive');


//    end

    //شهریه
    $this->get('tuition', 'TuitionController@index');
    $this->post('tuition', 'TuitionController@store');
//end
//    library
    $this::get('library/school', 'LibraryController@index');
    $this::get('library/mybook', 'LibraryController@mybook');
    $this::post('library/reservation', 'LibraryController@reservation');
    $this::get('library/myreserve', 'LibraryController@myreserve');
    $this::get('/library/cancelreserve/{id}', 'LibraryController@cancelreserve');

//    end library

//    discipline
    $this::get('discipline', 'StudentsController@discipline');
    $this::get('rollcall', 'StudentsController@rollcall');
    $this::post('absent/description/{id}', 'StudentsController@rollcall_description');
//    end discipline

    //karname
    $this::get('karname', 'StudentsController@karname');
    $this::get('karname/month', 'StudentsController@karnamemonth');
    $this::post('/karnameh/render/month', 'StudentsController@karnamemonthrender');
    $this::get('karname/school/{id}', 'StudentsController@karnameschool');
    $this::get('newkarname/school/{name}/{user}', 'StudentsController@newkarnameschool');
    //end karname

    $this::get('', 'StudentsController@index')->name('student');
    $this::get('mark{id}', 'StudentsController@mark');
    $this::get('tamrininbox', 'JTamrinController@inbox');
    $this::get('jtamrin{idt}', 'JTamrinController@create');
    $this::get('jtamrin/edit/{idt}', 'JTamrinController@edit');
    $this::POST('jtamrin.store{idt}', 'JTamrinController@store');
    $this::get('tamrinoutbox', 'JTamrinController@outbox');
    $this::any('jtamrin/delete/{id}', 'JTamrinController@delete');


//creat student-table
    $this::post('studenttable', 'StudentsController@store');
    $this::post('studenttableedit', 'StudentsController@edite');
    $this::get('studenttabledelete', 'StudentsController@delete');
//end creat student-table


//    chart for student
    $this::get('chartsahm', 'ChartController@sahm');
    $this::get('charttamrin', 'ChartController@tamrin');
    $this::get('chartmark', 'ChartController@mark');
    $this::post('chartmarkrender', 'ChartController@markrender');
    $this::get('chartmarks{id}', 'ChartController@marks');
    $this::get('moadel', 'ChartController@moadel');
    $this::get('dars', 'ChartController@dars');
//    end chart for student
});
// end routs for Students


//route for Admin

Route::group(['prefix' => 'admin', 'middleware' => ['ExpireCheck', 'StatusCheck'], 'namespace' => 'admin'], function () {

    $this::get('present_list', 'AdminController@present_list');

    $this::post('change_password', 'AdminController@change_password');
    $this::get('roolcall_report', 'AdminController@roolcall_report');
    $this::get('disiplin_report', 'AdminController@disiplin_report');


    $this::get('createmarkshow/{idc}/{idd}', 'MarkController@create');
    $this::any('createmark', 'MarkController@store');
    $this::get('viewmark/{idc}/{idd}', 'MarkController@viewmark');
    $this::get('markdelet/{id}', 'MarkController@markdelet');
    $this::any('editeemark/{id}', 'MarkController@editeemark');


    $this::get('mark/date/{idc}/{idd}', 'MarkController@date');
    $this::post('mark/date', 'MarkController@datemark');
    $this::post('mark/storedate', 'MarkController@storedate');
    $this::get('mark/{idc}/{idd}', 'MarkController@index')->name('teacher.mark');
    $this::post('mark/edit/{id}', 'MarkController@edit');

    $this::get('/maghta', 'maghtaController@index');
    $this::post('maghta/store', 'maghtaController@store');
    $this::any('maghta/destroy/{id}', 'maghtaController@destroy');


    $this::post('get-dars-by-class', 'TeacherController@getDars');

        $this::get('/pattern', 'PatternController@index');
    $this::get('/pattern/create', 'PatternController@create');
    $this::post('/pattern/store', 'PatternController@store');
    $this::get('/pattern/doros/{id}', 'PatternController@doros');
    $this::post('/pattern/doros/store', 'PatternController@dorosStore');
    $this::get('/pattern/edit/{id}', 'PatternController@edit');
    $this::post('/pattern/update/{id}', 'PatternController@update');
    $this::post('/pattern/changeStatus', 'PatternController@changeStatus');
    $this->get('/pattern/destroy/{id}', 'PatternController@destroy');
    $this->get('/pattern/report/dailyReport', 'PatternController@dailyReport');
    $this->post('/pattern/report/daily', 'PatternController@daily');
    $this->get('/pattern/report/monthReport', 'PatternController@monthReport');
    $this->post('/pattern/report/month', 'PatternController@month');

    $this::get('/online/{id}', 'OnlineClassController@index')->name('online_class_admin')->middleware('can:online');
    $this::get('/online_class/create', 'OnlineClassController@create')->middleware('can:online');
    $this::post('/online/store', 'OnlineClassController@store')->middleware('can:online');
    $this::get('/online/edit/{id}', 'OnlineClassController@edit')->middleware('can:online');
    $this::get('/online/update/{id}', 'OnlineClassController@update')->middleware('can:online');
    $this::any('online/Delete/{id}', 'OnlineClassController@delete')->middleware('can:online');
    $this::get('/online/join/{id}', 'OnlineClassController@join');
    $this::get('/online/list/{id}', 'OnlineClassController@listGroup');
    $this::get('/online/list/{id}/{version}', 'OnlineClassController@list');
    $this::get('/online/record/{id}', 'OnlineClassController@record');
    $this::get('/online/blockList/{id}', 'OnlineClassController@blockList');
    $this::any('/online/blockListStudent', 'OnlineClassController@blockListStore');

    $this::get('/setting', 'AdminController@setting');
    $this::post('/setting/store', 'AdminController@settingstore');
    $this::post('/setting/name/store', 'AdminController@settingstorename');

//    همایش و رویداد ها
    $this::resource('/hamayesh', 'HamayeshController');
    $this::any('/hamayesh/update/{id}', 'HamayeshController@update');
    $this::any('/hamayesh/delete/{id}', 'HamayeshController@delete');
    $this::any('/hamayesh/list/{id}', 'HamayeshController@list');
//    $this::get('/hamayesh/create', 'HamayeshController@create');
//    $this::post('/hamayesh/store', 'HamayeshController@store');
//    $this::any('/hamayesh/changeStatus', 'HamayeshController@changeStatus');
//    $this::any('/hamayesh/delete', 'HamayeshController@delete');
//    $this::get('/hamayesh/edit', 'HamayeshController@edit');
//    $this::any('/hamayesh/update', 'HamayeshController@update');

//    $this::get('/hamayesh', 'HamayeshController@index')->middleware('can:hamayesh');
//    $this::get('/hamayesh/create', 'HamayeshController@create')->middleware('can:hamayesh');
//    $this::post('/hamayesh/store', 'HamayeshController@store')->middleware('can:hamayesh');
//    $this::get('/hamayesh/option', 'HamayeshController@option')->middleware('can:hamayesh');
//    $this::get('/hamayesh/option/view', 'HamayeshController@view')->middleware('can:hamayesh');
//    $this::post('/hamayesh/optionstore', 'HamayeshController@optionstore')->middleware('can:hamayesh');
//    $this::any('/hamayesh/optiondelete', 'HamayeshController@optiondelete')->middleware('can:hamayesh');
//    $this::any('/hamayesh/changeStatus', 'HamayeshController@changeStatus')->middleware('can:hamayesh');
//    $this::any('/hamayesh/delete', 'HamayeshController@delete')->middleware('can:hamayesh');
//    $this::get('/hamayesh/edit', 'HamayeshController@edit')->middleware('can:hamayesh');
//    $this::any('/hamayesh/update', 'HamayeshController@update')->middleware('can:hamayesh');

//    انتخابات و نظر سنجی
    $this::get('/selection/{id}', 'SelectionController@index')->middleware('can:selection');
    $this::get('/selection/create/{id}', 'SelectionController@create')->middleware('can:selection');
    $this::post('/selection/store', 'SelectionController@store')->middleware('can:selection');
    $this::get('/selection/option/{id}', 'SelectionController@option')->middleware('can:selection');
    $this::get('/selection/option/view/{id}', 'SelectionController@view')->middleware('can:selection');
    $this::post('/selection/optionstore', 'SelectionController@optionstore')->middleware('can:selection');
    $this::any('/selection/optiondelete/{id}', 'SelectionController@optiondelete')->middleware('can:selection');
    $this::any('/selection/changeStatus', 'SelectionController@changeStatus')->middleware('can:selection');
    $this::any('/selection/delete/{id}', 'SelectionController@delete')->middleware('can:selection');
    $this::get('/selection/edit/{id}', 'SelectionController@edit')->middleware('can:selection');
    $this::any('/selection/update/{id}', 'SelectionController@update')->middleware('can:selection');
    $this::get('/selection/result/{id}', 'SelectionController@result')->middleware('can:selection');


//    بخش مالی
    $this::get('/finance/{id}', 'FinanceController@index')->middleware('can:finance');
    $this::any('/finance/edit/{id}', 'FinanceController@edit')->middleware('can:finance');
    $this::any('/changeStatus/finance', 'FinanceController@changeStatus')->middleware('can:finance');
    $this::get('/paid', 'FinanceController@paid')->middleware('can:finance');
    $this::get('/fish', 'FinanceController@fish')->middleware('can:finance');
    $this::any('/finance/fish/edit/{id}', 'FinanceController@fishedit')->middleware('can:finance');
    $this::any('/finance/group/create', 'FinanceController@group')->middleware('can:finance');
    $this::post('/finance/upload', 'FinanceController@upload');

    $this::get('/finance/downloadExcel/{type}', 'FinanceController@downloadExcel')->middleware('can:finance');

    $this::get('/fish', 'FinanceController@fish')->middleware('can:finance');
    $this::get('/cheque', 'FinanceController@cheque')->middleware('can:finance');
    $this::post('/store/cheque_cash', 'FinanceController@cheque_cash')->middleware('can:finance');
    $this::any('/delete/cheque_cash/{id}', 'FinanceController@delete_cheque_cash')->middleware('can:finance');


//  قسمت بندی فیلم ها
    $this::get('filmsection', 'FilmSectionController@index');
    $this::any('filmsection/delete/{id}', 'FilmSectionController@delete');
    $this::post('section', 'FilmSectionController@section');
    $this::post('bakhsh', 'FilmSectionController@bakhsh');


//    برنامه هفتگی

    $this::get('tagvim/time', 'TagvimController@time');
    $this::any('tagvim/time/edit/{id}', 'TagvimController@timeedit');
    $this::post('tagvim/time/store', 'TagvimController@timestore');
    $this::any('tagvim/time/delete/{id}', 'TagvimController@timedelete');
    $this::get('tagvim/student', 'TagvimController@student');
    $this::post('tagvim/student/store', 'TagvimController@studentstore');
    $this::any('tagvim/student/delete/{id}', 'TagvimController@studentdelete');
    $this::any('tagvim/student/edit/{id}', 'TagvimController@studentedit');
    $this::any('tagvim/teacher/edit/{id}', 'TagvimController@teacheredit');
    $this::get('tagvim/teacher', 'TagvimController@teacher');
    $this::post('tagvim/teacher/store', 'TagvimController@teacherstore');
    $this::any('tagvim/teacher/delete/{id}', 'TagvimController@teacherdelete');

//    گزارش مشاوره ای ثبت شده
    $this::get('moshaver/sabt', 'MoshaverSabtController@index');


//    پیام صفحه اول

    $this->resource('message', 'FirstMessageController')->middleware('can:message');
    $this->get('message/destroy/{id}', 'FirstMessageController@destroy')->middleware('can:message');
    $this->post('message/modal/{id}', 'FirstMessageController@modal')->middleware('can:message');


//    جلسات مشاوره ای

    $this->get('moshaver', 'MoshverController@index')->middleware('can:moshaver');
    $this->get('moshaver/destroy/{id}', 'MoshverController@destroy')->middleware('can:moshaver');
    $this->get('moshaver/student/{id}/', 'MoshverController@student')->middleware('can:moshaver');
    $this->get('moshaver/create', 'MoshverController@create')->middleware('can:moshaver');
    $this->get('moshaver/edit/{id}', 'MoshverController@edit')->middleware('can:moshaver');
    $this->post('moshaver/store', 'MoshverController@store')->middleware('can:moshaver');
    $this->get('moshaver/sync/{id}', 'MoshverController@sync')->middleware('can:moshaver');
    $this::post('archive/sync/{id}', 'MoshverController@archive');
    $this->any('moshaver/update/{id}', 'MoshverController@update')->middleware('can:moshaver');
    $this->get('moshaver/comment/{id}/{user_id}', 'MoshverController@comment')->middleware('can:moshaver');
    $this->post('moshaver/comment/store', 'MoshverController@commentstore')->middleware('can:moshaver');
    $this::get('moshaver/rollcall/absenttopresent/{id}', 'MoshverController@absenttopresent');
    $this::get('moshaver/rollcall/presenttoabsent/{id}/{moshavers_id}', 'MoshverController@presenttoabsent');

    $this::get('moshaver/file/create', 'MoshverController@createfile')->middleware('can:moshaver');
    $this::post('moshaver/file/store', 'MoshverController@storefile')->middleware('can:moshaver');
    $this::get('moshaver/file/view', 'MoshverController@viewfile')->middleware('can:moshaver');
    $this::get('moshaver/file/destroy/{id}', 'MoshverController@destroyfile')->middleware('can:moshaver');
    $this::get('moshaver/records/{id}', 'MoshverController@record')->middleware('can:moshaver');
    $this::get('moshaver/join/{id}', 'MoshverController@join')->middleware('can:moshaver');

//    end

//exam

    $this->get('exam/{id}', 'ExamController@index')->middleware('can:exam');
    $this::get('exam/student/{id}/{exam}', 'ExamController@student')->middleware('can:exam');
    $this::get('exam/student/single/{id}/{exam}', 'ExamController@studentsingle')->middleware('can:exam');
    $this::get('exam/downloadExcel/{examid}/{clasid}', 'ExamController@export')->middleware('can:exam');
    $this::get('exam/general/create', 'ExamController@generalCreate')->middleware('can:exam');
    $this::post('exam/general/store', 'ExamController@generalstore')->middleware('can:exam');
    $this::get('exam/doros/{id}', 'ExamController@examDoros')->middleware('can:exam');
    $this::post('exam/doros/sort/{id}', 'ExamController@examDorosSort')->middleware('can:exam');
    $this::post('exam/question/key', 'ExamController@questionKey')->middleware('can:exam');
    $this::get('exam/dars/{id}', 'ExamController@examDars')->middleware('can:exam');
    $this::post('/exam/countQuestion/{id}', 'ExamController@countQuestion')->middleware('can:exam');
    $this::post('/exam/questions/update/{id}', 'ExamController@updateQuestion')->middleware('can:exam');
    $this::get('/exam/generals/index/{id}', 'ExamController@generals')->middleware('can:exam');
    $this::get('/exam/general/edit/{id}', 'ExamController@generalEdit')->middleware('can:exam');
    $this::post('/exam/general/update/{id}', 'ExamController@generalUpdate')->middleware('can:exam');
    $this::any('/exam/delete/{id}', 'ExamController@delete')->middleware('can:exam');
    $this::any('/exam/dars/delete/{id}', 'ExamController@deleteDars')->middleware('can:exam');

//end exam


//    شهریه ها
    $this->resource('tuition', 'TuitionController');
    $this->get('tuition/delete/{id}', 'TuitionController@delete');
    //end
//    upload Educational
    $this::resource('uploadeducational', 'EducationalController')->middleware('can:create-homepage');
    $this::any('uploadeducational.store', 'EducationalController@store')->middleware('can:create-homepage');
    $this::get('outboxeducational', 'EducationalController@outbox')->middleware('can:view-delete-homepage');
    $this::get('educational/show/{id}', 'EducationalController@show')->middleware('can:view-delete-homepage');
    $this::get('educational/Delete/{id}', 'EducationalController@Delete')->middleware('can:view-delete-homepage');
//    end upload Educational

//    home route
    Route::get('/converse', 'AdminController@converse')->name('admin.converse');
    Route::post('/converse/store', 'AdminController@conversestore');

    Route::get('/home', 'AdminController@index')->name('admin.home');
    Route::post('/home/job', 'AdminController@job');
    Route::post('/home/delete/{id}', 'AdminController@delete');
    Route::get('/slider/creat', 'SliderController@creat')->middleware('can:create-homepage');
    Route::any('/slider/store', 'SliderController@store')->middleware('can:view-delete-homepage');
    Route::get('/slider/show', 'SliderController@show')->name('admin.slider.show')->middleware('can:view-delete-homepage');
    Route::get('/slider/singlepage/{id}', 'SliderController@singlepage')->name('admin.slider.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/slider/edit/{id}', 'SliderController@edit')->middleware('can:view-delete-homepage');
    Route::post('/slider/update/{id}', 'SliderController@update')->middleware('can:view-delete-homepage');
    Route::get('/slider/delete/{id}', 'SliderController@destroy');

    Route::get('/Portfolio/creat', 'PortfolioController@creat')->middleware('can:create-homepage');
    Route::post('/Portfolio/store', 'PortfolioController@store')->middleware('can:create-homepage');
    Route::get('/Portfolio/show', 'PortfolioController@show')->name('admin.Portfolio.show')->middleware('can:view-delete-homepage');
    Route::get('/Portfolio/singlepage/{id}', 'PortfolioController@singlepage')->name('admin.Portfolio.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/Portfolio/edit/{id}', 'PortfolioController@edit')->middleware('can:view-delete-homepage');
    Route::post('/Portfolio/update/{id}', 'PortfolioController@update')->middleware('can:view-delete-homepage');
    Route::get('/Portfolio/delete/{id}', 'PortfolioController@destroy');

    Route::get('/Consultants/creat/{place}', 'ConsultantsController@creat')->middleware('can:create-homepage');
    Route::post('/Consultants/store', 'ConsultantsController@store')->middleware('can:create-homepage');
    Route::get('/Consultants/show/{place}', 'ConsultantsController@show')->name('admin.consultants.show')->middleware('can:view-delete-homepage');
    Route::get('/Consultants/singlepage/{id}', 'ConsultantsController@singlepage')->name('admin.consultants.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/Consultants/edit/{id}', 'ConsultantsController@edit')->middleware('can:view-delete-homepage');
    Route::post('/Consultants/update/{id}', 'ConsultantsController@update')->middleware('can:view-delete-homepage');
    Route::get('/Consultants/delete/{id}', 'ConsultantsController@destroy');

    Route::get('/roydad/creat/{place}', 'RoydadController@creat')->middleware('can:create-homepage');
    Route::any('/roydad/store', 'RoydadController@store')->middleware('can:create-homepage');
    Route::get('/roydad/show/{place}', 'RoydadController@show')->name('admin.roydad.show')->middleware('can:view-delete-homepage');
    Route::get('/roydad/singlepage/{id}', 'RoydadController@singlepage')->name('admin.roydad.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/roydad/edit/{id}', 'RoydadController@edit')->middleware('can:view-delete-homepage');
    Route::post('/roydad/update/{id}', 'RoydadController@update')->middleware('can:view-delete-homepage');
    Route::get('/roydad/delete/{id}', 'RoydadController@destroy');

    Route::get('/Guides/creat', 'GuidesController@creat')->middleware('can:create-homepage');
    Route::post('/Guides/store', 'GuidesController@store')->middleware('can:create-homepage');
    Route::get('/Guides/show', 'GuidesController@show')->name('admin.Guides.show')->middleware('can:view-delete-homepage');
    Route::get('/Guides/singlepage/{id}', 'GuidesController@singlepage')->name('admin.Guides.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/Guides/edit/{id}', 'GuidesController@edit')->middleware('can:view-delete-homepage');
    Route::post('/Guides/update/{id}', 'GuidesController@update')->middleware('can:view-delete-homepage');
    Route::get('/Guides/delete/{id}', 'GuidesController@destroy');

    Route::get('/Services/creat', 'ServicesController@creat')->middleware('can:create-homepage');
    Route::post('/Services/store', 'ServicesController@store')->middleware('can:create-homepage');
    Route::get('/Services/show', 'ServicesController@show')->name('admin.service.show')->middleware('can:view-delete-homepage');
    Route::get('/Services/singlepage/{id}', 'ServicesController@singlepage')->name('admin.service.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/Services/edit/{id}', 'ServicesController@edit')->middleware('can:view-delete-homepage');
    Route::post('/Services/update/{id}', 'ServicesController@update')->middleware('can:view-delete-homepage');
    Route::get('/Services/delete/{id}', 'ServicesController@destroy');

    Route::get('/video/delete/{id}', 'VideoController@destroy')->middleware('can:view-delete-homepage');
    Route::get('/video/index', 'VideoController@index')->middleware('can:create-homepage');
    Route::get('/video/download/{id}', 'VideoController@download')->middleware('can:create-homepage');
    Route::get('/video/creat', 'VideoController@creat')->middleware('can:create-homepage');
    Route::post('/video/store', 'VideoController@store')->middleware('can:create-homepage');
    Route::get('/Image/creat', 'ImageController@creat')->middleware('can:create-homepage');
    Route::post('/Image/store', 'ImageController@store')->middleware('can:create-homepage');
    Route::get('/Image/show', 'ImageController@show')->name('admin.Image.show')->middleware('can:view-delete-homepage');
    Route::get('/Image/singlepage/{id}', 'ImageController@singlepage')->name('admin.Image.singlepage')->middleware('can:view-delete-homepage');
    Route::get('/Image/edit/{id}', 'ImageController@edit')->middleware('can:view-delete-homepage');
    Route::post('/Image/update/{id}', 'ImageController@update')->middleware('can:view-delete-homepage');
    Route::get('/Image/delete/{id}', 'ImageController@destroy')->middleware('can:view-delete-homepage');
    Route::post('/dropzone-image-delete', 'ImageController@destroyimg')->middleware('can:create-homepage');
    Route::post('/dropzone-image-upload', 'ImageController@storeimg')->middleware('can:create-homepage');

    $this::get('uploadquestion', 'QuestionsController@index')->middleware('can:create-homepage');;
    $this::any('uploadquestion.store', 'QuestionsController@store')->middleware('can:create-homepage');;
    $this::get('question/show', 'QuestionsController@show')->middleware('can:view-delete-homepage');;
    $this::get('question/Delete/{id}', 'QuestionsController@Delete')->middleware('can:view-delete-homepage');;

    Route::get('/Tag/creat', 'CTagController@creat')->middleware('can:create-homepage');
    Route::post('/Tag/store', 'CTagController@store')->middleware('can:create-homepage');
    Route::get('/Tag/show', 'CTagController@show')->name('admin.Tag.show')->middleware('can:view-delete-homepage');
    Route::get('/Tag/delete/{id}', 'CTagController@destroy')->middleware('can:view-delete-homepage');

    Route::get('/Blog/view', 'BlogController@view')->middleware('can:create-homepage');
    Route::get('/Blog/single/{id}', 'BlogController@single')->middleware('can:create-homepage');
    Route::any('/Blog/changeStatus', 'BlogController@changeStatus');
    Route::any('/blog/destroy/{id}', 'BlogController@destroy');

    Route::get('/RTamas/view', 'RTamasController@view')->middleware('can:RTamas');
    Route::any('/RTamas/changeStatus', 'RTamasController@changeStatus')->middleware('can:RTamas');
    Route::any('/RTamas/destroy/{id}', 'RTamasController@destroy')->middleware('can:RTamas');

    Route::get('/mainpage', 'AdminController@mainpage')->middleware('can:view-delete-homepage');;
    Route::any('/mainpage/store', 'AdminController@mainpagestore')->middleware('can:view-delete-homepage');;
    Route::any('/mainpage/storee', 'AdminController@mainpagestoree')->middleware('can:view-delete-homepage');;
	  Route::any('/mainpage/storeefooter', 'AdminController@mainpagestoreefooter')->middleware('can:view-delete-homepage');
    Route::get('/mainpage/delete/{id}', 'AdminController@mainpagedelete')->middleware('can:view-delete-homepage');;
//    end home route


    $this::get('answer', 'AdminControoler@index');;
    Route::get('/pre-registration', 'AdminController@pre_registration')->middleware('can:pre-registration');
    Route::get('/registration/downloadExcel', 'AdminController@registrationExcel')->middleware('can:pre-registration');


//    library
    Route::get('/library/index', 'LibraryController@index')->middleware('can:library');
    Route::get('/library/create', 'LibraryController@create')->middleware('can:library');
    Route::post('/library/store', 'LibraryController@store')->middleware('can:library');
    Route::post('/library/fines', 'LibraryController@fine')->middleware('can:library');
    Route::post('/library/fines/changestatus', 'LibraryController@finechangestatus')->middleware('can:library');
    Route::get('/library/fines/show/{id}', 'LibraryController@fineshow')->name('fines.show')->middleware('can:library');
    Route::get('/library/edit/{id}', 'LibraryController@edit')->middleware('can:library');
    Route::any('/library/update/{id}', 'LibraryController@update')->middleware('can:library');
    Route::get('/library/delete/{id}', 'LibraryController@destroy')->middleware('can:library');
    Route::get('/library/trust/{id}', 'LibraryController@trust')->middleware('can:library');
    Route::get('/library/back/{id}', 'LibraryController@back')->middleware('can:library');
    Route::post('/library/trust/store', 'LibraryController@truststore')->middleware('can:library');
    Route::get('/library/reservation/{id}', 'LibraryController@reservation')->middleware('can:library');
    Route::post('/library/reservation/store', 'LibraryController@reservationstore')->middleware('can:library');
    Route::get('/library/cancelreserve/{id}', 'LibraryController@cancelreserve')->middleware('can:library');
    Route::get('/library/intrust/', 'LibraryController@intrust')->middleware('can:library');
    Route::get('/library/trust/tamdid/{id}', 'LibraryController@tamdid')->middleware('can:library');
    Route::get('/library/inreserve/', 'LibraryController@inreserve')->middleware('can:library');
    Route::get('/library/history/', 'LibraryController@history')->middleware('can:library');
    Route::post('/library/importExcel', 'LibraryController@importExcel')->middleware('can:library');
    Route::get('/library/downloadExcel/{type}', 'LibraryController@downloadExcel')->middleware('can:library');
    Route::get('/library/importExport', 'LibraryController@importExport')->middleware('can:library');
//    end library

//   سطح دسرسی
    Route::resource('/permissions', 'PermissionController')->middleware('can:manage-secret');
//    Route::get('/permissions/delete/{id}', 'PermissionController@destroy')->middleware('can:manage-secret');
    Route::resource('/roles', 'RoleController')->middleware('can:manage-secret');
//    Route::get('/roles/delete/{id}', 'RoleController@destroy')->middleware('can:manage-secret');
//    Route::get('/roles/edit/{id}', 'RoleController@edit')->middleware('can:manage-secret');
//    Route::any('/roles/update/{id}', 'RoleController@update')->middleware('can:manage-secret');
    Route::get('/users/roles', 'RoleController@usercreate')->middleware('can:manage-secret');
    Route::get('/users/roles/show', 'RoleController@usershow')->middleware('can:manage-secret');
    Route::any('/users/roles/store', 'RoleController@userstore')->middleware('can:manage-secret');
// این بالایی واسه این کامنت شد که تو پیش نمایش دسترسی هارو خراب نکنن.


//    student
    $this::resource('students', 'StudentsController')->middleware('can:view-member');
    $this::get('students/singlepage/{id}', 'StudentsController@class')->middleware('can:view-member');
    $this::get('students/edit/{id}', 'StudentsController@studentEdit')->middleware('can:view-member');
    $this::any('student/edite/{id}', 'StudentsController@edit');
    $this::get('students.create', 'StudentsController@create')->middleware('can:view-member');
    $this::post('students.store', 'StudentsController@store')->middleware('can:create-member');
    $this::any('student/destroy/{id}', 'StudentsController@destroy')->middleware('can:create-member');
    $this::get('parent', 'StudentsController@parent')->middleware('can:view-member');


//    teacher
    $this::resource('teacher', 'TeacherController')->middleware('can:view-member');
    $this::get('teacher.create/{id}', 'TeacherController@createteacher')->middleware('can:view-member');
    $this::post('teacher.store', 'TeacherController@store')->middleware('can:create-member');
    $this::post('teacher/addclass', 'TeacherController@addclass')->middleware('can:create-member');

    $this::get('teacher/edit/{id}', 'TeacherController@edit')->middleware('can:create-member');
    $this::any('teacher/update/{id}', 'TeacherController@update')->middleware('can:create-member');
    $this::any('teacher/showclass/{id}', 'TeacherController@showclass')->middleware('can:create-member');
    $this::any('teacher/destroy/{id}', 'TeacherController@destroy')->middleware('can:create-member');
    $this::any('teacher/destroyclass/{id}', 'TeacherController@destroyclass')->middleware('can:create-member');
    $this::get('program/teacher', 'TeacherController@program')->middleware('can:view-member');

//    personals
    $this::resource('personals', 'PersonalController')->middleware('can:view-member');
    $this::any('personals/destroy/{id}', 'PersonalController@destroy')->middleware('can:create-member');
    $this::any('personals/update/{id}', 'PersonalController@update')->middleware('can:create-member');


//    classfinance
    $this::resource('class', 'ClassController')->middleware('can:manage-classes');
    $this::any('class/edite/{id}', 'ClassController@update')->middleware('can:manage-classes');
    $this::get('class.create', 'ClassController@create')->middleware('can:manage-classes');
    $this::post('class.store', 'ClassController@store')->middleware('can:manage-classes');
    $this::get('class/destroy/{id}', 'ClassController@destroy')->middleware('can:manage-classes');

//    paye
    $this::get('paye', 'ClassController@paye');
    $this::post('paye/store', 'ClassController@payestore');
    $this::get('paye/destroy/{id}', 'ClassController@payedestroy');

//    dars
    $this::get('dars/{id}', 'DarsController@index')->middleware('can:manage-doros');
    $this::any('dars/edite/{id}', 'DarsController@edit')->middleware('can:manage-doros');
    $this::get('dars.create', 'DarsController@create')->middleware('can:manage-doros');
    $this::post('dars.store', 'DarsController@store')->middleware('can:manage-doros');
    $this::get('dars/destroy/{id}', 'DarsController@destroy')->middleware('can:manage-doros');
//charts for admin
    $this::get('charts/kol', 'ChartController@kol')->middleware('can:manage-developmentchart');
    $this::get('charts/class/{id}', 'ChartController@class')->middleware('can:manage-developmentchart');
    $this::get('charts/paye/{id}', 'ChartController@paye')->middleware('can:manage-developmentchart');
    $this::get('charts/paye/dars/{id}/{idclass}', 'ChartController@payedars')->middleware('can:manage-Comparisonchart');
    $this::get('charts/class/dars/{id}', 'ChartController@classdars')->middleware('can:manage-Comparisonchart');
    $this::get('charts/moadel', 'ChartController@moadel')->middleware('can:manage-Comparisonchart');
    $this::get('charts/paye/class/dars{id}', 'ChartController@payeclassdars')->middleware('can:manage-Comparisonchart');
    $this::get('charts/paye/koldars/{id}', 'ChartController@koldars')->middleware('can:manage-Comparisonchart');
    $this::get('charts/pnumber', 'ChartController@numberpaye')->middleware('can:manage-Comparisonchart');
    $this::get('charts/cnumber', 'ChartController@numberclass')->middleware('can:manage-Comparisonchart');
    $this::get('charts/teacheractivity', 'ChartController@teacheractivity')->middleware('can:manage-Comparisonchart');

//end charts for admin


//    barname && emtehan
    $this::get('barnane.create', 'BarnamehController@create')->middleware('can:manage-classprograme');
    $this::post('barnane/store', 'BarnamehController@store')->middleware('can:manage-classprograme');
    $this::get('barnane/view', 'BarnamehController@view')->middleware('can:manage-classprograme');
    $this::any('barname/destroy/{id}', 'BarnamehController@destroy')->middleware('can:manage-classprograme');

    $this::get('emtehan.create', 'BarnamehController@Ecreate')->middleware('can:manage-examprograme');
    $this::post('emtehan/store', 'BarnamehController@Estore')->middleware('can:manage-examprograme');
    $this::get('emtehan/view', 'BarnamehController@Eview')->middleware('can:manage-examprograme');
//   end barname

    /// excle
    Route::get('importExport', 'MaatwebsiteDemoController@importExport')->middleware('can:excle');
    Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel')->middleware('can:excle');
    Route::post('importExcel', 'MaatwebsiteDemoController@importExcel')->middleware('can:excle');

///  end excle


//    karnameh
    $this::get('karnameh/request', 'RKarnamehController@index')->middleware('can:karnameh');
    $this::post('karnameh.store', 'RKarnamehController@store')->middleware('can:karnameh');
    $this::get('karnameh/show', 'RKarnamehController@show')->middleware('can:karnameh');
    $this::get('karnameh/show/details/{id}', 'RKarnamehController@showdetails')->middleware('can:karnameh');;
    $this::any('karnameh/destroy/{id}', 'RKarnamehController@destroy')->middleware('can:karnameh');;
    $this::any('changeStatus', 'RKarnamehController@changeStatus')->middleware('can:karnameh');;
    $this::get('karnameh/student/{idk}/{idc}', 'RKarnamehController@student')->middleware('can:karnameh');;
    $this::get('karnameh/student/show/{idk}/{ids}', 'RKarnamehController@studentshow')->middleware('can:karnameh');;

//    create karnameh with manager
    $this::get('karnameh', 'AdminController@karnamehcreate')->middleware('can:karnameh');
    $this::post('karnameh/store', 'AdminController@karnamehstore')->middleware('can:karnameh');
    $this::get('karnameh/show/{name}/{class}', 'AdminController@karnamehshow')->middleware('can:karnameh');
    $this::get('karnameh/newstudent/show/{name}/{user}/{moadel}', 'AdminController@skarnamehshow')->middleware('can:karnameh');

//    end karnameh


//    sms
    $this::get('sms/manage', 'SMSController@index')->middleware('can:message');
    $this::get('sms/history', 'SMSController@history')->middleware('can:message');
    $this::post('sms/charge', 'SMSController@charge')->middleware('can:message');
    $this::get('sms/send', 'SMSController@create')->middleware('can:message');
    $this::post('sms/store', 'SMSController@store')->middleware('can:message');
//    endsms

//    CDiscipline
    $this::get('cdiscipline/manage', 'DisciplineController@cindex')->name('Admin.cdiscipline.manage')->middleware('can:discipline-manage');
    $this::any('cdiscipline/update/{id}', 'DisciplineController@cupdate')->middleware('can:discipline-manage');
    $this::get('cdiscipline/create', 'DisciplineController@ccreate')->middleware('can:discipline-manage');
    $this::post('cdiscipline/store', 'DisciplineController@cstore')->middleware('can:discipline-manage');
    $this::any('cdiscipline/destroy/{id}', 'DisciplineController@cdestroy')->middleware('can:discipline-manage');
    $this::get('cdiscipline/chart/all', 'DisciplineController@chartall')->middleware('can:discipline-manage');
    $this::get('cdiscipline/chart/class/{id}', 'DisciplineController@chartclass')->middleware('can:discipline-manage');
    $this::get('cdiscipline/chart/paye/{paye}', 'DisciplineController@chartpaye')->middleware('can:discipline-manage');
    $this::get('cdiscipline/chart/comparison/paye', 'DisciplineController@chartcomparisonpaye')->middleware('can:discipline-manage');
    $this::get('cdiscipline/chart/comparison/class', 'DisciplineController@chartcomparisonclass')->middleware('can:discipline-manage');

//    end CDiscipline
//    Discipline
    $this::get('discipline/index', 'DisciplineController@sindex')->name('discipline.sindex')->middleware('can:discipline-sabt');
    $this::get('discipline/create', 'DisciplineController@screate')->middleware('can:discipline-sabt');
    $this::post('discipline/store', 'DisciplineController@sstore')->middleware('can:discipline-sabt');
    $this::any('discipline/destroy/{id}', 'DisciplineController@sdestroy');
    $this::get('discipline/class/{id}', 'DisciplineController@class')->middleware('can:discipline-list');
    $this::get('discipline/single/{id}', 'DisciplineController@single')->middleware('can:discipline-list');
    $this::get('rollcall/class/{id}', 'DisciplineController@rollcall')->middleware('can:rollcall');
//    end Discipline
    $this::get('students/rollcall/{id}', 'DisciplineController@rollcallindex');
    $this::get('students/rollcall/absenttopresent/{id}', 'DisciplineController@absenttopresent');
    $this::get('students/rollcall/presenttoabsent/{id}', 'DisciplineController@presenttoabsent');
    $this::get('student/rollcall/absentlist/{id}', 'DisciplineController@absentlist');
    $this::get('student/rollcall/today_absent', 'DisciplineController@today_absent');
    $this::get('student/rollcall/ok/{id}', 'DisciplineController@absent_ok');


});


// END route for Admin
//***


//***
//route for teacher

Route::group(['prefix' => 'teacher', 'middleware' => ['TecherCheck', 'ExpireCheck', 'StatusCheck'], 'namespace' => 'teacher'], function () {

    $this::get('/students/rollcall/done/{id}', 'RollCallController@done')->name('online_class');

    //    online_class
    $this::get('/online/{id}', 'OnlineClassController@index')->name('online_class');
    $this::get('/online_class/create', 'OnlineClassController@create');
    $this::post('/online/store', 'OnlineClassController@store');
    $this::get('/online/edit/{id}', 'OnlineClassController@edit');
    $this::get('/online/update/{id}', 'OnlineClassController@update');
    $this::any('online/Delete/{id}', 'OnlineClassController@delete');
    $this::get('/online/join/{id}', 'OnlineClassController@join');
    $this::get('/online/list/{id}', 'OnlineClassController@listGroup');
    $this::get('/online/list/{id}/{version}', 'OnlineClassController@list');
    $this::get('/online/record/{id}', 'OnlineClassController@record');


    $this::get('/mark/export/{class}/{dars}', 'MarkController@export');
    $this::get('/karnameh/export/{class}/{dars}', 'MarkController@exportkarnameh');


    $this::get('/class/{id}', 'teacherControoler@class');
    $this::post('class/edit/{id}', 'teacherControoler@classteacher');
    $this::post('class/editlink/{id}', 'teacherControoler@link');

    //    انتخابات
    $this::get('/selection', 'SelectionController@index');
    $this::get('/selection/past', 'SelectionController@past');
    $this::get('/selection/sabt/{id}', 'SelectionController@sabt');
    $this::post('/selection/store', 'SelectionController@store');
    $this::get('/selection/view/{id}', 'SelectionController@view');

//    برنامه

    $this::get('tagvim', 'teacherControoler@tagvim');

//ثبت گزارش مشاوره ای
    $this::get('moshaver/sabt/{id}', 'MoshaverSabtController@index');
    $this::post('moshaver/sabt', 'MoshaverSabtController@store');
    $this::get('moshaver/show/{id}', 'MoshaverSabtController@show');
    $this::get('moshaver/destroy/{id}', 'MoshaverSabtController@destroy');


//    انضباط

    $this::get('discipline/create/{id}', 'DisciplineController@screate');
    $this::get('discipline/index/{id}', 'DisciplineController@index');
    $this::post('discipline/store', 'DisciplineController@sstore');


//دفتر کلاسی
    $this->get('daftar/date/{class}/{dars}', 'DaftarController@date');
    $this->post('daftar/select', 'DaftarController@select');
    $this->post('daftar/mark', 'DaftarController@mark');


//    sync archive
    $this::post('archive/sync/{id}', 'teacherControoler@sync');

//    end

// exam
    $this::resource('exam', 'ExamController')->names('exam');
    $this::any('/exam/changeStatus', 'ExamController@changeStatus');
    $this::get('questions/{id}', 'ExamController@questions');
    $this::post('exam/questions', 'ExamController@questionsstore');
    $this::any('exam/questionsupdate/{id}', 'ExamController@questionsupdate');
    $this::any('exam/delete/{id}', 'ExamController@delete');
    $this::any('examquestion/delete/{id}', 'ExamController@deletequestion');
    $this::any('exam/update/{id}', 'ExamController@update');
    $this::get('exam/questions/edit/{id}', 'ExamController@update');
    $this::get('exam/questions/edit/{id}', 'ExamController@update');
    $this::get('exam/student/{id}/{exam}', 'ExamController@student');
    $this::get('exam/student/single/{id}/{exam}', 'ExamController@studentsingle');
    $this::get('exams/archive', 'ExamController@archive');
    $this::get('exam/sync/{id}', 'ExamController@sync');
    $this::get('exam/update/sync/{id}', 'ExamController@syncupdate');
// تشریحی
    $this::get('questions/descriptive/{id}', 'ExamController@descriptiveQuestions');
    $this::post('exam/descriptive/question/update/{id}', 'ExamController@descriptiveQuestionsUpdate');
    $this::get('exams/descriptive', 'ExamController@descriptive');
    $this::post('exam/descriptive/single/update/{id}', 'ExamController@descriptivesingleUpdate');
    $this::get('exam/karname/{id}', 'ExamController@karname');
    $this::get('exam/karnameExport/{id}', 'ExamController@karnameExport');


//    end


//    rollcall
    $this::get('students/rollcall/{id}', 'RollCallController@index');
    $this::get('students/rollcall/absenttopresent/{id}', 'RollCallController@absenttopresent');
    $this::get('students/rollcall/presenttoabsent/{id}', 'RollCallController@presenttoabsent');
    $this::get('student/rollcall/absentlist/{id}', 'RollCallController@absentlist');
    $this::get('students/rollcall/absentlist/all/{id}', 'RollCallController@absentlistall');
//    end rollcall
    $this::get('', 'teacherControoler@index')->name('teacher');
    $this::resource('students', 'StudentsController');
    $this::get('students/single/{id}', 'StudentsController@class');
    $this::any('student/edit/{id}', 'StudentsController@edit');
    $this::get('students.create', 'StudentsController@create');
    $this::post('students.store', 'StudentsController@store');
    $this::get('students.destroy', 'StudentsController@destroy');

//    marks
    $this::get('createmarkshow/{idc}/{idd}', 'MarkController@create');
    $this::any('createmark', 'MarkController@store');
    $this::get('viewmark/{idc}/{idd}', 'MarkController@viewmark');
    $this::get('markdelet/{id}', 'MarkController@markdelet');
    $this::any('editeemark/{id}', 'MarkController@editeemark');


    $this::get('mark/date/{idc}/{idd}', 'MarkController@date');
    $this::post('mark/date', 'MarkController@datemark');
    $this::post('mark/storedate', 'MarkController@storedate');
    $this::get('mark/{idc}/{idd}', 'MarkController@index')->name('teacher.mark');
    $this::post('mark/edit/{id}', 'MarkController@edit');
//    $this::post('mark/editmax/{id}','MarkController@editmax');
//    $this::post('mark/editbist/{id}','MarkController@editbist');

//   end marks

// tamarin
    $this::get('uploadtamrin', 'TamrinController@upload');
    $this::any('uploadtamri.store', 'TamrinController@store')->name('uploadtamrin.store');
    $this::get('outboxtamrin{idc}/{idd}', 'TamrinController@outbox');
    $this::get('inboxtamrin{idc}/{idd}', 'TamrinController@inbox');
    $this::get('tamrin/show/{id}', 'TamrinController@show');
    $this::get('tamrin/edite/{id}', 'TamrinController@edite');
    $this::get('tamrin/jtamrin/{id}', 'TamrinController@jtamrin');
    $this::any('tamrin/update/{id}', 'TamrinController@update');
    $this::get('tamrin/Delete/{id}', 'TamrinController@Delete');
    $this::any('tamrin/changeStatus', 'TamrinController@changeStatus');
    $this::get('outboxtamrin/archive', 'TamrinController@archive');
    $this::get('tamrin/sync/{id}', 'TamrinController@sync');
    $this::post('tamrin/mark', 'TamrinController@mark');


// end tamarin


//creat teacher-table
    $this::post('techertable', 'teacherControoler@store');
//end creat teacher-table

    //    chart for teacher
//    $this::get('paye', 'ChartController@paye')->name('teacher.paye');
//    $this::get('class', 'ChartController@class');
    $this::get('chartmark{idc}/{id}', 'ChartController@chartmark');
    $this::get('develop{idc}/{id}', 'ChartController@develop');
    $this::get('classmark', 'ChartController@classmark');
//    $this::get('moadel', 'ChartController@moadel');
//    $this::get('dars', 'ChartController@dars');


//    karnameh

    $this::get('karnameh/create/{idk}/{idc}/{idd}', 'CKarnamehController@create');
    $this::get('karnameh/show/{idk}/{idc}/{idd}', 'CKarnamehController@show')->name('teacher.karnameh.show');
    $this::get('newkarnameh/show/{name}/{class}', 'CKarnamehController@newkarnamehshow');
    $this::get('karnameh/newstudent/show/{name}/{user}/{moadel}', 'CKarnamehController@skarnamehshow');
    $this::post('karnameh/create', 'CKarnamehController@store');
    $this::post('ckarnameh/student/{idk}', 'CKarnamehController@kstore');
    $this::post('karnameh/render', 'CKarnamehController@render');

//    endkarnameh


//    upload film
    $this::get('uploadfilm/{id}', 'FilmController@index');
    $this::any('uploadfilm.store', 'FilmController@store');
    $this::get('outboxfilm/{idc}/{idd}', 'FilmController@outbox');
    $this::get('outboxfilm/archive', 'FilmController@archive');
    $this::get('film/show/{id}', 'FilmController@show');
    $this::get('film/sync/{id}', 'FilmController@sync');
    $this::get('film/edite/{id}', 'FilmController@edite');
    $this::any('film/update/{id}', 'FilmController@update');
    $this::get('film/Delete/{id}', 'FilmController@Delete');


//    end upload film


//    end chart for teacher


});

/// END route for teacher


//Route::get('charts', 'ChartController@index');
//Route::get('chartss', 'ChartController@indexx');
//Route::get('chartss', 'ChartController@indexx');


//rout for message

Route::get('mails/inbox', 'MailController@inbox')->name('');
Route::get('mail/outbox', 'MailController@outbox');
Route::get('mail/create', 'MailController@create')->name('mail');
Route::post('mail/store', 'MailController@store');
Route::get('mail/important', 'MailController@important');
Route::get('mail/edit/{id}', 'MailController@edit');
Route::any('mail/update/{id}', 'MailController@update');
Route::get('mail/updatein/{id}', 'MailController@updatein');
Route::get('mail/onupdatein/{id}', 'MailController@onupdatein');
Route::get('mail/updateout/{id}', 'MailController@updateout');
Route::get('mail/onupdateout/{id}', 'MailController@onupdateout');
Route::get('mail/updatestar/{id}', 'MailController@updatestar');
Route::get('mail/onupdatestar/{id}', 'MailController@onupdatestar');
Route::get('mail/show/{id}', 'MailController@show');
Route::get('mail/showin/{id}', 'MailController@showin');
Route::get('mail/mailDeleteAll/{id}', 'MailController@delete');
Route::get('mail/mailDelete/{id}', 'MailController@deletemail');
Route::get('mail/forward/{id}', 'MailController@forward');
Route::any('mail/forwardto/{id}', 'MailController@forwardto');

//end rout for message


// بازیابی رمز عبور
Route::post('resetpassword', 'ResetPassController@index');


# Payment
Route::get('payment/checkout/{token}', 'PaymentController@checkout')->middleware(['auth']);
Route::post('payment/checkout/{token}', 'PaymentController@checkout')->middleware(['auth']);
Route::get('payment/bank-redirect/{bank}', 'PaymentController@bankRedirect')->middleware(['auth']);
