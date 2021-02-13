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

use Illuminate\Support\Facades\Route;

/*
| Web Routes no need to login
*/
Route::get('/', 'TopController@index')->name(TOP);
Route::get('/privacy', 'TopController@privacy')->name(PRIVACY);
Route::get('/legal', 'TopController@legal')->name(LEGAL);
Route::get('/terms', 'TopController@terms')->name(TERMS);
Route::prefix('contact')->group(function () {
    Route::get('/', 'TopController@contactCreate')->name(USER_CONTACT_CREATE);
    Route::post('/', 'TopController@contactStore')->name(USER_CONTACT_STORE);
});

Route::namespace('Backend')->group(function () {
    Route::get('/home', 'HomeController@index')->name(USER_HOME);
    Route::prefix('information')->group(function () {
        Route::get('/list', 'InformationController@index')->name(USER_INFORMATION);
        Route::get('detail/{id}', 'InformationController@detail')->name(USER_INFORMATION_DETAIL);
    });
    Route::get('article/text/list', 'ListTopicController@showTopics')->name(USER_LIST_TOPIC);
    Route::get('article/image/list', 'ListPhotoController@showPhotos')->name(USER_LIST_PHOTO);
});

Route::namespace('Auth')->group(function () {
    Route::prefix('register')->group(function () {
        Route::get('/', 'RegisterController@showScreenRegister')->name(REGISTER_SHOW_SCREEN_REGISTER);
        Route::post('/set-data-step1', 'RegisterController@setDataStep1')->name(REGISTER_SET_DATA_STEP1);
        Route::get('/step1', 'RegisterController@showRegistrationForm')->name(REGISTER_SHOW_REGISTRATION_FORM);
        Route::post('/register', 'RegisterController@register')->name(REGISTER_REGISTER_USER);
        Route::get('/step2', 'RegisterController@showConfirmRegister')->name(REGISTER_STEP2_VERIFIED_SHOW_CONFIRM);
        Route::post('/step2/add-verified-register', 'RegisterController@addVerifiedRegisterAndSendMail')->name(REGISTER_STEP2_VERIFIED_ADD_RECORD);
        Route::get('/authentication/{verifiedToken}', 'RegisterController@verifiedRegister')->name(REGISTER_STEP2_VERIFIED_ACTIVE);
        Route::get('/step3', 'RegisterController@getAddressEmail')->name(REGISTER_STEP3_SHOW_EMAIL);
        Route::get('/step4', 'RegisterController@completeRegistration')->name(REGISTER_STEP4_COMPLETE_REGISTRATION);
    });

    Route::post('login', 'LoginController@login')->name(LOGIN);
    Route::get('login', 'LoginController@create')->name(SHOW_LOGIN);
    Route::get('logout', 'LoginController@logout')->name(LOGOUT);
});

