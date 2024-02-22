<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RazorpayController;
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
//////////for landing page////////

// Route::get('/maths', function () {
//     return view('landing.math');
// });
Route::match(['get', 'post'], '/lp-maths-demo', [App\Http\Controllers\landing\LandingController::class, 'maths'])->name('landing.maths');
Route::match(['get', 'post'], '/mathstwo', [App\Http\Controllers\landing\LandingController::class, 'mathstwo'])->name('landing.mathstwo');
//////science landing////
Route::match(['get', 'post'], '/lp-science-demo', [App\Http\Controllers\landing\LandingController::class, 'science'])->name('landing.science');
Route::match(['get', 'post'], '/sciencetwo', [App\Http\Controllers\landing\LandingController::class, 'sciencetwo'])->name('landing.sciencetwo');
////////coding//////////////
Route::match(['get', 'post'], '/lp-coding-demo', [App\Http\Controllers\landing\LandingController::class, 'coding'])->name('landing.coding');
Route::match(['get', 'post'], '/codingtwo', [App\Http\Controllers\landing\LandingController::class, 'codingtwo'])->name('landing.codingtwo');
/////////English//
Route::match(['get', 'post'], '/lp-english-demo', [App\Http\Controllers\landing\LandingController::class, 'english'])->name('landing.english');
Route::match(['get', 'post'], '/englishtwo', [App\Http\Controllers\landing\LandingController::class, 'englishtwo'])->name('landing.englishtwo');
//////////// financial-literacy///
Route::match(['get', 'post'], '/lp-financial-literacy-demo', [App\Http\Controllers\landing\LandingController::class, 'financial'])->name('landing.financial');
Route::match(['get', 'post'], '/financialtwo', [App\Http\Controllers\landing\LandingController::class, 'financialtwo'])->name('landing.financialtwo');




/////////end landing page section////
Route::get('/', function () {
    return view('front.dashboard');
});
Route::get('/contact-us', function () {
    return view('front.contact');
});
Route::get('/trainer-list', function () {
    return view('front.trainer-list');
});

Route::get('/instructor-profile/{id}', [App\Http\Controllers\HomeController::class, 'instructor_profile'])->name('instructor-profile');
Route::get('/search_teacher', [App\Http\Controllers\HomeController::class, 'search_teacher'])->name('search_teacher');
Route::get('/search_teacher_lan', [App\Http\Controllers\HomeController::class, 'search_teacher_lan'])->name('search_teacher_lan');
Route::get('/search_teacher_cat', [App\Http\Controllers\HomeController::class, 'search_teacher_cat'])->name('search_teacher_cat');
Route::get('/filter_category', [App\Http\Controllers\HomeController::class, 'filter_category'])->name('filter_category');



Route::get('student/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('student.logout');
Route::get('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'logout'])->name('admin.logout');

Route::get('user/login', [App\Http\Controllers\Auth\LoginController::class, 'login_view'])->name('front.login');

//forgot password///////////////////////////

Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');


/////////////////////forgetpassword/////////////////////////

Route::post('doUsrlgn', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('user.dologin');
Route::post('doAdmlgn', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login'])->name('admin.dologin');

Auth::routes();
Route::get('admin/login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login_view'])->name('admin.login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');

//route admin
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['Admin']], function () {

/////////////////question//////////
Route::get('/question-list/{id}', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'index5'])->name('question-list');

Route::get('/question-answer/{id}/{tid}', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'index'])->name('teacher.question-answer');
Route::post('/welcome/create', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'create'])->name('teacher.welcome.create');
Route::post('/single_choice/create', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'single_create'])->name('teacher.single_choice.create');
Route::get('/q_page', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'page'])->name('teacher.q_page');
Route::post('/student/assign', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'assign'])->name('teacher.student.assign');
Route::post('/delete-question', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'delquestion'])->name('teacher.delete-question');
Route::post('/delete-page', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'delpage'])->name('teacher.delete-page');
Route::get('/editq', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'editq'])->name('teacher.editq');
Route::post('/single_choice/edit/{id}', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'single_edit'])->name('teacher.single_choice.edit');

Route::get('/question-preview/{id}', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'index1'])->name('teacher.question-preview');

// Route::get('/question-answer', function () {
//     return view('admin.teacher.question-answer');
// });

Route::get('/enqdata', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'enqdata'])->name('teacher.enqdata');

// Route::get('/question-list', function () {
//     return view('admin.teacher.question-list');
// });
Route::post('/delete-quiz', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'delquiz'])->name('teacher.delete-quiz');

Route::match(['get', 'post'], '/update_title/{id}', [App\Http\Controllers\Admin\QuestionAnswerController::class, 'updateTitle'])->name('teacher.update_title');

