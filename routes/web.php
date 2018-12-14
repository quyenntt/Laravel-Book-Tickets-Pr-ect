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
//Client
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('about', function () {
    return view('client.page.about');
});
// About
Route::get('about', [
    'as' => 'about',
    'uses' => 'HomeController@getAbout'
]);
// End
//Hiển thị trnag contact
Route::get('addcontact',[
    'as'=>'contactsofcustomer', 
    'uses' =>'MailController@getContact'
]);

Route::post('addcontact',[
    'as'=>'contactsofcustomerpost',
    'uses' =>'MailController@postMail'
]);
//End Contact
//Events Client
Route::get('events/{id}',[
    'as' => 'events', 
    'uses' => 'EventController@getEvent'
]);
//Chi tiết sự kiện
Route::get('eventsdetail/{type}',[
    'as'=>'detailevents',
    'uses'=>'EventController@getDetailevent'
]);
//get sự kiện theo loại
Route::get('loaievent/{id}',[
    'as' => 'loaisanpham', 
    'uses' => 'TypeEventController@getTypeEvent'
]);
//Hiển thị trang thanh toán
Route::get('checkout',[
    'as'=>'checkout', 
    'uses' =>'PageController@getCheckout'
]);
Route::post('checkout',[
    'as'=>'checkout',
    'uses' =>'PageController@postCheckout'
]);
//hiển thị giỏ cart
Route::get('shopping_cart',[
    'as'=>'shopping_cart',
    'uses'=>'PageController@getShoppingCart'
]);
//hiển thị thêm loại vé vào giỏ hàng
Route::get('chooseticket/{id}',[
    'as'=>'chooseticket',
    'uses'=>'PageController@getChooseTicket'
]);
//Giảm số lượng
Route::get('deductbyone/{id}',[
    'as'=>'deductbyone',
    'uses'=>'PageController@getReduceByOne'
]);
//Xóa vé trong giỏ hàng
Route::get('removeticket/{id}',[
        'as'=>'removeticket',
        'uses'=>'PageController@getDelItemCart'
]);
Route::get('Cartupdate',[
    'as'=>'getCartUpdate',
    'uses'=>'PageController@getCartUpdate'
]);
//hiển thị hóa đơn
Route::get('bill',[
    'as'=>'billticket',
    'uses'=>'PageController@getBill'
]);
//hiển thị tất cả sự kiện
Route::get('getallevent',[
    'as'=>'getallevent',
    'uses'=>'EventController@getAllEvents'
]);
//thêm sự kiện vào giỏ hàng
Route::get('addtocart/{id}',[
    'as'=>'themvaogio',
    'uses'=>'PageController@getAddtoCart'
]);

Route::get('/auth/{provider}', 'HomeController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'HomeController@handleProviderCallback');
//hiển thị hóa đơn vừa mới mua hàng
Route::get('getBill/{id}',[
    'as'=>'getBill',
    'uses'=>'PageController@getBill'
]);
//hiển thị tất cả hóa đơn
Route::get('showbill/{id}',[
    'as'=>'showbill',
    'uses'=>'PageController@showBill'
]);
// hoãn vé trước 48 giờ
Route::get('removebill/{id}',[
    'as'=>'removebill',
    'uses'=>'PageController@deleteBill'
]);
// get search client
Route::get('searchs',[
    'as' => 'eventssearch', 
    'uses' => 'EventController@search'
]);
//Comment và reply
Route::post('eventsdetail/comment_event', 'EventController@comment_event')->name('comment_event');
Route::post('eventsdetail/reply_event', 'EventController@reply_event')->name('reply_event');
Route::post('comment', function(Request $request) {
    $comment = App\Comment::create($request->input());
    return response()->json($comment);
});
//like sự kiện
Route::get('likeEvent/{id}',[
    'as'=>'likeEvent',
    'uses'  =>'EventController@like'
]);
//End router Client
// Router dành cho admin
Route::group(['middleware' => ['admin']], function () {
    Route::get('/admin','HomeController@adminPage')->name('admin');
    Route::resource('admin/comments', 'Admin\AdminCommentManagement', array('as' => 'admin'));
    Route::get('admin/comments/{id}/reply','Admin\AdminCommentManagement@getReplyComment');
    Route::resource('admin/groups', 'Admin\AdminGroupManagement', array('as'=> 'admin'));
    Route::get('admin/groups/{id}/action', 'Admin\AdminGroupManagement@getAction');
    Route::resource('admin/users', 'Admin\AdminUserManagement', array('as'=>'admin'));
    Route::resource('admin/actions', 'Admin\AdminActionManagement', array('as' => 'admin'));
    Route::resource('admin/contacts', 'Admin\AdminContactManagement', array('as'=>'admin'));
    Route::resource('admin/menus', 'Admin\AdminMenuManagement', array('as' => 'admin'));
    Route::resource('admin/orders', 'Admin\AdminOrderManagement', array('as' => 'admin'));
    Route::resource('admin/companies', 'Admin\AdminCompanyManagement', array('as'=> 'admin'));
    Route::get('admin/companies/{id}/event', 'Admin\AdminCompanyManagement@getEvent');
    Route::resource('admin/type_events', 'Admin\AdminTypeEventManagement', array('as' => 'admin'));
    Route::resource('admin/events', 'Admin\AdminEventManagement', array('as' => 'admin'));
    Route::resource('admin/tickets', 'Admin\AdminTicketManagement', array('as' => 'admin'));
    Route::get('searchsadmin',[
        'as' => 'eventssearchadmin', 
        'uses' => 'Admin\AdminEventManagement@searchAdmin'
    ]);
});

Route::get('/redirect', 'HomeController@redirect');
Route::get('/auth/{provider}/callbacks', 'HomeController@callback');
Route::get('/auth/{provider}', 'HomeController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'HomeController@handleProviderCallback');