/*
| Web Routes need to login
*/
Route::middleware(['auth'])->group(function () {

    Route::namespace('Backend')->group(function () {
        // Route member-user role
        Route::middleware('role:broker,expert,investor,sub_user')->group(function () {
            Route::middleware(['profile.user'])->group(function () {
                Route::post('/simulation/store', 'SimulationController@store')->name(USER_SIMULATION_STORE);
                Route::prefix('property')->group(function () {
                    Route::get('/', 'PropertyController@index')->name(USER_PROPERTY_INDEX);
                    Route::middleware('user.permissions:change_property')->group(function () {
                        Route::get('/add', 'PropertyController@create')->name(USER_PROPERTY_ADD);
                        Route::post('/store', 'PropertyController@store')->name(USER_PROPERTY_STORE);
                    });
                    Route::get('edit/{propertyId}', 'PropertyController@edit')->name(USER_PROPERTY_EDIT);
                    Route::post('update', 'PropertyController@update')->name(USER_PROPERTY_UPDATE);
                    Route::post('/update-net-profit/{id}', 'PropertyController@updateNetProfit');

                    Route::prefix('{propertyId}')->group(function () {

                        // Route check report permissions sub user
                        Route::middleware('report.permissions')->group(function () {
                            Route::prefix('/simple-assessment')->group(function () {
                                Route::get('/', 'SimpleAssessmentController@createOrEditSimpleAssessment')->name(USER_PROPERTY_SIMPLE_ASSESSMENT);
                                Route::post('/update', 'SimpleAssessmentController@storeOrUpdateSimpleAssessment')->name(USER_PROPERTY_SIMPLE_ASSESSMENT_UPDATE);
                            });

                            Route::prefix('/business-plan')->group(function () {
                                Route::get('/add', 'BusinessPlanController@create')->name(USER_PROPERTY_BUSINESS_PLAN_CREATE);
                                Route::post('/store', 'BusinessPlanController@store')->name(USER_PROPERTY_BUSINESS_PLAN_STORE);
                                Route::get('/edit', 'BusinessPlanController@edit')->name(USER_PROPERTY_BUSINESS_PLAN_EDIT);
                                Route::post('/update', 'BusinessPlanController@update')->name(USER_PROPERTY_BUSINESS_PLAN_UPDATE);
                            });

                            Route::prefix('/rent-roll')->group(function () {
                                Route::get('/', 'RentRollController@index')->name(USER_PROPERTY_RENT_ROLL_INDEX);
                                Route::get('/room', 'RentRollController@showListRoom')->name(USER_PROPERTY_RENT_ROLL_ROOM);
                                Route::get('/add', 'RentRollController@create')->name(USER_PROPERTY_RENT_ROLL_CREATE);
                                Route::get('/contract-renewal/{id}', 'RentRollController@contractRenewal')->name(USER_PROPERTY_RENT_ROLL_CONTRACT_RENEWAL);
                                Route::post('/store', 'RentRollController@store')->name(USER_PROPERTY_RENT_ROLL_STORE);
                                Route::get('/edit/{id}', 'RentRollController@edit')->name(USER_PROPERTY_RENT_ROLL_EDIT);
                                Route::post('/update/{id}', 'RentRollController@update')->name(USER_PROPERTY_RENT_ROLL_UPDATE);
                                Route::delete('/delete/{id}', 'RentRollController@destroy')->name(USER_PROPERTY_RENT_ROLL_DESTROY);
                            });

                            Route::prefix('/monthly-balance')->group(function () {
                                Route::get('/', 'MonthlyBalanceController@index')->name(USER_PROPERTY_MONTHLY_BALANCE_INDEX);
                                Route::get('/add', 'MonthlyBalanceController@create')->name(USER_PROPERTY_MONTHLY_BALANCE_CREATE);
                                Route::post('/store', 'MonthlyBalanceController@store')->name(USER_PROPERTY_MONTHLY_BALANCE_STORE);
                                Route::get('/edit', 'MonthlyBalanceController@edit')->name(USER_PROPERTY_MONTHLY_BALANCE_EDIT);
                                Route::post('/update', 'MonthlyBalanceController@update')->name(USER_PROPERTY_MONTHLY_BALANCE_UPDATE);
                                Route::post('/graph', 'MonthlyBalanceController@graph')->name(USER_PROPERTY_MONTHLY_BALANCE_GRAPH);
                            });

                            Route::prefix('/annual-performance')->group(function () {
                                Route::get('/', 'AnnualPerformanceController@index')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX);
                                Route::get('/add', 'AnnualPerformanceController@create')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE);
                                Route::post('/add', 'AnnualPerformanceController@store')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_STORE);
                                Route::get('/edit/{id}', 'AnnualPerformanceController@edit')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_EDIT);
                                Route::post('/edit/{id}', 'AnnualPerformanceController@update')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_UPDATE);
                                Route::post('/spider-web-chart', 'AnnualPerformanceController@buildSpiderWebChart')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_SPIDERWEB);
                                Route::post('/graph-below', 'AnnualPerformanceController@graphBelow')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_GRAPH_BELOW);
                                Route::delete('/destroy', 'AnnualPerformanceController@destroy')->name(USER_PROPERTY_ANNUAL_PERFORMANCE_DESTROY);
                            });

                            Route::prefix('/repair-history')->group(function () {
                                Route::get('/', 'RepairHistoryController@index')->name(USER_REPAIR_HISTORY);
                                Route::get('/add', 'RepairHistoryController@create')->name(USER_REPAIR_HISTORY_CREATE);
                                Route::post('/store', 'RepairHistoryController@store')->name(USER_REPAIR_HISTORY_STORE);
                                Route::get('/edit/{repairId}', 'RepairHistoryController@edit')->name(USER_REPAIR_HISTORY_EDIT);
                                Route::put('/update', 'RepairHistoryController@update')->name(USER_REPAIR_HISTORY_UPDATE);
                                Route::delete('/delete/{repairId}', 'RepairHistoryController@destroy')->name(USER_REPAIR_HISTORY_DESTROY);
                                Route::get('/move', 'PropertyController@moveRepairHistory')->name(USER_MOVE_REPAIR_HISTORY);
                            });
                        });
                    });

                    Route::prefix('portfolio-analysis')->group(function () {
                        Route::get('/', 'PortfolioAnalysisController@index')->name(USER_PROPERTY_PORTFOLIO_ANALYSIS);
                        Route::post('/save-data', 'PortfolioAnalysisController@createOrUpdate')->name(USER_PROPERTY_PORTFOLIO_ANALYSIS_CREATE_OR_UPDATE);
                        Route::get('/sort', 'SortTableController@index')->name(USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_TABLE);
                        Route::post('/update-order', 'SortTableController@updateOrderProperty')->name(USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_UPDATE_ORDER);
                    });

                    Route::prefix('borrowing')->group(function () {
                        Route::get('/', 'PropertyController@listBorrowing')->name(USER_BORROWING);
                        Route::post('/get-data-borrowing', 'PropertyController@getDataBorrowingChartAll')->name(USER_GET_DATA_BORROWING_CHART_ALL);
                        Route::get('/sort', 'PropertyController@listSortBorrowing')->name(USER_BORROWING_SORT);
                        Route::post('/update-order', 'PropertyController@updateOrderProperty')->name(USER_BORROWING_SORT_UPDATE_ORDER);
                    });

                    Route::delete('delete-house/{id}', 'PropertyController@destroy');
                    Route::get('borrowing', 'PropertyController@listBorrowing')->name(USER_BORROWING);
                    Route::get('single-analysis/{propertyId}', 'PropertyController@listSingleAnalysis')->name(USER_SINGLE_ANALYSIS);
                    Route::get('single-analysis', 'PropertyController@indexSingleAnalysis')->name(USER_SINGLE_ANALYSIS_INDEX);

                    Route::post('confirm-final/data-house-example', 'PropertyController@getDataHouseExample');
                    Route::post('confirm-final/data-example', 'PropertyController@getDataExample');
                });
                Route::prefix('document')->group(function () {
                    Route::get('/property-summary/{id}', 'PropertySummaryController@create')->name(USER_ESSENTIAL);
                    Route::post('/property-summary/store/', 'PropertySummaryController@store')->name(USER_ESSENTIAL_STORE);
                    Route::prefix('confirm-final')->group(function () {
                        Route::post('/', 'TaxController@store')->name(USER_DOCUMENT_CONFIRM_FINAL_STORE);
                        Route::get('get-data-preview/', 'TaxController@getDataPreview');
                        Route::post('get-list-proprietor/', 'TaxController@getDataProprietor');
                        Route::get('list/', 'TaxController@index')->name(USER_TAX_INDEX);
                        Route::get('add', 'TaxController@create')->name(USER_DOCUMENT_CONFIRM_FINAL_CREATE);
                        Route::get('edit/{id}', 'TaxController@edit')->name(USER_DOCUMENT_CONFIRM_FINAL_EDIT);
                        Route::put('{id}', 'TaxController@update')->name(USER_DOCUMENT_CONFIRM_FINAL_UPDATE);
                        Route::delete('delete-tax/{id}', 'TaxController@destroy')->name(USER_TAX_DESTROY);
                    });
                });
                Route::middleware(['role:broker,expert'])->group(function () {
                    Route::prefix('article')->group(function () {
                        Route::get('text', 'TopicController@index')->name(USER_ARTICLE_TEXT);
                        Route::get('text/add/', 'TopicController@create')->name(USER_ARTICLE_TEXT_ADD);
                        Route::post('text', 'TopicController@store')->name(USER_ARTICLE_TEXT_STORE);
                        Route::get('text/edit/{id}', 'TopicController@edit')->name(USER_ARTICLE_TEXT_EDIT);
                        Route::put('text/update', 'TopicController@update')->name(USER_ARTICLE_TEXT_UPDATE);
                        Route::delete('text/{id}', 'TopicController@destroy')->name(USER_ARTICLE_TEXT_DELETE);
                        Route::prefix('image')->group(function () {
                            Route::get('/', 'ArticlePhotoController@index')->name(USER_PHOTO_ARCHIVE_INDEX);
                            Route::get('add', 'ArticlePhotoController@create')->name(USER_ARTICLE_PHOTO_CREATE);
                            Route::post('store', 'ArticlePhotoController@store')->name(USER_ARTICLE_PHOTO_STORE);
                            Route::get('edit/{id}', 'ArticlePhotoController@edit')->name(USER_ARTICLE_PHOTO_EDIT);
                            Route::post('update/{id}', 'ArticlePhotoController@update')->name(USER_ARTICLE_PHOTO_UPDATE);
                            Route::delete('delete', 'ArticlePhotoController@destroy')->name(USER_ARTICLE_PHOTO_DESTROY);
                        });
                    });
                });

                Route::middleware(['role:broker,expert,investor'])->group(function () {
                    Route::prefix('settings')->group(function () {
                        Route::get('/', 'UserController@setting')->middleware('user.permissions:change_sub_user,change_plan')->name(USER_SETTING_INDEX);
                        Route::middleware(['user.permissions:change_plan'])->group(function () {
                            Route::get('/basic/checkout', 'UserController@checkout')->name(USER_SETTING_PAY_BASIC_CHECKOUT);
                            Route::post('/basic/checkout', 'UserController@changeBasic')->name(USER_SETTING_PAY_BASIC_UPGRADE);
                            Route::get('/premium/checkout', 'UserController@checkout')->name(USER_SETTING_PAY_PREMIUM_CHECKOUT);
                            Route::post('/premium/checkout', 'UserController@changePremium')->name(USER_SETTING_PAY_PREMIUM_UPGRADE);
                            Route::post('/downgrade', 'UserController@downgrade')->name(USER_SETTING_PAY_DOWNGRADE);
                            Route::get('/check-card', 'UserController@checkCard')->name(USER_SETTING_PAY_CHECK_CARD);
                            Route::post('/change-default', 'UserController@changeDefaultCard')->name(USER_SETTING_PAY_CHANGE_DEFAULT_CARD);
                            Route::post('/checkout/update-card', 'UserController@updateCardCheckout')->name(USER_SETTING_PAY_CHECKOUT_UPDATE_CARD);
                            Route::get('/card', 'UserController@createCardPay')->name(USER_SETTING_PAY_CREATE_CARD);
                            Route::post('/card', 'UserController@storeCardPay')->name(USER_SETTING_PAY_STORE_CARD);
                            Route::post('/destroy', 'UserController@deleteCardPay')->name(USER_SETTING_PAY_DELETE_CARD);
                            Route::get('/payment-info', 'UserController@paymentInfo')->name(USER_SETTING_PAYMENT_INFO);
                            Route::get('/payment-info/invoice/{id}', 'UserController@paymentInfoDetail')->name(USER_SETTING_PAYMENT_INFO_DETAIL);
                        });
                    });
                    Route::post('/change-member-status', 'UserController@changeMemberStatus')->name(USER_CHANGE_MEMBER_STATUS);
                    Route::get('/account-remove', 'UserController@delete')->name(USER_DELETE_INDEX);
                });

                Route::post('/account-destroy', 'UserController@destroy')->name(USER_DESTROY);
                Route::get('/report', 'ReportController@index')->name(USER_REPORT);

                Route::prefix('bank')->middleware('plan:premium')->group(function () {
                    Route::get('/', 'PropertyController@search')->name(USER_PROPERTY_SEARCH);
                    Route::get('/list', 'PropertyController@getDataSearch')->name(USER_PROPERTY_LIST_SEARCH);
                });

                Route::prefix('subuser')->group(function () {
                    Route::middleware(['user.permissions:change_sub_user'])->group(function () {
                        Route::get('/', 'SubUserController@index')->name(SUB_USER_INDEX);
                        Route::get('/add', 'SubUserController@create')->name(SUB_USER_PROFILE_CREATE);
                        Route::post('/store', 'SubUserController@store')->name(SUB_USER_PROFILE_STORE);
                        Route::delete('/destroy/{id}', 'SubUserController@destroy')->name(SUB_USER_DESTROY);
                    });
                    Route::get('/edit/{id}', 'SubUserController@edit')->name(USER_PROFILE_SUB_USER_EDIT);
                    Route::post('/update/{id}', 'SubUserController@update')->name(USER_PROFILE_SUB_USER_UPDATE);
                    Route::post('/change-permission-sub-user', 'SubUserController@changePermissionSubUser')->name(SUB_USER_CHANGE_PERMISSION);
                    Route::get('/subuser-property', 'SubUserController@createSubUserProperty')->name(SUB_USER_PROPERTY_CREATE);
                    Route::post('/subuser-property/store', 'SubUserController@storeSubUserProperty')->name(SUB_USER_PROPERTY_STORE);
                });
                Route::get('edit/info/subuser/{id}', 'SubUserController@edit')->name(SUB_USER_PROFILE_EDIT);

                Route::prefix('edit/info')->group(function () {
                    Route::get('/{role}/{id}', 'ProfileController@edit')->name(USER_PROFILE_EDIT);
                });
                Route::post('/update/info/{profileId}', 'ProfileController@update')->name(USER_PROFILE_STORE);

                Route::prefix('contact')->group(function () {
                    Route::prefix('support')->group(function () {
                        Route::get('/', 'UserController@supportCreate')->name(USER_SUPPORT_CREATE);
                        Route::post('/store', 'UserController@supportStore')->name(USER_SUPPORT_STORE);
                    });
                });
            });

            Route::prefix('register/info')->group(function () {
                Route::get('/expert', 'ProfileController@create')->name(USER_PROFILE_CREATE_EXPERT);
                Route::get('/broker', 'ProfileController@create')->name(USER_PROFILE_CREATE_BROKER);
                Route::get('/investor', 'ProfileController@create')->name(USER_PROFILE_CREATE_INVESTOR);
                Route::post('/store', 'ProfileController@store')->name(USER_PROFILE_STORE);
            });
        });
    });

    // Route Admin role
    Route::namespace('Admin')->group(function () {
        Route::prefix('admin')->middleware('role:admin')->group(function () {
            Route::prefix('/manage')->group(function () {
                Route::get('/', 'AdminController@index')->name(ADMIN_TOP);
                Route::get('/get-topics', 'AdminController@getTopics')->name(ADMIN_GET_TOPICS);
                Route::delete('delete-topic/{id}', 'AdminController@topicDestroy');
                Route::delete('delete-photo/{id}', 'AdminController@photoDestroy');
                Route::get('/get-article-photo', 'AdminController@getArticlePhoto')->name(ADMIN_GET_ARTICLE_PHOTO);
                Route::prefix('/image')->group(function () {
                    Route::get('/', 'AdminController@listArticlePhoto')->name(ADMIN_ARTICLE_PHOTO_INDEX);
                    Route::get('/edit/{articlePhotoId}', 'AdminController@editArticlePhoto')->name(ADMIN_ARTICLE_PHOTO_EDIT);
                    Route::post('/update/{articlePhotoId}', 'AdminController@updateArticlePhoto')->name(ADMIN_ARTICLE_PHOTO_UPDATE);
                });
                Route::prefix('/article')->group(function () {
                    Route::get('/', 'AdminController@showListTopicScreen')->name(ADMIN_SHOW_LIST_TOPIC_SCREEN);
                    Route::get('/edit/{topicId}', 'AdminTopicController@edit')->name(ADMIN_TOPIC_EDIT);
                    Route::put('/update/{topicId}', 'AdminTopicController@update')->name(ADMIN_TOPIC_UPDATE);
                });
                Route::prefix('user')->group(function () {
                    Route::get('/', 'ManageUserController@index')->name(ADMIN_MANAGE_USER_INDEX);
                    Route::prefix('/download')->group(function () {
                        Route::get('/', 'ManageUserController@getFromCsv')->name(ADMIN_MANAGE_USER_LIST_CSV);
                        Route::get('/list-user', 'ManageUserController@downloadCsv')->name(ADMIN_MANAGE_USER_DOWNLOAD_CSV);
                    });
                    Route::get('/add', 'InviteUserController@create')->name(ADMIN_USER_CREATE);
                    Route::post('/store', 'InviteUserController@store')->name(ADMIN_USER_STORE);
                    Route::prefix('/edit/{userId}')->group(function () {
                        Route::get('/', 'UserDetailController@index')->name(ADMIN_MANAGE_USER_DETAIL_INDEX);
                        Route::get('/property', 'UserDetailController@getProperty');
                        Route::get('/article-photo', 'UserDetailController@getArticlePhoto');
                        Route::get('/topics', 'UserDetailController@getTopics');
                        Route::post('/profile', 'UserDetailController@updateProfile');
                        Route::post('/property/move', 'UserDetailController@moveProperty')->name(ADMIN_MANAGE_MOVE_PROPERTY);
                        Route::post('/sub-user/move', 'UserDetailController@moveSubUser')->name(ADMIN_MANAGE_MOVE_SUB_USER);
                        Route::delete('/', 'UserDetailController@blockUser')->name(ADMIN_MANAGE_USER_DETAIL_DELETE);
                        Route::post('/member-status', 'UserDetailController@updateMemberStatus')->name(ADMIN_MEMBER_STATUS_UPDATE);
                        Route::post('/future_date', 'UserDetailController@updateFutureDate')->name(ADMIN_FUTURE_DATE_UPDATE);
                    });
                    Route::post('/unblock-user/{id}', 'UserDetailController@unblockUser')->name(ADMIN_MANAGE_UNBLOCK_USER);
                });
                Route::prefix('support')->group(function () {
                    Route::get('/', 'SupportUserController@index')->name(ADMIN_MANAGE_SUPPORT);
                    Route::post('/update', 'SupportUserController@update')->name(ADMIN_MANAGE_SUPPORT_UPDATE);
                });
                Route::prefix('contact')->group(function () {
                    Route::get('/', 'ContactUserController@index')->name(ADMIN_MANAGE_CONTACT);
                    Route::post('/update', 'ContactUserController@update')->name(ADMIN_MANAGE_CONTACT_UPDATE);
                });
                Route::prefix('information')->group(function () {
                    Route::get('/', 'InformationController@index')->name(ADMIN_MANAGE_INFORMATION);
                    Route::get('/create', 'InformationController@create')->name(ADMIN_MANAGE_INFORMATION_CREATE);
                    Route::post('/store', 'InformationController@store')->name(ADMIN_MANAGE_INFORMATION_STORE);
                    Route::get('/edit/{id}', 'InformationController@edit')->name(ADMIN_MANAGE_INFORMATION_EDIT);
                    Route::post('/update', 'InformationController@update')->name(ADMIN_MANAGE_INFORMATION_UPDATE);
                    Route::post('/delete', 'InformationController@delete')->name(ADMIN_MANAGE_INFORMATION_DELETE);
                });
            });
            Route::get('/property/edit/{propertyId}', 'PropertyController@edit')->name(ADMIN_PROPERTY_EDIT);
            Route::post('/property/update', 'PropertyController@update')->name(ADMIN_PROPERTY_UPDATE);
            Route::delete('/subuser/{subUserId}', 'SubUserController@destroy');
            Route::prefix('{userId}')->group(function () {
                Route::prefix('subuser')->group(function () {
                    Route::get('add', 'SubUserController@create')->name(ADMIN_SUB_USER_CREATE);
                    Route::post('store', 'SubUserController@store')->name(ADMIN_SUB_USER_STORE);
                    Route::get('edit/{id}', 'SubUserController@edit')->name(ADMIN_SUB_USER_EDIT);
                    Route::post('update/{id}', 'SubUserController@update')->name(ADMIN_SUB_USER_UPDATE);
                });
            });
        });
    });
});