/////////////end//////////////


    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::match(['get', 'post'], '/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    Route::match(['get', 'post'], '/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    Route::post('/enable-action', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction'])->name('enable-action');
    Route::post('/status-action', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction'])->name('status-action');
    Route::post('/delete-action', [App\Http\Controllers\Admin\AjaxController::class, 'setDeleteAction'])->name('delete-action');
    Route::post('/enable-action1', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction1'])->name('enable-action1');

    // slider
    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
    Route::match(['get', 'post'], '/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
    Route::match(['get', 'post'], '/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
    Route::get('/role-permission/{id}', [App\Http\Controllers\Admin\RoleController::class, 'getAddPermissionPage'])->name('role.permission');
    Route::post('/role-permission/update', [App\Http\Controllers\Admin\RoleController::class, 'updateRolePermission'])->name('role.permission');
    ///catecory//

    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('category');

    Route::match(['get', 'post'], '/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('category.create');

    Route::match(['get', 'post'], '/category/edit/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('category.edit');
    Route::get('/sub-category-list', [App\Http\Controllers\Admin\AjaxController::class, 'subCategoryList'])->name('sub-category-list');
    Route::get('/sub-category', [App\Http\Controllers\Admin\AjaxController::class, 'subCategoryList1'])->name('sub-category');


    ////Member_ship_plans////
    Route::get('/member_ship_plan', [App\Http\Controllers\Admin\MemberShipPlanController::class, 'index'])->name('member_ship_plan');
    Route::match(['get', 'post'], '/member_ship_plan/create', [App\Http\Controllers\Admin\MemberShipPlanController::class, 'create'])->name('member_ship_plan.create');
    Route::match(['get', 'post'], '/member_ship_plan/edit/{id}', [App\Http\Controllers\Admin\MemberShipPlanController::class, 'edit'])->name('member_ship_plan.edit');
    ///////Benifits/////////////////
    Route::get('/benifit', [App\Http\Controllers\Admin\BenifitsController::class, 'index'])->name('benifit');
    Route::match(['get', 'post'], '/benifit/create', [App\Http\Controllers\Admin\BenifitsController::class, 'create'])->name('benifit.create');
    Route::match(['get', 'post'], '/benifit/edit/{id}', [App\Http\Controllers\Admin\BenifitsController::class, 'edit'])->name('benifit.edit');
    ///////Benifits/////////////////
    /////StudentManegment/////////////
    Route::get('/student_manegment', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('student_manegment');
    Route::match(['get', 'post'], '/student_manegment/create', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('student_manegment.create');
    Route::match(['get', 'post'], '/student_manegement/edit/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('student_manegment.edit');
    Route::get('/paysuccess', [App\Http\Controllers\Admin\StudentController::class, 'razorPaySuccess'])->name('razorPaySuccess');

    /////////studentManegment////////////
    Route::get('/student_manegement_two', [App\Http\Controllers\Admin\StudentRegController::class, 'index'])->name('student_manegement_two');
    Route::match(['get', 'post'], '/student_manegement_two/create', [App\Http\Controllers\Admin\StudentRegController::class, 'create'])->name('student_manegement_two.create');
    Route::match(['get', 'post'], '/student_manegement_two/edit/{id}', [App\Http\Controllers\Admin\StudentRegController::class, 'edit'])->name('student_manegement_two.edit');
    Route::get('/paysuccessstudent', [App\Http\Controllers\Admin\StudentRegController::class, 'razorPaySuccess'])->name('razorPaySuccess');
    Route::match(['get', 'post'], '/student_manegement_two/assign_teacher/view/{id}', [App\Http\Controllers\Admin\StudentRegController::class, 'assign'])->name('assign_teacher');

    ///Tutor//

    Route::get('/teacher', [App\Http\Controllers\Admin\TutorController::class, 'index'])->name('tutor');


    Route::match(['get', 'post'], '/teacher/edit/{id}', [App\Http\Controllers\Admin\TutorController::class, 'edit'])->name('tutor.edit');

    Route::match(['get', 'post'], '/institute', [App\Http\Controllers\Admin\TutorController::class, 'Institute'])->name('institute.create');

    Route::match(['get', 'post'], '/teacher-create', [App\Http\Controllers\Admin\TutorController::class, 'Indivisual'])->name('tutor.create');
    Route::get('/sub-category-list3', [App\Http\Controllers\Admin\TutorController::class, 'subCategoryList1'])->name('tutor.sub-category-list');
    Route::get('/sub-category-list-edit', [App\Http\Controllers\Admin\TutorController::class, 'subCategoryListEdit1'])->name('tutor.sub-category-list-edit');
    Route::get('/paysuccessadminteacher', [App\Http\Controllers\Admin\TutorController::class, 'razorPaySuccess3']);
    Route::get('/paysuccessadmininstitute', [App\Http\Controllers\Admin\TutorController::class, 'razorPaySuccess4']);
    ///faq//
    Route::get('/faq', [App\Http\Controllers\Admin\FaqController::class, 'index'])->name('faq');

    Route::match(['get', 'post'], '/faq/create', [App\Http\Controllers\Admin\FaqController::class, 'create'])->name('faq.create');

    Route::match(['get', 'post'], '/faq/edit/{id}', [App\Http\Controllers\Admin\FaqController::class, 'edit'])->name('faq.edit');

    //aboutpoints
    Route::get('/aboutus-point', [App\Http\Controllers\Admin\AboutusPointController::class, 'index'])->name('aboutus-point');

    Route::match(['get', 'post'], '/aboutus-point/create', [App\Http\Controllers\Admin\AboutusPointController::class, 'create'])->name('aboutus-point.create');

    Route::match(['get', 'post'], '/aboutus-point/edit/{id}', [App\Http\Controllers\Admin\AboutusPointController::class, 'edit'])->name('aboutus-point.edit');

    //Community
    Route::get('/community', [App\Http\Controllers\Admin\CommunityController::class, 'index'])->name('community');

    Route::match(['get', 'post'], '/community/create', [App\Http\Controllers\Admin\CommunityController::class, 'create'])->name('community.create');

    Route::match(['get', 'post'], '/community/edit/{id}', [App\Http\Controllers\Admin\CommunityController::class, 'edit'])->name('community.edit');


    //Counts
    Route::get('/count', [App\Http\Controllers\Admin\CountDashboardController::class, 'index'])->name('count');

    Route::match(['get', 'post'], '/count/create', [App\Http\Controllers\Admin\CountDashboardController::class, 'create'])->name('count.create');

    Route::match(['get', 'post'], '/count/edit/{id}', [App\Http\Controllers\Admin\CountDashboardController::class, 'edit'])->name('count.edit');

    //AboutUs
    Route::get('/about-us', [App\Http\Controllers\Admin\AboutUsController::class, 'index'])->name('about-us');

    Route::match(['get', 'post'], '/about-us/create', [App\Http\Controllers\Admin\AboutUsController::class, 'create'])->name('about-us.create');

    Route::match(['get', 'post'], '/about-us/edit/{id}', [App\Http\Controllers\Admin\AboutUsController::class, 'edit'])->name('about-us.edit');
    ///////why know merit//////

    Route::get('/whyknowmerits', [App\Http\Controllers\Admin\WhyKnowMeritController::class, 'index'])->name('whyknowmerits');

    Route::match(['get', 'post'], '/whyknowmerits/create', [App\Http\Controllers\Admin\WhyKnowMeritController::class, 'create'])->name('whyknowmerits.create');

    Route::match(['get', 'post'], '/whyknowmerits/edit/{id}', [App\Http\Controllers\Admin\WhyKnowMeritController::class, 'edit'])->name('whyknowmerits.edit');


    //referral ////

    Route::get('/referral', [App\Http\Controllers\Admin\ReferralController::class, 'index'])->name('referral');

    Route::match(['get', 'post'], '/referral/create', [App\Http\Controllers\Admin\ReferralController::class, 'create'])->name('referral.create');

    Route::match(['get', 'post'], '/referral/edit/{id}', [App\Http\Controllers\Admin\ReferralController::class, 'edit'])->name('referral.edit');

    /////contact us /////
    Route::get('/contact_sec_fsts', [App\Http\Controllers\Admin\ContactSecFstController::class, 'index'])->name('contact_sec_fsts');

    Route::match(['get', 'post'], '/contact_sec_fsts/create', [App\Http\Controllers\Admin\ContactSecFstController::class, 'create'])->name('contact_sec_fsts.create');

    Route::match(['get', 'post'], '/contact_sec_fsts/edit/{id}', [App\Http\Controllers\Admin\ContactSecFstController::class, 'edit'])->name('contact_sec_fsts.edit');
    /////contact us section two /////
    Route::get('/contact_sec_scnds', [App\Http\Controllers\Admin\ContactSecScndController::class, 'index'])->name('contact_sec_scnds');

    Route::match(['get', 'post'], '/contact_sec_scnds/create', [App\Http\Controllers\Admin\ContactSecScndController::class, 'create'])->name('contact_sec_scnds.create');

    Route::match(['get', 'post'], '/contact_sec_scnds/edit/{id}', [App\Http\Controllers\Admin\ContactSecScndController::class, 'edit'])->name('contact_sec_scnds.edit');

    ///////////contactheader///////////
    Route::get('/contact_headers', [App\Http\Controllers\Admin\ContactHeaderController::class, 'index'])->name('contact_headers');

    Route::match(['get', 'post'], '/contact_headers/create', [App\Http\Controllers\Admin\ContactHeaderController::class, 'create'])->name('contact_headers.create');

    Route::match(['get', 'post'], '/contact_headers/edit/{id}', [App\Http\Controllers\Admin\ContactHeaderController::class, 'edit'])->name('contact_headers.edit');
    ///////contact master////////
    Route::get('/contact_masters', [App\Http\Controllers\Admin\ContactMasterController::class, 'index'])->name('contact_masters');

    Route::match(['get', 'post'], '/contact_masters/create', [App\Http\Controllers\Admin\ContactMasterController::class, 'create'])->name('contact_masters.create');

    Route::match(['get', 'post'], '/contact_masters/edit/{id}', [App\Http\Controllers\Admin\ContactMasterController::class, 'edit'])->name('contact_masters.edit');
    //write-a-review
    Route::get('/write-a-review', [App\Http\Controllers\Admin\WriteReviewController::class, 'index'])->name('write-a-review');

    Route::get('/enquiery', [App\Http\Controllers\ContactUsController::class, 'index'])->name('enquiery');
    Route::get('/contact-view', [App\Http\Controllers\ContactUsController::class, 'view'])->name('contact-view');

    Route::match(['get', 'post'], '/write-a-review/view/{id}', [App\Http\Controllers\Admin\WriteReviewController::class, 'view'])->name('write-a-review.view');

    //blog
    Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('blog');
    Route::match(['get', 'post'], '/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('blog.create');
    Route::match(['get', 'post'], '/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('blog.edit');

    Route::get('/replacepage', [App\Http\Controllers\Admin\TutorController::class, 'replacepage'])->name('replacepage');

    //testimonials
    Route::get('/testimonial', [App\Http\Controllers\Admin\TestimonialController::class, 'index'])->name('testimonial');

    Route::match(['get', 'post'], '/testimonial/create', [App\Http\Controllers\Admin\TestimonialController::class, 'create'])->name('testimonial.create');

    Route::match(['get', 'post'], '/testimonial/edit/{id}', [App\Http\Controllers\Admin\TestimonialController::class, 'edit'])->name('testimonial.edit');

    //ManageBanner
    Route::get('/manage-banner', [App\Http\Controllers\Admin\ManageBannerController::class, 'index'])->name('manage-banner');

    Route::match(['get', 'post'], '/manage-banner/create', [App\Http\Controllers\Admin\ManageBannerController::class, 'create'])->name('manage-banner.create');

    Route::match(['get', 'post'], '/manage-banner/edit/{id}', [App\Http\Controllers\Admin\ManageBannerController::class, 'edit'])->name('manage-banner.edit');


    //managepage
    Route::get('/manage-page', [App\Http\Controllers\Admin\ManagePageController::class, 'index'])->name('manage-page');

    Route::match(['get', 'post'], '/manage-page/create', [App\Http\Controllers\Admin\ManagePageController::class, 'create'])->name('manage-page.create');

    Route::match(['get', 'post'], '/manage-page/edit/{id}', [App\Http\Controllers\Admin\ManagePageController::class, 'edit'])->name('manage-page.edit');

    //featureds
    Route::get('/featured', [App\Http\Controllers\Admin\FeaturedController::class, 'index'])->name('featured');

    Route::match(['get', 'post'], '/featured/create', [App\Http\Controllers\Admin\FeaturedController::class, 'create'])->name('featured.create');

    Route::match(['get', 'post'], '/featured/edit/{id}', [App\Http\Controllers\Admin\FeaturedController::class, 'edit'])->name('featured.edit');

    //footer menu
    Route::get('/footer', [App\Http\Controllers\Admin\FooterController::class, 'index'])->name('footer');

    Route::match(['get', 'post'], '/footer/create', [App\Http\Controllers\Admin\FooterController::class, 'create'])->name('footer.create');

    Route::match(['get', 'post'], '/footer/edit/{id}', [App\Http\Controllers\Admin\FooterController::class, 'edit'])->name('footer.edit');

    // membership-teacher
    Route::get('/membership-teacher', [App\Http\Controllers\Admin\MembershipTeacherController::class, 'index'])->name('membership.teacher');

    Route::match(['get', 'post'], '/membership-teacher/create', [App\Http\Controllers\Admin\MembershipTeacherController::class, 'create'])->name('membership-teacher.create');

    Route::match(['get', 'post'], '/membership-teacher/edit/{id}', [App\Http\Controllers\Admin\MembershipTeacherController::class, 'edit'])->name('membership-teacher.edit');

    Route::get('/mcq', [App\Http\Controllers\Admin\McqController::class, 'index'])->name('mcq');
    Route::match(['get', 'post'], '/mcq/create', [App\Http\Controllers\Admin\McqController::class, 'create'])->name('mcq.create');
    Route::match(['get', 'post'], '/mcq/edit/{id}', [App\Http\Controllers\Admin\McqController::class, 'edit'])->name('mcq.edit');

    Route::get('/booking', [App\Http\Controllers\Admin\BookingController::class, 'index'])->name('booking');
    Route::get('/payment', [App\Http\Controllers\Admin\BookingController::class, 'index1'])->name('payment');
    Route::get('/schedule-class', function () {
        return view('admin.book-class.create');
    });
    Route::get('/t_attendace', [App\Http\Controllers\Admin\BookingController::class, 'index2'])->name('t_attendace');
    Route::get('/s_attendace', [App\Http\Controllers\Admin\BookingController::class, 'index3'])->name('s_attendace');
    Route::get('/student-class', [App\Http\Controllers\Admin\BookingController::class, 'studentdetails'])->name('student-class');

    Route::get('/cal', [App\Http\Controllers\Admin\BookingController::class, 'cal_data'])->name('cal');
    Route::get('/student-book-session', [App\Http\Controllers\Admin\BookingController::class, 'book_session'])->name('book.session');
    Route::get('/student-to-merithub/{id}', [App\Http\Controllers\Admin\BookingController::class, 'merithub_create_class'])->name('book.session.merithub');
    ///////calender////////////////
    //////////////Bokking Demo///////////////


    Route::get('/issue', [App\Http\Controllers\Admin\BookingController::class, 'index4'])->name('issue');



    Route::get('/booking', [App\Http\Controllers\Admin\BookingDemoController::class, 'index'])->name('booking');
    // Route::get('/payment',[App\Http\Controllers\Admin\BookingDemoController::class, 'index1'])->name('payment');
    Route::get('/schedule-class1', function () {
        return view('admin.book-class.create1');
    });
    Route::get('/student-class', [App\Http\Controllers\Admin\BookingDemoController::class, 'studentdetails'])->name('student-class');

    Route::get('/cal', [App\Http\Controllers\Admin\BookingDemoController::class, 'cal_data1'])->name('cal');
    Route::get('/student-book-session', [App\Http\Controllers\Admin\BookingDemoController::class, 'book_session1'])->name('book.session');
    Route::get('/student-to-merithub/{id}', [App\Http\Controllers\Admin\BookingDemoController::class, 'merithub_create_class'])->name('book.session.merithub');


    //////////EndBokking demo///////////////
    Route::get('/course-bank', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('course-bank');
    Route::get('/course-bankt', [App\Http\Controllers\Admin\CourseController::class, 'indext'])->name('course-bankt');

    Route::Post('/assign-course', [App\Http\Controllers\Admin\CourseController::class, 'assignteacher'])->name('assign-course');
    Route::get('/view-course/{id}', [App\Http\Controllers\Admin\CourseController::class, 'index3'])->name('view-course');
    Route::get('/edit-course/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('edit-course');
    Route::post('/update-course', [App\Http\Controllers\Admin\CourseController::class, 'update'])->name('update-course');
    Route::post('/delete-course', [App\Http\Controllers\Admin\CourseController::class, 'delcourse'])->name('delete-course');
    Route::get('/add-lession/{id}', [App\Http\Controllers\Admin\CourseController::class, 'index1'])->name('add-lession');
    Route::post('/create-lession', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('create-lession');
    Route::get('/course-details12/{id}', [App\Http\Controllers\Admin\CourseController::class, 'c_details1'])->name('course-details12');
    Route::post('/create-lecture', [App\Http\Controllers\Admin\CourseController::class, 'createlecture'])->name('create-lecture');
    Route::post('/delete-lession', [App\Http\Controllers\Admin\CourseController::class, 'dellession'])->name('delete-lession');
    Route::post('/delete-lecture', [App\Http\Controllers\Admin\CourseController::class, 'dellecture'])->name('delete-lecture');
    Route::get('/edit-lession', [App\Http\Controllers\Admin\CourseController::class, 'editlession'])->name('edit-lession');
    Route::Post('/edit-lession1/{id}', [App\Http\Controllers\Admin\CourseController::class, 'editlession1'])->name('edit-lession1');
    Route::get('/preview/{id}', [App\Http\Controllers\Admin\CourseController::class, 'preview'])->name('preview');
    Route::post('/create-iframe', [App\Http\Controllers\Admin\CourseController::class, 'iframeCreate'])->name('create-iframe');
    Route::post('/create-presentaion', [App\Http\Controllers\Admin\CourseController::class, 'iframePresentaion'])->name('create-presentaion');
    Route::post('/create-assign', [App\Http\Controllers\Admin\CourseController::class, 'iframeAssign'])->name('create-assign');
    Route::post('/create-scrom', [App\Http\Controllers\Admin\CourseController::class, 'ScromCreate'])->name('create-scrom');
    Route::post('/create-quiz', [App\Http\Controllers\Admin\CourseController::class, 'quizCreate'])->name('create-quiz');
    Route::post('/create-web', [App\Http\Controllers\Admin\CourseController::class, 'webCreate'])->name('create-web');

    Route::get('/edit-lecture', [App\Http\Controllers\Admin\CourseController::class, 'editlecture'])->name('edit-lecture');
    Route::Post('/edit-lecture1/{id}', [App\Http\Controllers\Admin\CourseController::class, 'editlecture1'])->name('edit-lecture1');
    Route::get('/edit-data', [App\Http\Controllers\Admin\CourseController::class, 'editdata'])->name('edit-data');
    Route::post('/update-iframe', [App\Http\Controllers\Admin\CourseController::class, 'updateiframe'])->name('update-iframe');
    Route::get('/edit-presentation', [App\Http\Controllers\Admin\CourseController::class, 'editpresentation'])->name('edit-presentation');
    Route::post('/update-presentation', [App\Http\Controllers\Admin\CourseController::class, 'updatepresentation'])->name('update-presentation');
    Route::get('/edit-assign', [App\Http\Controllers\Admin\CourseController::class, 'editassign'])->name('edit-assign');
    Route::post('/update-assign', [App\Http\Controllers\Admin\CourseController::class, 'updateassign'])->name('update-assign');
    Route::get('/edit-quiz', [App\Http\Controllers\Admin\CourseController::class, 'editquiz'])->name('edit-quiz');
    Route::post('/update-quiz', [App\Http\Controllers\Admin\CourseController::class, 'updatequiz'])->name('update-quiz');
    Route::get('/edit-web', [App\Http\Controllers\Admin\CourseController::class, 'editweb'])->name('edit-web');
    Route::post('/update-web', [App\Http\Controllers\Admin\CourseController::class, 'updateweb'])->name('update-web');
    Route::get('/edit-audio', [App\Http\Controllers\Admin\CourseController::class, 'editaudio'])->name('edit-audio');
    Route::post('/update-audio', [App\Http\Controllers\Admin\CourseController::class, 'updateaudio'])->name('update-audio');
    Route::get('/edit-video', [App\Http\Controllers\Admin\CourseController::class, 'editvideo'])->name('edit-video');
    Route::post('/update-video', [App\Http\Controllers\Admin\CourseController::class, 'updatevideo'])->name('update-video');
    Route::get('/edit-scrom', [App\Http\Controllers\Admin\CourseController::class, 'editscrom'])->name('edit-scrom');
    Route::post('/update-scrom', [App\Http\Controllers\Admin\CourseController::class, 'updatescrom'])->name('update-scrom');
    Route::post('/delete-data', [App\Http\Controllers\Admin\CourseController::class, 'deldata'])->name('delete-data');

    Route::post('/create-lession1', [App\Http\Controllers\Admin\CourseController::class, 'create1'])->name('create-lession1');

    Route::get('/d-iframe', [App\Http\Controllers\Admin\CourseController::class, 'diframe'])->name('d-iframe');
    Route::get('/d-presentation', [App\Http\Controllers\Admin\CourseController::class, 'dpresentation'])->name('d-presentation');
    Route::get('/d-assign', [App\Http\Controllers\Admin\CourseController::class, 'dAssign'])->name('d-assign');
    Route::get('/d-scrom', [App\Http\Controllers\Admin\CourseController::class, 'dScrom'])->name('d-scrom');
    Route::get('/d-quiz', [App\Http\Controllers\Admin\CourseController::class, 'dQuiz'])->name('d-quiz');
    Route::get('/d-web', [App\Http\Controllers\Admin\CourseController::class, 'dWeb'])->name('d-web');

    Route::get('/d-video', [App\Http\Controllers\Admin\CourseController::class, 'dvideo'])->name('d-video');
    Route::get('/d-audio', [App\Http\Controllers\Admin\CourseController::class, 'daudio'])->name('d-audio');
    Route::post('/create-video', [App\Http\Controllers\Admin\CourseController::class, 'createv'])->name('create-video');
    Route::get('/add-video/{id}', [App\Http\Controllers\Admin\CourseController::class, 'c_video'])->name('add-video');
    Route::post('/delete-video', [App\Http\Controllers\Admin\CourseController::class, 'delvideo'])->name('delete-video');
    // Route::get('/add-video', function () {
    //     return view('front.Admin.add-video');
    // });
    Route::post('/delete-audio', [App\Http\Controllers\Admin\CourseController::class, 'delaudio'])->name('delete-audio');
    Route::post('/create-audio', [App\Http\Controllers\Admin\CourseController::class, 'createa'])->name('create-audio');
    Route::get('/add-audio/{id}', [App\Http\Controllers\Admin\CourseController::class, 'c_audio'])->name('add-audio');

});

Route::get('like-dislike', [App\Http\Controllers\Admin\CommunityController::class, 'likes'])->name('like.dislike');

//student
Route::group(['prefix' => 'student', 'as' => 'student.', 'middleware' => ['Student']], function () {
    Route::get('/change-password', [App\Http\Controllers\student\ChangePassController::class, 'changePassword'])->name('change-password');
    Route::post('/update-password', [App\Http\Controllers\student\ChangePassController::class, 'updatePassword'])->name('update-password');
    Route::get('/teacher', [App\Http\Controllers\StudentController::class, 'teacher'])->name('teacher');
    Route::get('/student-book-session', [App\Http\Controllers\StudentController::class, 'book_session'])->name('book.session');
    Route::get('/student-to-merithub/{id}', [App\Http\Controllers\StudentController::class, 'merithub_create_class'])->name('book.session.merithub');
    Route::get('/dash', [App\Http\Controllers\StudentController::class, 'dash'])->name('dash');
    Route::get('/student-dashboard', [App\Http\Controllers\student\StudentController::class, 'studentdashboard'])->name('student-dashboard');

    Route::get('/math-pad', [App\Http\Controllers\student\StudentController::class, 'mathpad'])->name('math-pad');
    Route::post('/student/deactivate', [App\Http\Controllers\student\StudentController::class, 'index'])->name('deactive');

    Route::get('/test-quiz-list/{id}', function () {
        return view('front.student.test-quiz-list');
    });
    Route::get('/question-list', function () {
        return view('front.student.question-list');
    });
    // Route::get('/student-profile', function () {
    //     return view('front.student.profile');
    // });
    Route::get('/cal123', [App\Http\Controllers\student\CalenderController::class, 'cal_data'])->name('cal123');
    Route::get('/teacher-book-session1', [App\Http\Controllers\student\CalenderController::class, 'book_session'])->name('book.session1');
    //////////////Student class//////////////

    Route::get('/r_student-book-session', [App\Http\Controllers\StudentController::class, 'r_book_session'])->name('r_book.session');
    Route::get('/r_student-to-merithub/{id}', [App\Http\Controllers\StudentController::class, 'r_merithub_create_class'])->name('r_book.session.merithub');
    ///////calender////////////////
    // Route::get('/math-pad', function () {
    //     return view('front.student.math');
    // });
    Route::get('/student-learning', function () {
        return view('front.student.learning');
    });
    Route::get('/student-my-class', function () {
        return view('front.student.my-class');
    });
    Route::get('/student-chat', function () {
        return view('front.student.chat');
    });
    Route::get('/student-refer-earn', function () {
        return view('front.student.refer-earn');
    });
    Route::get('/student-setting', function () {
        return view('front.student.setting');
    });
    Route::post('/send-referral-email', [App\Http\Controllers\StudentController::class, 'sendReferralEmail'])->name('send-referral-email');

    Route::get('/course-details', function () {
        return view('front.student.course-details');
    });
    Route::get('/front.student.profile', [App\Http\Controllers\StudentController::class, 'student_profile_edit_img'])->name('student_profile_edit_img');
    Route::post('/student_profile_update_img', [App\Http\Controllers\StudentController::class, 'student_profile_update_img'])->name('student_profile_update_img');
    Route::get('/student-profile', [App\Http\Controllers\StudentController::class, 'student_profile_edit'])->name('front.student.profile');
    Route::post('/student_profile_update', [App\Http\Controllers\StudentController::class, 'student_profile_update'])->name('student_profile_update');
    Route::post('/student-settings/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student-settings.create');
    Route::post('/timezone/create', [App\Http\Controllers\StudentController::class, 'timezone'])->name('timezone.create');
    Route::post('/timezone1/create', [App\Http\Controllers\StudentController::class, 'timezone1'])->name('timezone1.create');

    Route::post('/student-settings/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student-settings.create');
    Route::post('/timezone/create', [App\Http\Controllers\StudentController::class, 'timezone'])->name('timezone.create');

    Route::get('/mcqs/{id}', [App\Http\Controllers\student\StudentController::class, 'mcqs'])->name('mcqs');
    Route::post('/mcq/create', [App\Http\Controllers\student\StudentController::class, 'create'])->name('mcq.create');

    Route::get('/class-meeting/{id}', [App\Http\Controllers\student\StudentController::class, 'classmeeting'])->name('class-meeting');
    Route::get('/cancleclass', [App\Http\Controllers\StudentController::class, 'cancleclass'])->name('cancleclass');

    Route::get('/mcqs-list', function () {
        return view('front.student.mcq-list');
    });
    // Route::get('/mcqs', function () {
    //     return view('front.student.mcqs');
    // });

    Route::get('/course-details1/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'c_details'])->name('course-details1');

    Route::get('/preview/{id}', [App\Http\Controllers\student\CourseController::class, 'preview'])->name('preview');
    Route::get('/preview1/{id}', [App\Http\Controllers\student\CourseController::class, 'preview1'])->name('preview1');
    Route::get('/d-iframe1', [App\Http\Controllers\student\CourseController::class, 'diframe1'])->name('d-iframe1');

    Route::get('/d-video', [App\Http\Controllers\student\CourseController::class, 'dvideo'])->name('d-video');
    Route::get('/d-audio', [App\Http\Controllers\student\CourseController::class, 'daudio'])->name('d-audio');
    Route::get('/d-iframe', [App\Http\Controllers\student\CourseController::class, 'diframe'])->name('d-iframe');
    Route::get('/d-presentation', [App\Http\Controllers\student\CourseController::class, 'dpresentation'])->name('d-presentation');
    Route::get('/d-assign', [App\Http\Controllers\student\CourseController::class, 'dAssign'])->name('d-assign');
    Route::get('/d-scrom', [App\Http\Controllers\student\CourseController::class, 'dScrom'])->name('d-scrom');
    Route::get('/d-quiz', [App\Http\Controllers\student\CourseController::class, 'dQuiz'])->name('d-quiz');
    Route::get('/d-web', [App\Http\Controllers\student\CourseController::class, 'dWeb'])->name('d-web');
    Route::get('/d-compt', [App\Http\Controllers\student\CourseController::class, 'compt'])->name('d-compt');

    Route::post('/d-complete', [App\Http\Controllers\student\CourseController::class, 'dComplete'])->name('d-complete');

    Route::post('/answer-submit', [App\Http\Controllers\student\QuestionAnswerController::class, 'ans'])->name('answer-submit');
    Route::get('/pre-page', [App\Http\Controllers\student\QuestionAnswerController::class, 'index'])->name('pre-page');
    Route::get('/question-preview/{id}', [App\Http\Controllers\student\QuestionAnswerController::class, 'index1'])->name('question-preview');
    Route::get('/result', [App\Http\Controllers\student\QuestionAnswerController::class, 'result'])->name('result');
    Route::get('/submit-preview', [App\Http\Controllers\student\QuestionAnswerController::class, 'submitPreview'])->name('submit-preview');

    Route::get('/editor', [App\Http\Controllers\student\EditorController::class, 'Editor'])->name('editor');

    Route::post('/reason', [App\Http\Controllers\student\StudentController::class, 'addreason'])->name('reason');

    Route::get('/attendance', function () {
        return view('front.student.attendace');
    });
});
//teacher
Route::group(['prefix' => 'teacher', 'as' => 'teacher.', 'middleware' => ['Teacher']], function () {

    Route::get('/student_booking_demo', [App\Http\Controllers\Teacher\BookADemoStudentController::class, 'student_booking_demo'])->name('student_booking_demo');
    Route::get('/student_cal', [App\Http\Controllers\Teacher\BookADemoStudentController::class, 'student_cal_data'])->name('student.cal');
    Route::get('/student1-to-merithub/{id}', [App\Http\Controllers\Teacher\BookADemoStudentController::class, 'student_merithub_create_class'])->name('student.book.session.merithub');

    Route::get('/community', [App\Http\Controllers\Teacher\CommunityController::class, 'index'])->name('community');
    Route::match(['get', 'post'], '/community/create', [App\Http\Controllers\Teacher\CommunityController::class, 'create'])->name('community.create');
    Route::match(['get', 'post'], '/community/edit/{id}', [App\Http\Controllers\Teacher\CommunityController::class, 'edit'])->name('community.edit');
    Route::get('/change-password', [App\Http\Controllers\Teacher\ChangePasswordController::class, 'changePassword'])->name('change-password');
    Route::post('/update-password', [App\Http\Controllers\Teacher\ChangePasswordController::class, 'updatePassword'])->name('update-password');
    Route::match(['get', 'post'], '/payment', [App\Http\Controllers\Teacher\PaymentController::class, 'create'])->name('payment');
    Route::get('/cal', [App\Http\Controllers\Teacher\TeacherController::class, 'cal_data'])->name('cal');
    Route::get('/r_cal', [App\Http\Controllers\Teacher\TeacherController::class, 'r_cal_data'])->name('r_cal');

    Route::get('calendar/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'calendar'])->name('calendar');
    Route::post('/availability-update/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'availabilityUpdate'])->name('availability.update');

    Route::get('/paysuccessteacher', [App\Http\Controllers\Teacher\CoinsHistoryController::class, 'razorPaySuccess5']);
    Route::get('/dash', [App\Http\Controllers\Teacher\TeacherController::class, 'dash'])->name('dash');
    Route::post('/video-store', [App\Http\Controllers\Teacher\TeacherController::class, 'vstore'])->name('video-store');
    Route::post('/doc-store', [App\Http\Controllers\Teacher\TeacherController::class, 'dstore'])->name('doc-store');

    Route::match(['get', 'post'], '/teacher-profile/edit/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'teacherEdit'])->name('dashboard.tutor.edit');
    Route::match(['get', 'post'], '/institute-profile/edit/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'instituteEdit'])->name('dashboard.institute.edit');

    Route::get('/mcq-list', [App\Http\Controllers\Teacher\TeacherController::class, 'mcqlist'])->name('mcq-list');
    Route::post('/mcq-store', [App\Http\Controllers\Teacher\TeacherController::class, 'mcqstore'])->name('mcq-store');

    Route::post('/timezone/create', [App\Http\Controllers\TutorController::class, 'timezone2'])->name('timezone.create');
    Route::post('/timezone2/create', [App\Http\Controllers\TutorController::class, 'timezone3'])->name('timezone2.create');

    Route::get('/front.teacher.profile', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_profile_edit_img'])->name('student_teacher_edit_img');
    Route::post('/teacher_profile_update_img', [App\Http\Controllers\Teacher\TeacherController::class, 'teacher_profile_update_img'])->name('teacher_profile_update_img');

    Route::get('/mcqs/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'mcqs'])->name('mcqs');

    Route::get('/class-meeting/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'classmeeting'])->name('class-meeting');

    Route::post('/teacher/deactivate', [App\Http\Controllers\Teacher\TeacherController::class, 'index'])->name('deactive');
    Route::get('/teacher-dashboard', function () {
        return view('front.teacher.dashboard');
    });
    Route::get('/teacher-instructor-dashboard', function () {
        return view('front.teacher.instructor-dashboard');
    });
    Route::get('/enquiry', function () {
        return view('front.teacher.enquiry');
    });
    Route::get('/teacher-profile', function () {
        return view('front.teacher.profile');
    });
    Route::get('/institute-profile', function () {
        return view('front.teacher.profile-institute');
    });
    Route::get('/dashboard-community', function () {
        return view('front.teacher.dashboard-community');
    });

    Route::get('/add-community', function () {
        return view('front.teacher.add-community');
    });
    Route::get('/teacher-my-membership', function () {
        return view('front.teacher.my-membership');
    });
    Route::get('/add-membership', function () {
        return view('front.teacher.add_membership');
    });
    Route::get('/teacher-coins-history', function () {
        return view('front.teacher.coins-history');
    });
    Route::get('/teacher-setting', function () {
        return view('front.teacher.setting');
    });

    Route::get('/student', function () {
        return view('front.teacher.student');
    });
    Route::get('/book-a-demo', function () {
        return view('front.teacher.bookademostudent');
    });
    Route::get('/payment-list', function () {
        return view('front.teacher.payment-list');
    });
    Route::post('/create-video', [App\Http\Controllers\Teacher\CourseController::class, 'createv'])->name('create-video');
    Route::get('/add-video/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'c_video'])->name('add-video');
    Route::post('/delete-video', [App\Http\Controllers\Teacher\CourseController::class, 'delvideo'])->name('delete-video');
    // Route::get('/add-video', function () {
    //     return view('front.teacher.add-video');
    // });
    Route::post('/delete-audio', [App\Http\Controllers\Teacher\CourseController::class, 'delaudio'])->name('delete-audio');
    Route::post('/create-audio', [App\Http\Controllers\Teacher\CourseController::class, 'createa'])->name('create-audio');
    Route::get('/add-audio/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'c_audio'])->name('add-audio');
    // Route::get('/add-audio', function () {
    //     return view('front.teacher.add-audio');
    // });
    Route::get('/dash1', [App\Http\Controllers\Teacher\TeacherController::class, 'dash1'])->name('dash1');
    Route::get('/cal', [App\Http\Controllers\Teacher\TeacherController::class, 'cal_data'])->name('cal');
    Route::get('/teacher-book-session', [App\Http\Controllers\Teacher\TeacherController::class, 'book_session'])->name('book.session');
    Route::get('/r_teacher-book-session', [App\Http\Controllers\Teacher\TeacherController::class, 'r_book_session'])->name('r_book.session');
    Route::get('/math-pad', [App\Http\Controllers\Teacher\TeacherController::class, 'mathpad'])->name('math-pad');
    Route::get('/cancleclass', [App\Http\Controllers\Teacher\TeacherController::class, 'cancleclass'])->name('cancleclass');

    Route::get('/student-to-merithub/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'merithub_create_class'])->name('book.session.merithub');
    Route::get('/r_student-to-merithub/{id}', [App\Http\Controllers\Teacher\TeacherController::class, 'r_merithub_create_class'])->name('r_book.session.merithub');

    // Route::get('/add-lession', function () {
    //     return view('front.teacher.add-lession');
    // });
    Route::get('/edit-course/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'edit'])->name('edit-course');
    Route::post('/update-course', [App\Http\Controllers\Teacher\CourseController::class, 'update'])->name('update-course');
    Route::post('/delete-course', [App\Http\Controllers\Teacher\CourseController::class, 'delcourse'])->name('delete-course');
    Route::get('/add-lession/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'index'])->name('add-lession');
    Route::post('/create-lession', [App\Http\Controllers\Teacher\CourseController::class, 'create'])->name('create-lession');
    Route::get('/course-details12/{st_id}/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'c_details1'])->name('course-details12');
    Route::post('/create-lecture', [App\Http\Controllers\Teacher\CourseController::class, 'createlecture'])->name('create-lecture');
    Route::post('/delete-lession', [App\Http\Controllers\Teacher\CourseController::class, 'dellession'])->name('delete-lession');
    Route::post('/delete-lecture', [App\Http\Controllers\Teacher\CourseController::class, 'dellecture'])->name('delete-lecture');
    Route::get('/edit-lession', [App\Http\Controllers\Teacher\CourseController::class, 'editlession'])->name('edit-lession');
    Route::Post('/edit-lession1/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'editlession1'])->name('edit-lession1');
    Route::get('/preview/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'preview'])->name('preview');
    Route::get('/preview1/{st_id}/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'preview1'])->name('preview1');
    Route::post('/create-iframe', [App\Http\Controllers\Teacher\CourseController::class, 'iframeCreate'])->name('create-iframe');
    Route::post('/create-presentaion', [App\Http\Controllers\Teacher\CourseController::class, 'iframePresentaion'])->name('create-presentaion');
    Route::post('/create-assign', [App\Http\Controllers\Teacher\CourseController::class, 'iframeAssign'])->name('create-assign');
    Route::post('/create-scrom', [App\Http\Controllers\Teacher\CourseController::class, 'ScromCreate'])->name('create-scrom');
    Route::post('/create-quiz', [App\Http\Controllers\Teacher\CourseController::class, 'quizCreate'])->name('create-quiz');
    Route::post('/create-web', [App\Http\Controllers\Teacher\CourseController::class, 'webCreate'])->name('create-web');
    Route::post('/course-assign', [App\Http\Controllers\Teacher\CourseController::class, 'courseAssign'])->name('course-assign');

    Route::get('/edit-lecture', [App\Http\Controllers\Teacher\CourseController::class, 'editlecture'])->name('edit-lecture');
    Route::Post('/edit-lecture1/{id}', [App\Http\Controllers\Teacher\CourseController::class, 'editlecture1'])->name('edit-lecture1');
    Route::get('/edit-data', [App\Http\Controllers\Teacher\CourseController::class, 'editdata'])->name('edit-data');
    Route::get('/edit-data1', [App\Http\Controllers\Teacher\CourseController::class, 'editdata1'])->name('edit-data1');
    Route::post('/update-game', [App\Http\Controllers\Teacher\CourseController::class, 'updategame'])->name('update-game');

    Route::post('/update-iframe', [App\Http\Controllers\Teacher\CourseController::class, 'updateiframe'])->name('update-iframe');
    Route::get('/edit-presentation', [App\Http\Controllers\Teacher\CourseController::class, 'editpresentation'])->name('edit-presentation');
    Route::post('/update-presentation', [App\Http\Controllers\Teacher\CourseController::class, 'updatepresentation'])->name('update-presentation');
    Route::get('/edit-assign', [App\Http\Controllers\Teacher\CourseController::class, 'editassign'])->name('edit-assign');
    Route::post('/update-assign', [App\Http\Controllers\Teacher\CourseController::class, 'updateassign'])->name('update-assign');
    Route::get('/edit-quiz', [App\Http\Controllers\Teacher\CourseController::class, 'editquiz'])->name('edit-quiz');
    Route::post('/update-quiz', [App\Http\Controllers\Teacher\CourseController::class, 'updatequiz'])->name('update-quiz');
    Route::get('/edit-web', [App\Http\Controllers\Teacher\CourseController::class, 'editweb'])->name('edit-web');
    Route::post('/update-web', [App\Http\Controllers\Teacher\CourseController::class, 'updateweb'])->name('update-web');
    Route::get('/edit-audio', [App\Http\Controllers\Teacher\CourseController::class, 'editaudio'])->name('edit-audio');
    Route::post('/update-audio', [App\Http\Controllers\Teacher\CourseController::class, 'updateaudio'])->name('update-audio');
    Route::get('/edit-video', [App\Http\Controllers\Teacher\CourseController::class, 'editvideo'])->name('edit-video');
    Route::post('/update-video', [App\Http\Controllers\Teacher\CourseController::class, 'updatevideo'])->name('update-video');
    Route::get('/edit-scrom', [App\Http\Controllers\Teacher\CourseController::class, 'editscrom'])->name('edit-scrom');
    Route::post('/update-scrom', [App\Http\Controllers\Teacher\CourseController::class, 'updatescrom'])->name('update-scrom');

    Route::post('/create-lession1', [App\Http\Controllers\Teacher\CourseController::class, 'create1'])->name('create-lession1');

    Route::get('/d-iframe', [App\Http\Controllers\Teacher\CourseController::class, 'diframe'])->name('d-iframe');
    Route::get('/d-iframe1', [App\Http\Controllers\Teacher\CourseController::class, 'diframe1'])->name('d-iframe1');

    Route::get('/d-presentation', [App\Http\Controllers\Teacher\CourseController::class, 'dpresentation'])->name('d-presentation');
    Route::get('/d-assign', [App\Http\Controllers\Teacher\CourseController::class, 'dAssign'])->name('d-assign');
    Route::get('/d-scrom', [App\Http\Controllers\Teacher\CourseController::class, 'dScrom'])->name('d-scrom');
    Route::get('/d-quiz', [App\Http\Controllers\Teacher\CourseController::class, 'dQuiz'])->name('d-quiz');
    Route::get('/d-web', [App\Http\Controllers\Teacher\CourseController::class, 'dWeb'])->name('d-web');

    Route::get('/d-video', [App\Http\Controllers\Teacher\CourseController::class, 'dvideo'])->name('d-video');
    Route::get('/d-audio', [App\Http\Controllers\Teacher\CourseController::class, 'daudio'])->name('d-audio');
    Route::get('/question-answer/{id}', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'index'])->name('question-answer');
    Route::post('/welcome/create', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'create'])->name('welcome.create');
    Route::post('/single_choice/create', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'single_create'])->name('single_choice.create');
    Route::get('/q_page', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'page'])->name('q_page');
    Route::post('/student/assign', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'assign'])->name('student.assign');
    Route::post('/delete-question', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'delquestion'])->name('delete-question');
    Route::post('/delete-page', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'delpage'])->name('delete-page');
    Route::get('/editq', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'editq'])->name('editq');
    Route::post('/single_choice/edit/{id}', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'single_edit'])->name('single_choice.edit');

    Route::get('/question-preview/{id}', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'index1'])->name('question-preview');

    Route::get('/question-answer', function () {
        return view('front.teacher.question-answer');
    });
    Route::get('/attendance', function () {
        return view('front.teacher.attendace');
    });
    Route::get('/enqdata', [App\Http\Controllers\Teacher\TeacherController::class, 'enqdata'])->name('enqdata');

    Route::get('/question-list', function () {
        return view('front.teacher.question-list');
    });

    Route::post('/delete-data', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'deldata'])->name('delete-data');

    Route::post('/delete-quiz', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'delquiz'])->name('delete-quiz');
    // Route::get('/get_title/{id}', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'delquiz'])->name('get_title');

    Route::match(['get', 'post'], '/update_title/{id}', [App\Http\Controllers\Teacher\QuestionAnswerController::class, 'updateTitle'])->name('update_title');

    Route::post('/reason', [App\Http\Controllers\Teacher\TeacherController::class, 'addreason'])->name('reason');

    Route::post('/create-game', [App\Http\Controllers\Teacher\CourseController::class, 'gameCreate'])->name('create-game');

});
Route::post('community-comments', [App\Http\Controllers\Admin\CommunityController::class, 'create1'])->name('community.comments');
Route::post('comment', [App\Http\Controllers\Admin\CommunityController::class, 'index1'])->name('comment');
Route::get('/write-a-review', [App\Http\Controllers\Admin\WriteReviewController::class, 'writeReview'])->name('write-a-review');
Route::match(['get', 'post'], '/write-a-review/create', [App\Http\Controllers\Admin\WriteReviewController::class, 'create'])->name('write-a-review.create');
Route::get('/community', [App\Http\Controllers\Admin\CommunityController::class, 'community']);
Route::get('/about-us', [App\Http\Controllers\Admin\AboutUsController::class, 'about']);
Route::get('/faq', [App\Http\Controllers\Admin\FaqController::class, 'faq']);
Route::get('/faq-student', [App\Http\Controllers\Admin\FaqController::class, 'faqstudent']);
Route::get('/faq-teacher', [App\Http\Controllers\Admin\FaqController::class, 'faqteacher']);
Route::post('/contact-us', [App\Http\Controllers\ContactUsController::class, 'create'])->name('contact-us');
Route::get('/landingdatas', [App\Http\Controllers\Admin\LandingController::class, 'index'])->name('admin.landingdatas');


Route::get('/book-a-demo', function () {
    return view('front.book-a-demo');
});
///////////craete student/////////
Route::match(['get', 'post'], '/create-student', [App\Http\Controllers\StudentController::class, 'createstudent'])->name('front.student.create');
Route::match(['get', 'post'], '/create-student-nxt-step', [App\Http\Controllers\StudentController::class, 'createstudentnxtstep'])->name('front.student.createnxtstep');

///////////////////endd/////////

Route::get('/login1', function () {
    return view('front.login1');
});
Route::get('/login2', function () {
    return view('front.login2');
});
Route::get('/login2', function () {
    return view('front.login2');
});
Route::get('/paysuccessstudent', [App\Http\Controllers\student\BookADemoController::class, 'razorPaySuccess'])->name('razorPaySuccess');

Route::post('/checkstudent-email', [App\Http\Controllers\student\BookADemoController::class, 'checkstdEmail'])->name('checkstudent-email');

Route::post('/create_booking_class', [App\Http\Controllers\student\BookADemoController::class, 'create_booking_class'])->name('front.create_booking_class');
Route::get('/search', [App\Http\Controllers\student\BookADemoController::class, 'autosearch'])->name('search');

Route::post('/checkstudent-email', [App\Http\Controllers\StudentController::class, 'checkstudentEmail'])->name('checkstudent-email');
Route::post('/create_demo_class', [App\Http\Controllers\StudentController::class, 'create_demo_class'])->name('front.create_demo_class');
Route::get('/paysuccess', [App\Http\Controllers\StudentController::class, 'razorPaySuccess'])->name('razorPaySuccess');
Route::get('/paysuccesspayment', [App\Http\Controllers\StudentController::class, 'razorPaySuccesspayment']);

Route::get('/sub-category-list12', [App\Http\Controllers\StudentController::class, 'subCategoryList'])->name('student.sub-category-list');
//////////timezone//
Route::post('/timezone-list', [App\Http\Controllers\Admin\AjaxController::class, 'TimezoneList'])->name('timezone-list');

/////////timezone

Route::get('/cal', [App\Http\Controllers\StudentController::class, 'cal_data'])->name('cal');
Route::get('/r_cal', [App\Http\Controllers\StudentController::class, 'r_cal_data'])->name('r_cal');

Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'view'])->name('blog.view');
Route::get('/blogs/{id}', [App\Http\Controllers\Admin\BlogController::class, 'fetch'])->name('blogs');

Route::get('/test', [App\Http\Controllers\CurrencyController::class, 'currency'])->name('test');
Route::get('/contact-us', function () {
    return view('front.contact');
});
// Route::get('/terms-and-conditions', function () {
//     return view('front.terms-and-conditions');
// });
Route::get('/contact-us', function () {
    return view('front.contact');
});
//payment link
Route::get('paymentlink/{token}', [App\Http\Controllers\Teacher\PaymentController::class, 'ResetPassword'])->name('paymentlink');
Route::get('/paybook', [App\Http\Controllers\Teacher\PaymentController::class, 'paybook1']);
Route::get('/tutore-list', [App\Http\Controllers\Admin\AjaxController::class, 'tutore_list'])->name('tutore-list');

Route::post('/check-email', [App\Http\Controllers\TutorController::class, 'checkEmail'])->name('check-email');

Route::match(['get', 'post'], '/create-teacher', [App\Http\Controllers\TutorController::class, 'createIndivisual'])->name('front.tutor.create');
Route::match(['get', 'post'], '/create-institute', [App\Http\Controllers\TutorController::class, 'createInstitute'])->name('front.institute.create');
Route::get('/sub-category-list4', [App\Http\Controllers\TutorController::class, 'subCategoryList'])->name('front.sub-category-list');
Route::get('/sub-category-list-edit', [App\Http\Controllers\TutorController::class, 'subCategoryListEdit'])->name('front.sub-category-list-edit');
Route::get('/teacher/sub-category', [App\Http\Controllers\Admin\AjaxController::class, 'subCategoryList1'])->name('teacher.st.sub-category');

Route::get('/paysuccessteacher', [App\Http\Controllers\TutorController::class, 'razorPaySuccess1']);
Route::get('/paysuccessinstitute', [App\Http\Controllers\TutorController::class, 'razorPaySuccess2']);
Route::get('/trainer-list', function () {
    return view('front.trainer-list');
});
Route::get('/teacher/preview', function () {
    return view('front.teacher.preview');
});
Route::get('/instructor-profile', function () {
    return view('front.instructor-profile');
});
Route::get('/error', function () {
    return view('front.error-page');
});
Route::get('ct_page', [App\Http\Controllers\StudentController::class, 'session_view'])->name('ct_page');
Route::get('ct_pages', [App\Http\Controllers\StudentController::class, 'session_views'])->name('ct_pages');

Route::get('/test', function () {
    return view('test');
});
Route::get('/teacher/editor', function () {
    return view('front.teacher.editor');
});
////////////without login avalibility//////////
Route::get('/cal1234', [App\Http\Controllers\student\CalenderController::class, 'cal_data1'])->name('cal1234');
Route::get('/teacher-book-session112', [App\Http\Controllers\student\CalenderController::class, 'book_session1'])->name('book.session112');
///////////////////////////
Route::get('{slug}', [App\Http\Controllers\CommonController::class, 'fetch']);
