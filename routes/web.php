<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
// Route::get('/', 'HomeController@welcome');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/exportExcel', 'HomeController@exportExcel')->name('exportExcel');

Route::get('backup', 'ActivityController@dbbackup');
Route::get('/', 'ActivityController@forceRedirectToLogin');
// Route::get('/', function () {
//     return redirect('login');
// });

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//customer pay url
Route::get('invoice/pay/{invoice_id}', 'InvoiceController@showCustomerInvoice');
Route::post('capture/pos/payment/publicpayment','InvoiceController@AuthorizenetCardPaymentPublic');
Route::post('/capture/inv/payment', 'InvoiceProductController@getPaidCartPublic');
Route::get('/capture/invoice/print/pdf/{invoice_id}', 'InvoiceController@captureInvoicePDF');
//customer pay url

//-----------------------bolt Start ----------------||

Route::get('bolt/ping', 'CardPointeeController@boltPing');
Route::post('bolt/capture', 'CardPointeeController@boltCaptureCard');
Route::post('bolt/partial/capture', 'CardPointeeController@boltCaptureCardPartialPayment');
Route::post('bolt/token', 'CardPointeeController@boltGenarateNewToken');

//-----------------------bolt End ------------------||

//-----------------Cardpointe Start-----------------||
Route::get('/cardpointe/test', 'CardPointeeController@testM');
//-----------------Cardpointe End-------------------||



// Route::get('/form', 'HomeController@form')->name('form');
Route::get('/form', 'HomeController@form')->name('form');
Route::get('/paypal', 'InvoiceController@paypal');
Route::post('/paypal', 'InvoiceController@paywithpaypal');
Route::get('/paypal/{status}', 'InvoiceController@getPaymentStatus');
Route::get('invoice/payment/paypal/{invoice_id}/{status}', 'InvoiceController@getPaymentStatusPaypal');


Route::get('/invoice/paypal/{invoice_id}', 'InvoiceController@paywithpaypalInvoice');

Route::get('/reset', 'HomeController@reset')->name('reset');
//Route::get('/register', 'HomeController@register')->name('register');
Route::get('/product', 'HomeController@product')->name('product');
Route::get('/productinventory', 'HomeController@productinventory')->name('productinventory');
//Route::get('/customer', 'HomeController@customer')->name('customer');
Route::get('/addsales', 'HomeController@addsales')->name('addsales');
// Route::get('/calculatevariance', 'HomeController@calculatevariance')->name('calculatevariance');
Route::get('/invoice', 'HomeController@invoice')->name('invoice');
Route::get('/profitList', 'HomeController@profitList')->name('profitList');
Route::get('invoice/template', 'HomeController@invoicetemplate')->name('invoicetemplate');
Route::get('invoice/summary', 'HomeController@invoicesummary')->name('invoicesummary');
Route::get('invoice/template/print', 'HomeController@invoicetemplateprint')->name('invoicetemplateprint');
Route::get('setting', 'HomeController@setting')->name('setting');
Route::get('DemoDashboard', 'HomeController@DemoDashboard')->name('DemoDashboard');
Route::get('chart', 'HomeController@chart');
Route::get('coming-soon', 'HomeController@soon');

Route::get('/initiate/auto/sync', 'InvoiceController@autoSync');
Route::get('/initiate/json/sync', 'InvoiceController@jsonSync');
Route::post('/initiate/save/sync', 'InvoiceController@curlPushData');
Route::get('pdf', 'InvoiceController@GenaratePDF');