Route::namespace('Backend')->group(function () {
    Route::get('/dummy', 'SimulationController@create')->name(USER_SIMULATION_CREATE);
    Route::prefix('/pass-reminder')->group(function () {
        Route::get('/', 'ResetPasswordController@index')->name(USER_RESET_PASSWORD_INDEX);
        Route::post('/send-mail-reset-password', 'ResetPasswordController@sendMailResetPassword')->name(USER_RESET_PASSWORD_SEND_MAIL);
        Route::get('/changepass/{token}', 'ResetPasswordController@showScreenConfirmPassword')->name(USER_RESET_PASSWORD_CONFIRM);
        Route::post('/reset-password', 'ResetPasswordController@updateChangePassword')->name(USER_RESET_PASSWORD_UPDATE);
    });

    Route::prefix('property/highcharts')->group(function () {
        Route::post('/spiderweb', 'HighChartsController@buildSpiderWeb');
        Route::post('/scatter', 'HighChartsController@buildScatterChart');
    });

    Route::get('{role}/{userId}', 'MyPageController@index')->name(MY_PAGE);
    Route::get('article/text/{id}', 'TopicController@show')->name(PREVIEW_TOPIC_DETAIL);
    Route::get('article/text/list/{id}', 'ListTopicController@index')->name(LIST_TOPIC);
    Route::get('article/image/list/{id}', 'ListPhotoController@index')->name(USER_LIST_PHOTO_INDEX);
    Route::get('sub-user/set-password/{verifiedToken}', 'SubUserController@showSetPasswordScreen')->name(SUB_USER_SHOW_SET_PASSWORD);
    Route::post('sub-user/set-password', 'SubUserController@createPassword')->name(SUB_USER_SET_PASSWORD);
});

Route::namespace('Backend')->group(function () {
    Route::get('edit/authentication/{verifiedToken}', 'ProfileController@updateEmail')->name(USER_PROFILE_UPDATE_EMAIL);
});