Route::group(['middleware' => ['auth']], function () {

	Route::get('/partial/payment/report', 'PartialPaymentController@index');
	Route::post('/partial/payment/report/json', 'PartialPaymentController@datajson');
	Route::post('/partial/payment/report', 'PartialPaymentController@index');
	Route::post('/partial/payment/report/excel/report', 'PartialPaymentController@exportExcel');
	Route::post('/partial/payment/report/pdf/report', 'PartialPaymentController@invoicePDF');


	//Purchase
	Route::get('/purchase', 'PurchaseController@index');
	Route::get('/purchase/item', 'PurchaseController@indexItem');
	Route::post('/purchase/item', 'PurchaseController@indexItem');
	Route::post('/purchase', 'PurchaseController@index');
	Route::get('/purchase/create', 'PurchaseController@create');
	Route::post('/purchase/save', 'PurchaseController@store');
	Route::get('/purchase/receipt/{id}', 'PurchaseController@edit');
	Route::get('/purchase/delete/{id}', 'PurchaseController@destroy');
	Route::post('/purchase/modify/{id}', 'PurchaseController@update');
	Route::post('/product/purchase/confirm', 'PurchaseController@confirm');
	Route::post('/product/purchase/save', 'PurchaseController@purchaseSave');

	Route::get('/purchase/excel/report', 'PurchaseController@ExcelReport');
	Route::post('/purchase/excel/report', 'PurchaseController@ExcelReport');
	Route::get('/purchase/pdf/report', 'PurchaseController@PdfReport');
	Route::post('/purchase/pdf/report', 'PurchaseController@PdfReport');

	Route::get('/purchase/item/excel/report', 'PurchaseController@ExcelItemReport');
	Route::post('/purchase/item/excel/report', 'PurchaseController@ExcelItemReport');
	Route::get('/purchase/item/pdf/report', 'PurchaseController@PdfItemReport');
	Route::post('/purchase/item/pdf/report', 'PurchaseController@PdfItemReport');

	//====================== Json Record Parse =======================//
	Route::get('/product-config/json', 'InvoiceController@productConfigjson');
	Route::get('/analytical/profitvsexpense/json', 'RetailPosSummaryController@analyticsRepairInventory');
	Route::get('/analytical/salesvsreturn/json', 'RetailPosSummaryController@analyticsSalesNBuyback');
	Route::get('/analytical/salesvsprofit/json', 'RetailPosSummaryController@analyticsSalesvsProfit');
	Route::get('/analytical/top/cashier/products/json', 'RetailPosSummaryController@analyticsTopCashierProducts');
	Route::get('/analytical/topproducts/json', 'RetailPosSummaryController@analyticsTopProducts');
	Route::get('/analytical/salesninventory/json', 'RetailPosSummaryController@analyticsTodaySalesnTotalInventory');

	//======================== Search In Nucleus Start =================//
	Route::get('/search-nucleus', 'SearchSiteController@search');
	Route::post('/search-nucleus', 'SearchSiteController@search');
	Route::post('/search-nuc/inventory/repair', 'SearchSiteController@SearchinventoryRepair');
	Route::post('/search-nuc/non-inventory/repair', 'SearchSiteController@SearchNoninventoryRepair');
	Route::post('/search-nuc/customer', 'SearchSiteController@SearchCustomer');
	Route::post('/search-nuc/product', 'SearchSiteController@SearchProduct');
	//======================== Search In Nucleus End =================//

	Route::post('/sales/return/invoice/ajax', 'InvoiceController@loadCustomerInvoice');
	Route::post('/sales/return/invoice/detail', 'InvoiceController@loadCustomerReturnInvoice');
	Route::post('/sales/return/item', 'InvoiceController@saveCustomerReturnItem');
	Route::post('/sales/return/save/ajax', 'InvoiceController@SaveSalesReturnInvoice');

	Route::post('/product/settings', 'ProductSettingsController@store');
	Route::post('/ma/verify', 'InvoiceController@verifyMALogin');

    Route::post('/chat/message/send', 'ChatController@store');
	Route::post('/chat/message/load', 'ChatController@index');
	Route::get('/admin/chat', 'ChatController@master');
	Route::get('/master/chat/alluser', 'ChatController@allchatUser');
	Route::post('/master/chat/load/conversation', 'ChatController@loadMasterConversation');
	Route::post('/master/chat/save/conversation', 'ChatController@saveConversation');
	
	Route::post('/chat/conv/usr/image', 'ChatController@saveUserConvPhoto');
	Route::post('/master/chat/conv/usr/image', 'ChatController@saveMasterConvPhoto');


	Route::get('/login-activity', 'LoginActivityController@index');
	Route::get('/dashboard', 'RetailPosSummaryController@index');
	Route::get('/home', 'RetailPosSummaryController@index');
	Route::get('/analytical/dashboard', 'RetailPosSummaryController@analytical_dashboard');
	Route::get('/dashboard_demo', 'HomeController@dashboard_demo')->name('dashboard_demo');
	//------------------customer route start--------------------//
	Route::get('/customer', 'CustomerController@index')->name('customer');
	Route::get('/customer/getInfo/json/{id}', 'CustomerController@getCustomer');
	Route::get('/customer/list', 'CustomerController@show');
	Route::post('/customer/save', 'CustomerController@store');
	Route::post('/systemtour/ajax/status', 'UserTourController@systemTour');
	Route::get('/tour/start/{seriURL}', 'UserTourController@index');
	Route::get('/customer/edit/{id}', 'CustomerController@edit');
	Route::get('/customer/delete/{id}', 'CustomerController@destroy');
	Route::post('/customer/modify/{id}', 'CustomerController@update');
	Route::get('/customer/excel/report', 'CustomerController@exportExcel');
	Route::get('/customer/pdf/report', 'CustomerController@invoicePDF');
	Route::post('/customer/pos/ajax/add', 'CustomerController@posCustomerAdd');
	Route::get('/customer/import', 'CustomerController@importCustomer');
	Route::post('/customer/import/save', 'CustomerController@importCustomerSave');
	Route::get('/customer/report/{id}', 'CustomerController@customerReport'); 

	//customer lead
	Route::get('/customer/lead/new', 'CustomerLeadController@index');
	Route::get('/customer/lead/list', 'CustomerLeadController@show');
	Route::post('/customer/lead/save', 'CustomerLeadController@store');
	Route::get('/customer/lead/edit/{id}', 'CustomerLeadController@edit');
	Route::get('/customer/lead/delete/{id}', 'CustomerLeadController@destroy');
	Route::post('/customer/lead/modify/{id}', 'CustomerLeadController@update');

	//category 
	Route::get('/category', 'CategoryController@index');
	Route::post('/category/save', 'CategoryController@store');
	Route::get('/category/edit/{id}', 'CategoryController@edit');
	Route::get('/category/delete/{id}', 'CategoryController@destroy');
	Route::post('/category/modify/{id}', 'CategoryController@update');
	
	//user controller
	Route::get('user', 'CustomerController@user');
	Route::get('user/list', 'CustomerController@userList');
	Route::post('user/save', 'CustomerController@userSave');
	Route::get('user/edit/{id}', 'CustomerController@UserShow');
	Route::post('/user/modify/{id}', 'CustomerController@userUpdate');
	Route::get('/user/delete/{id}', 'CustomerController@Userdestroy');
	Route::get('user-info', 'CustomerController@UserInfoShow');
	Route::get('change-password', 'CustomerController@change_password');
	Route::post('change-password', 'CustomerController@do_change_password');

	//store controller
	Route::get('store-info', 'StoreController@storeInfo');
	Route::get('store-shop', 'StoreController@create');
	Route::get('store-shop/list', 'StoreController@index');
	Route::post('store-shop/save', 'StoreController@store');
	Route::get('store-shop/edit/{id}', 'StoreController@show');
	Route::post('store-shop/modify/{id}', 'StoreController@update');
	Route::get('store-shop/delete/{id}', 'StoreController@destroy');
	//------------------customer route End--------------------//
	//------------------TutorialVideo route start--------------------//
	Route::get('TutorialVideo', 'TutorialVideoController@index');
	Route::post('TutorialVideo/save', 'TutorialVideoController@store');
	Route::get('TutorialVideo/edit/{id}', 'TutorialVideoController@edit');
	Route::post('TutorialVideo/modify/{id}', 'TutorialVideoController@update');
	Route::get('TutorialVideo/delete/{id}', 'TutorialVideoController@destroy');
	Route::get('helpdesk', 'TutorialVideoController@helpDesk');
	Route::get('helpdesk/detail/{id}', 'TutorialVideoController@helpDeskDetail');
	Route::post('helpdesk/Ajax', 'TutorialVideoController@AjaxhelpDesk');
	Route::get('helpdesk/load/comment/{commentid}', 'TutorialVideoController@AjaxCommenthelpDesk');
	//------------------TutorialVideo route End--------------------//
	//------------------Department route start--------------------//
	Route::get('Department', 'DepartmentController@index');
	Route::post('Department/save', 'DepartmentController@store');
	Route::get('Department/edit/{id}', 'DepartmentController@edit');
	Route::post('Department/modify/{id}', 'DepartmentController@update');
	Route::get('Department/delete/{id}', 'DepartmentController@destroy');
	//------------------Department route End--------------------//
	//------------------SupportTicket route start--------------------//
	Route::get('SupportTicket', 'SupportTicketController@create');
	Route::get('SupportTicket/list', 'SupportTicketController@index');
	Route::post('SupportTicket/save', 'SupportTicketController@store');
	Route::get('SupportTicket/view/{id}', 'SupportTicketController@show');
	Route::get('SupportTicket/delete/{id}', 'SupportTicketController@destroy');
	Route::post('SupportTicket/Ajax', 'SupportTicketController@AjaxTicket');
	Route::get('SupportTicket/load/comment/{commentid}', 'SupportTicketController@AjaxCommentTicket');

	//------------------SupportTicket route End--------------------//

	//------------------Product route start--------------------//
	Route::get('/product', 'ProductController@index')->name('customer');
	Route::get('/product/list', 'ProductController@show');
	Route::get('/product/report', 'ProductController@report');
	Route::post('/product/save', 'ProductController@store');
	Route::post('/product/ajax/save', 'ProductController@storeAjax');
	Route::get('/product/edit/{id}', 'ProductController@edit');
	Route::get('/product/delete/{id}', 'ProductController@destroy');
	Route::post('/product/modify/{id}', 'ProductController@update');
	Route::get('/product/json', 'ProductController@dataTable');

	Route::get('/product/excel/report', 'ProductController@exportExcel');
	Route::get('/product/pdf/report', 'ProductController@invoicePDF');

	Route::get('/product/import', 'ProductController@importProduct');
	Route::post('/product/import/save', 'ProductController@importProductSave');


	Route::post('/product/report', 'ProductController@report');
	Route::post('/product/excel/report', 'ProductController@ExcelReport');
	Route::post('/product/pdf/report', 'ProductController@PdfReport');
	//------------------Product route start--------------------//


	// ------------------------tender route start------------------//
	Route::get('/tender', 'TenderController@index')->name('tender');
	Route::get('/tender/report', 'TenderController@show');
	Route::post('/tender/save', 'TenderController@store');
	Route::get('/tender/edit/{id}', 'TenderController@edit');
	Route::get('/tender/delete/{id}', 'TenderController@destroy');
	Route::post('/tender/modify/{id}', 'TenderController@update');

	Route::get('/tender/excel/report', 'TenderController@exportExcel');
	Route::get('/tender/pdf/report', 'TenderController@invoicePDF');
	// ------------------------tender route end------------------//

	// ------------------------Role Wise Menu route start------------------//
	Route::get('/RoleWiseMenu', 'RoleWiseMenuController@index')->name('tender');
	Route::post('/RoleWiseMenu/ajax', 'RoleWiseMenuController@showAjax');
	Route::post('/RoleWiseMenu/save', 'RoleWiseMenuController@store');
	// ------------------------Role Wise Menu route end------------------//

	// ------------------------role route start------------------//
	Route::get('/role', 'RoleController@index')->name('role');
	Route::post('/role/save', 'RoleController@store');
	Route::get('/role/edit/{id}', 'RoleController@edit');
	Route::get('/role/delete/{id}', 'RoleController@destroy');
	Route::post('/role/modify/{id}', 'RoleController@update');
	// ------------------------tender route end------------------//

	// ------------------------AssignUserRole route start------------------//
	Route::get('/AssignUserRole', 'AssignUserRoleController@index');
	Route::post('/AssignUserRole/save', 'AssignUserRoleController@store');
	Route::get('/AssignUserRole/edit/{id}', 'AssignUserRoleController@edit');
	Route::get('/AssignUserRole/delete/{id}', 'AssignUserRoleController@destroy');
	Route::post('/AssignUserRole/modify/{id}', 'AssignUserRoleController@update');
	// ------------------------AssignUserRole route end------------------//
	
	// ------------------------menu-item route start------------------//
	Route::get('/menu-item', 'MenuPageController@index');
	//Route::post('/menu-item/create', 'RoleWiseMenuController@create');
	Route::post('/menu-item/save', 'MenuPageController@store');
	Route::get('/menu-item/edit/{id}', 'MenuPageController@edit');
	Route::get('/menu-item/delete/{id}', 'MenuPageController@destroy');
	Route::post('/menu-item/modify/{id}', 'MenuPageController@update');
	// ------------------------tender route end------------------//

	// ------------------------tender route start------------------//
	Route::get('/expense/voucher', 'ExpenseController@index')->name('expense');
	Route::get('/expense/voucher/report', 'ExpenseController@show');
	Route::post('/expense/voucher/report', 'ExpenseController@show');
	Route::post('/expense/voucher/save', 'ExpenseController@store');
	Route::get('/expense/voucher/edit/{id}', 'ExpenseController@edit');
	Route::get('/expense/voucher/delete/{id}', 'ExpenseController@destroy');
	Route::post('/expense/voucher/modify/{id}', 'ExpenseController@update');
	Route::get('/expense/voucher/excel/report', 'ExpenseController@Excelexport');
	Route::post('/expense/voucher/excel/report', 'ExpenseController@Excelexport');
	Route::get('/expense/voucher/pdf/report', 'ExpenseController@ExpensePDF');
	Route::post('/expense/voucher/pdf/report', 'ExpenseController@ExpensePDF');
	// ------------------------tender route end------------------//

	// ------------------------tender route start------------------//
	//Route::get('/warranty', 'HomeController@warranty')->name('warranty');
	Route::get('/warrantyInvoice', 'HomeController@warrantyInvoice')->name('warrantyInvoice');
	Route::get('/warrantyBatchOut', 'HomeController@warrantyBatchOut')->name('warrantyBatchOut');
	// ------------------------tender route end------------------//

	// ------------------------calculatevariance route start------------------//
	Route::get('/calculatevariance', 'ProductVarianceDataController@index')->name('calculatevariance');
	Route::get('/calculatevariance/save', 'ProductVarianceDataController@store');
	// ------------------------calculatevariance route end------------------//

	//------------------Product Stockin route start--------------------//
	Route::get('/product/stock/in', 'ProductStockinController@index');
	Route::get('/product/stock/in/list', 'ProductStockinController@show');
	Route::get('/product/stock/in/report', 'ProductStockinController@report');
	Route::post('/product/stock/in/confirm', 'ProductStockinController@create');
	Route::post('/product/stock/in/save', 'ProductStockinController@store');
	Route::get('/product/stock/in/edit/{id}', 'ProductStockinController@edit');
	Route::get('/product/stock/in/receipt/{id}', 'ProductStockinController@receipt');
	Route::get('/product/stock/in/delete/{id}', 'ProductStockinController@destroy');
	Route::post('/product/stock/in/modify/{id}', 'ProductStockinController@update');

	/*Route::get('/product/stock/in/excel/report', 'ProductStockinController@exportExcel');*/
	Route::get('/product/stock/in/pdf/report', 'ProductStockinController@invoicePDF');


	Route::post('/product/stock/in/report', 'ProductStockinController@report');

	Route::post('/product/stock/in/excel/report', 'ProductStockinController@ExcelReport');
	Route::post('/product/stock/in/pdf/report', 'ProductStockinController@PdfReport');
	//------------------Product Stockin route start--------------------//

	//------------------Variance Route Start--------------------//
	Route::get('/variance', 'ProductVarianceController@index');
	Route::get('/variance/create', 'ProductVarianceController@index');
	Route::get('/variance/report', 'ProductVarianceController@show');
	Route::get('/variance/products/report/{id}', 'ProductVarianceController@varianceReport');
	Route::post('/variance/save', 'ProductVarianceController@store');
	Route::get('/variance/edit/{id}', 'ProductVarianceController@edit');
	Route::get('/variance/delete/{id}', 'ProductVarianceController@destroy');
	Route::post('/variance/modify/{id}', 'ProductVarianceController@update');

	Route::get('/variance/excel/report', 'ProductVarianceController@exportExcel');
	Route::get('/variance/pdf/report', 'ProductVarianceController@invoicePDF');
	//------------------Variance Route Start--------------------//


	//------------------Sales route start--------------------//
	Route::get('/sales', 'InvoiceController@index');
	Route::post('/slide-menu/slide/status', 'InvoiceController@slide');
	Route::get('/pos', 'InvoiceController@pos');
	Route::get('/posterminal', 'InvoiceController@posterminal');
	Route::get('/pos/clear', 'InvoiceController@posclear');
	Route::post('/open/store', 'InvoiceController@openStore');
	Route::post('/cart/pos/payout', 'InvoiceController@savePayout');
	Route::post('/cart/counter-payment/status', 'InvoiceProductController@changeCounterPayStatus');
	Route::post('/close/store', 'InvoiceController@closeStore');
	Route::post('/transaction/store', 'InvoiceController@transactionStore');
	Route::get('/invoice/pos/pay/paypal', 'InvoiceController@posPayPaypal');
	Route::get('/invoice/counter-pos/pay/paypal', 'InvoiceController@posCounterPayPaypal');
	Route::get('/pos/payment/paypal/{invoice_id}/{status}', 'InvoiceController@getPOSPaymentStatusPaypal');
	Route::get('/counter-pos/payment/paypal/{invoice_id}/{status}', 'InvoiceController@getCounterPOSPaymentStatusPaypal');
	Route::get('/sales/report', 'InvoiceController@show');
	Route::get('/sales/invoice/{invoice_id}', 'InvoiceController@invoiceShow');
	Route::get('/sales/invoice/print/pdf/{invoice_id}', 'InvoiceController@invoicePDF');
	Route::get('/sales/invoice/print/media/pdf/{ptype}/{invoice_id}', 'InvoiceController@invoicePDFByMedia');
	Route::get('/sales/invoice/print/media/last-invoice/{ptype}', 'InvoiceController@lastInvoicePDFByMedia');
	Route::post('/sales/confirm', 'InvoiceController@create');
	Route::post('/sales/save', 'InvoiceController@store');
	Route::get('/sales/edit/{id}', 'InvoiceController@edit');
	Route::get('/sales/delete/{id}', 'InvoiceController@destroy');
	Route::post('/sales/modify/{id}', 'InvoiceController@update');


	//------------------------sales attachment ---------//
	Route::post('/sales/add/attachment/invoice', 'InvoiceAttachmentController@attachment');
	Route::get('/sales/attachment/{invoice_id}', 'InvoiceAttachmentController@show');
	Route::get('/sales/attachment/download/{fileID}', 'InvoiceAttachmentController@download');
	Route::get('/sales/attachment/delete/{fileID}', 'InvoiceAttachmentController@delete');


	Route::post('/authorize/net/capture/pos/partial/payment','InvoiceController@AuthorizenetCardPartialPayment');

	Route::get('/partial/pay/paypal/{invoice_id}/{payment_id}/{paid_amount}', 'InvoiceController@partialPayPaypal');

	Route::get('/partial/payment/paypal/{invoice_id}/{payment_id}/{paid_amount}/{status}', 'InvoiceController@getPOSPartialPaymentStatusPaypal');

	Route::get('/partialpay/invoice/ajax', 'InvoiceController@loadPartialPaidInvoiceOnly');
	Route::post('/partialpay/invoice/ajax', 'InvoiceController@savePartialPaidInvoice');

	// Route::get('/sales/excel/report', 'InvoiceController@exportExcel');
	// Route::get('/sales/pdf/report', 'InvoiceController@salesPDF');

	Route::post('/sales/report', 'InvoiceController@show');
	Route::post('/sales/excel/report', 'InvoiceController@ExcelReport');
	Route::post('/sales/pdf/report', 'InvoiceController@PdfReport');
	//------------------Sales route end--------------------//

	//------------------Sales Return Route Start--------------//
	Route::get('/sales/return/create', 'InvoiceController@makeSalesReturn');
	Route::get('/sales/return/list', 'InvoiceController@makeSalesReturnShow');
	Route::get('/sales/return/make/{sales_id}', 'InvoiceController@createSalesReturn');
	Route::post('/sales/return/make/{sales_id}', 'InvoiceController@storeSalesReturn');
	//------------------Sales Return Route End--------------//

	//------------------Event Calender Route Start--------------//
	Route::get('/event/calendar', 'EventCalenderController@index');
	Route::get('/event/calendar/create', 'EventCalenderController@create');
	Route::post('/event/calendar/save', 'EventCalenderController@store');
	Route::post('/event/calendar/update/{id}', 'EventCalenderController@update');
	Route::get('/event/calendar/delete/{id}', 'EventCalenderController@destroy');
	Route::get('/event/calendar/edit/{id}', 'EventCalenderController@edit');
	Route::get('/event/calendar/list', 'EventCalenderController@show');
	//------------------Event Calender Route End--------------//

	//------------------Vendor Route Start--------------//
	Route::get('/vendor', 'VendorController@index');
	Route::get('/vendor/create', 'VendorController@create');
	Route::post('/vendor/save', 'VendorController@store');
	Route::post('/vendor/modify/{id}', 'VendorController@update');
	Route::get('/vendor/list', 'VendorController@show');
	Route::get('/vendor/edit/{id}', 'VendorController@edit');
	Route::get('/vendor/delete/{id}', 'VendorController@destroy');
	//------------------Vendor  Route Start--------------//

	//----------------POS Route Start--------------------------//
	Route::post('/sales/cart/add/{pid}', 'InvoiceProductController@getAddToCart');
	Route::post('/sales/vt/cart/add/{pid}', 'InvoiceProductController@getAddVTToCart');
	//Route::post('/sales/cart/custom/add/{pid}/{quantity}', 'InvoiceProductController@getCustomQuantityToCart');
	Route::post('/sales/cart/custom/add/{pid}/{quantity}/{price}', 'InvoiceProductController@getCustomQuantityToCart');
	Route::post('/sales/cart/row/delete/{pid}', 'InvoiceProductController@getDelRowFRMCart');
	Route::post('/sales/cart/del/{uniqid}', 'InvoiceProductController@getDelToCart');
	Route::post('/sales/cart/customer/{cusid}', 'InvoiceProductController@getCusAssignToCart');
	Route::get('/sales/cart/print', 'InvoiceProductController@getCart');
	Route::get('/sales/cart/json', 'InvoiceProductController@getCart');
	Route::get('/sales/cart/DBprint', 'InvoiceProductController@getDBCart');
	Route::get('/sales/cart/clear', 'InvoiceProductController@getClearCart');
	Route::post('/sales/cart/payment', 'InvoiceProductController@getPaidCart');
	Route::post('/sales/cart/assign/discount', 'InvoiceProductController@getAssignDiscountToCart');
	Route::post('/sales/cart/complete-sales', 'InvoiceController@CompleteSalesPOS');
	//Route::post('/sales/cart/complete-sales', 'InvoiceController@CompleteSalesPOS');
	Route::post('/sales/send/invoice', 'SendSalesEmailController@InvoiceMailSend');
	//---------------POS Route End-----------------------------//

	//------------------Counter Display Started------------------------//
	Route::post('counter-display-status-change', 'CounterDisplayController@updateCounterStatus');
	Route::get('counter-display', 'CounterDisplayController@index');
	Route::get('counter-display-token-id', 'CounterDisplayController@getDBCartTokenID');
	Route::post('counter-display/sales/json', 'CounterDisplayController@getSalesCartCounter');
	Route::post('counter-display/customer/save', 'CustomerInvoiceEmailController@store');
	//------------------Counter Display End------------------------//


	// --------Counter Display Settings route start---------//
	Route::get('/counter/display/add', 'CounterDisplayAuthorizedPCController@index');
	Route::post('/counter/display/add/save', 'CounterDisplayAuthorizedPCController@store');
	Route::get('/counter/display/add/edit/{id}', 'CounterDisplayAuthorizedPCController@edit');
	Route::get('/counter/display/add/delete/{id}', 'CounterDisplayAuthorizedPCController@destroy');
	Route::post('/counter/display/add/modify/{id}', 'CounterDisplayAuthorizedPCController@update');
	// --------Counter Display Settings route End---------//


	//------------------Report route start--------------------//
	Route::get('/profit', 'InvoiceProfitController@index');
	Route::get('/profit/report', 'InvoiceProfitController@index');
	Route::post('/profit/excel/report', 'InvoiceProfitController@export');
	Route::post('/profit/pdf/report', 'InvoiceProfitController@invoicePDF');
	Route::post('/profit/report', 'InvoiceProfitController@index');

	Route::get('/product/profit', 'ProductController@indexProfit');
	Route::get('/product/profit/report', 'ProductController@indexProfit');
	Route::post('/product/profit/excel/report', 'ProductController@exportProfit');
	Route::post('/product/profit/pdf/report', 'ProductController@invoicePDFProfit');
	Route::post('/product/profit/report', 'ProductController@indexProfit');

	Route::get('/payment', 'InvoicePaymentController@index');
	Route::get('/payment/report', 'InvoicePaymentController@index');
	Route::post('/payment/report', 'InvoicePaymentController@index');
	Route::post('/payment/excel/report', 'InvoicePaymentController@exportExcel');
	Route::post('/payment/pdf/report', 'InvoicePaymentController@invoicePDF');


	Route::get('/paypal/payment/report', 'InvoicePaymentController@Paypalindex');
	Route::post('/paypal/payment/report', 'InvoicePaymentController@Paypalindex');
	Route::post('/paypal/payment/excel/report', 'InvoicePaymentController@PaypalexportExcel');
	Route::post('/paypal/payment/pdf/report', 'InvoicePaymentController@PaypalinvoicePDF');
	//------------------Report route end--------------------//

	//------------------warranty route start--------------------//
	Route::get('/warranty', 'WarrantyController@index');
	Route::get('/warranty/invoice/{id}', 'WarrantyController@create');
	Route::post('/warranty/save', 'WarrantyController@store');
	Route::post('/warranty/update/{id}', 'WarrantyController@update');
	Route::post('/warranty/cart/add/{uniqid}', 'WarrantyController@getAddToCart');
	Route::post('/warranty/cart/del/{uniqid}', 'WarrantyController@getDelToCart');
	Route::get('/warranty/cart/print', 'WarrantyController@getCart');
	Route::get('/warranty/cart/clear', 'WarrantyController@getClearCart');
	Route::get('/warranty/report', 'WarrantyController@show');
	Route::get('/warranty/delete/{id}', 'WarrantyController@destroy');
	Route::get('/warranty/view/{id}', 'WarrantyController@edit');
	Route::get('/warranty/batch-out', 'WarrantyController@batchOut');

	Route::get('/warranty/excel/report', 'WarrantyController@exportExcel');
	Route::get('/warranty/pdf/report', 'WarrantyController@invoicePDF');
	//------------------warranty route end--------------------//


	

	//------------------variancereport route start--------------------//
	//Route::get('/variance/report', 'HomeController@variancereport')->name('variancereport');
	Route::get('/variance/report/detail', 'HomeController@variancereportdetail')->name('variancereportdetail');
	//------------------variancereport route end--------------------//


	//-------------------Settings Started----------------------------//
	Route::get('pos/settings', 'PosSettingController@index');
	Route::get('pos/settings/invoice/{id}', 'PosSettingController@invoiceLayout');
	Route::post('pos/settings/invoice/save/{id}', 'PosSettingController@invoiceLayoutSave');
	Route::post('pos/settings/save', 'PosSettingController@store');
	Route::post('pos/settings/update/{id}', 'PosSettingController@update');

	Route::get('site/navigation', 'SiteSettingController@navigation');
	
	Route::get('setting/printer/print-paper/size', 'PrinterPrintSizeController@index');
	Route::post('setting/printer/print-paper/size/save', 'PrinterPrintSizeController@store');
	Route::post('setting/printer/print-paper/size/update/{id}', 'PrinterPrintSizeController@update');
	
	Route::post('site/navigation/save', 'SiteSettingController@navigationstore');
	Route::post('site/navigation/update/{id}', 'SiteSettingController@navigationupdate');	

	Route::get('site/color', 'ColorPlateController@index');
	Route::post('site/color/save', 'ColorPlateController@store');
	Route::post('site/color/update/{id}', 'ColorPlateController@update');

	Route::get('site/report_setting', 'ReportSettingController@index');
	Route::post('site/report_setting/save', 'ReportSettingController@store');
	Route::post('site/report_setting/update/{id}', 'ReportSettingController@update');
	//-------------------Settings End Here-------------------------//



	//------------------Invoiec Email Teamplate start--------------------//
	Route::get('settings/invoice/email', 'InvoiceEmailTeamplateController@index');
	Route::post('settings/invoice/email/save', 'InvoiceEmailTeamplateController@store');
	Route::post('settings/invoice/email/update', 'InvoiceEmailTeamplateController@update');
	Route::get('settings/invoice/email/edit', 'InvoiceEmailTeamplateController@edit');
	Route::post('settings/invoice/email/time', 'InvoiceEmailTeamplateController@emailTime');
	Route::post('settings/invoice/email/bcc', 'InvoiceEmailTeamplateController@emailBCC');
	Route::post('settings/invoice/email/test-email', 'SendTestMailController@store');
	//------------------Invoiec Email Teamplate end--------------------//

	//----------------Testing laraveler mail Start-----------------------------//
	Route::get('sendbasicemail','MailController@basic_email');
	Route::get('sendhtmlemail','MailController@html_email');
	Route::get('sendattachmentemail','MailController@attachment_email');
	//----------------Testing laraveler mail End-----------------------------//


	//----------------Card Info Start-----------------------------//
	Route::get('/attendance/punch/manual','CashierPunchController@create');
	Route::get('/attendance/punch/report','CashierPunchController@report');
	Route::post('/attendance/punch/report','CashierPunchController@report');
	Route::post('/attendance/punch/excel','CashierPunchController@ExcelReport');
	Route::post('/attendance/punch/pdf','CashierPunchController@PdfReport');
	Route::post('/attendance/punch/save','CashierPunchController@saveattendance');
	Route::post('/attendance/punch/manual/save','CashierPunchController@store');
	Route::post('/attendance/punch/manual/modify/{id}','CashierPunchController@update');
	Route::get('/attendance/punch/json','CashierPunchController@attendanceJson');
	Route::get('/attendance/punch/edit/{id}','CashierPunchController@edit');
	//----------------Card Info End-----------------------------//

	//----------------Card Info Start-----------------------------//
	/*Route::get('/card','CardInfoController@index');
	Route::post('/card/save','CardInfoController@store');
	Route::get('/card/list','CardInfoController@show');
	Route::get('/card/list/delete/{id}','CardInfoController@destroy');
	Route::get('/card/list/edit/{id}','CardInfoController@edit');
	Route::post('/card/update/{id}','CardInfoController@update');*/
	//Route::get('sendattachmentemail','CardInfoController@attachment_email');
	//----------------Card Info End-----------------------------//

	//----------------Authorize.net Payment Route Start-----------------------------//
	Route::get('/authorize/net/payment/test','AuthorizeNetPaymentController@index');
	Route::post('/authorize/net/capture/pos/payment','InvoiceController@AuthorizenetCardPayment');
	Route::get('/authorize/net/payment/history','AuthorizeNetPaymentHistoryController@index');
	Route::post('/authorize/net/payment/refund','InvoiceController@refund');
	Route::post('/authorize/net/payment/void','InvoiceController@voidTransaction');

	Route::get('/authorize/net/payment/setting', 'AuthorizeNetPaymentController@setUserDynamicKey');
	Route::post('/authorize/net/payment/setting', 'AuthorizeNetPaymentController@setUserDynamicKey');
	Route::post('/authorize/net/payment/update/setting', 'AuthorizeNetPaymentController@UpdateUserDynamicKey');

	Route::post('/authorize/net/payment/history/report','AuthorizeNetPaymentHistoryController@show');
	Route::post('/authorize/net/payment/history/excel/report', 'AuthorizeNetPaymentHistoryController@ExcelReport');
	Route::post('/authorize/net/payment/history/pdf/report', 'AuthorizeNetPaymentHistoryController@PdfReport');




	Route::get('/stripe/payment/history', 'StripePaymentController@show');
	Route::post('/stripe/payment/history/report','StripePaymentController@show');
	Route::post('/stripe/payment/history/excel/report', 'StripePaymentController@ExcelReport');
	Route::post('/stripe/payment/history/pdf/report', 'StripePaymentController@PdfReport');


	Route::get('/stripe/account/setting', 'StripePaymentController@stripeSettings');
	Route::post('/stripe/account/setting', 'StripePaymentController@stripeSettingsSave');
	Route::post('/stripe/account/update/setting', 'StripePaymentController@stripeSettingsUpdate');


	Route::post('stripe', 'InvoiceController@stripeCardPayment')->name('stripe.post');
	Route::post('stripepartial', 'InvoiceController@stripeMnaulPartialCardPayment')->name('stripe.partial');
	//----------------Authorize.net Payment Route End-----------------------------//




	Route::get('/intregation/squareup/form', 'SquareConnectController@init');
	Route::post('/square/connect/capture/payment/nonce', 'SquareConnectController@capturePayment');
	Route::post('/square/connect/capture/parrtial/nonce', 'SquareConnectController@squareMnaulPartialCardPayment');
	Route::post('/square/connect/payment/refund', 'SquareConnectController@refund');


	Route::get('/square/payment/history', 'SquareConnectController@show');
	Route::post('/square/payment/data/json', 'SquareConnectController@datajson');
	Route::post('/square/payment/history/report', 'SquareConnectController@show');
	Route::post('/square/payment/history/excel/report', 'SquareConnectController@ExcelReport');
	Route::post('/square/payment/history/pdf/report', 'SquareConnectController@PdfReport');

	Route::get('/square/account/setting', 'SquareConnectController@storeAccount');
	Route::post('/square/account/setting', 'SquareConnectController@storeAccount');






	Route::get('/cardpointe/account/setting', 'CardPointeeController@cardPointeSettings');
	Route::post('/cardpointe/account/setting', 'CardPointeeController@cardPointeSettingsSave');
	Route::post('/cardpointe/account/update/setting', 'CardPointeeController@cardPointeSettingsUpdate');

	Route::post('/cardpointe/pos/payment','CardPointeeController@cardpointePayment');

	Route::post('/cardpointe/partial/payment','CardPointeeController@cardpointePartialPayment');
	

	Route::get('/cardpointe/payment/history','CardPointeeController@index');
	Route::post('/cardpointe/payment/data/json','CardPointeeController@datajson');
	Route::post('/cardpointe/payment/history/report','CardPointeeController@show');
	Route::post('/cardpointe/payment/history/excel/report', 'CardPointeeController@ExcelReport');
	Route::post('/cardpointe/payment/history/pdf/report', 'CardPointeeController@PdfReport');
	Route::post('/cardpointe/payment/refund','CardPointeeController@refund');
	//----------------Authorize.net Payment Route End-----------------------------//

});

Route::get('send-mail/invoice/email/instant', 'SendSalesEmailController@instantMailSend');
Route::get('stripe', 'StripePaymentController@stripe');

