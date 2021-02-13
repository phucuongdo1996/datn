<?php

/**
 * Define const for route name
 */

const ADMIN_TOP = 'admin.top';
const ADMIN_GET_TOPICS = 'admin.get.topics';
const ADMIN_GET_ARTICLE_PHOTO = 'admin.get.article.photo';
const ADMIN_ARTICLE_PHOTO_INDEX = 'admin.article.photo.index';
const ADMIN_ARTICLE_PHOTO_EDIT = 'admin.article.photo.edit';
const ADMIN_ARTICLE_PHOTO_UPDATE = 'admin.article.photo.update';
const ADMIN_TOPIC_EDIT = 'admin.topic.edit';
const ADMIN_TOPIC_UPDATE = 'admin.topic.update';
const ADMIN_SHOW_LIST_TOPIC_SCREEN = 'admin.show.list.topic.screen';
const ADMIN_USER_CREATE = 'admin.user.create';
const ADMIN_USER_STORE = 'admin.user.store';
const ADMIN_MANAGE_USER_INDEX = 'admin.manage.user.index';
const ADMIN_MANAGE_USER_LIST_CSV = 'admin.manage.user.list.csv';
const ADMIN_MANAGE_USER_DOWNLOAD_CSV = 'admin.manage.user.download.csv';
const ADMIN_MANAGE_USER_DETAIL_INDEX = 'admin.user_detail.user.detail.index';
const ADMIN_MANAGE_USER_DETAIL_DELETE = 'admin.user_detail.user.detail.delete';
const ADMIN_MANAGE_UNBLOCK_USER = 'admin.user_detail.unblock.user';
const ADMIN_PROPERTY_EDIT = 'admin.property.edit';
const ADMIN_PROPERTY_UPDATE = 'admin.property.update';
const ADMIN_MANAGE_MOVE_PROPERTY = 'admin.user_detail.user.detail.move.property';
const ADMIN_MANAGE_MOVE_SUB_USER = 'admin.user_detail.user.detail.move.sub.user';
const ADMIN_SUB_USER_CREATE = 'admin.subuser.create';
const ADMIN_SUB_USER_STORE = 'admin.subuser.update';
const ADMIN_SUB_USER_EDIT = 'admin.subuser.edit';
const ADMIN_SUB_USER_UPDATE = 'admin.subuser.update';
const ADMIN_MEMBER_STATUS_UPDATE = 'admin.user_detail.user.member_status.update';
const ADMIN_FUTURE_DATE_UPDATE = 'admin.user_detail.user.future_date.update';
const ADMIN_MANAGE_SUPPORT = 'admin.manage_support';
const ADMIN_MANAGE_SUPPORT_UPDATE = 'admin.manage_support.update';
const ADMIN_MANAGE_CONTACT = 'admin.manage.contact';
const ADMIN_MANAGE_CONTACT_UPDATE = 'admin.manage.contact.update';
const ADMIN_MANAGE_INFORMATION = 'admin.manage.information';
const ADMIN_MANAGE_INFORMATION_CREATE = 'admin.manage.information.create';
const ADMIN_MANAGE_INFORMATION_STORE = 'admin.manage.information.store';
const ADMIN_MANAGE_INFORMATION_UPDATE = 'admin.manage.information.update';
const ADMIN_MANAGE_INFORMATION_EDIT = 'admin.manage.information.edit';
const ADMIN_MANAGE_INFORMATION_DELETE = 'admin.manage.information.delete';

const REGISTER_STEP2_VERIFIED_SHOW_CONFIRM = 'register.step2.verified.show.confirm';
const REGISTER_STEP2_VERIFIED_ADD_RECORD = 'register.step2.verified.add.record';
const REGISTER_STEP2_VERIFIED_ACTIVE = 'register.step2.verified.active';
const REGISTER_STEP3_SHOW_EMAIL = 'register.step3.show.email';
const REGISTER_STEP4_COMPLETE_REGISTRATION = 'register.complete.registration';
const REGISTER_SHOW_REGISTRATION_FORM = 'register.show_registration_form';
const REGISTER_REGISTER_USER = 'register.register_user';
const REGISTER_SHOW_SCREEN_REGISTER = 'register.show_screen_register';
const REGISTER_SET_DATA_STEP1 = 'register.set_data_step_1';

const USER_PROFILE_CREATE_EXPERT = 'user.profile.create.expert';
const USER_PROFILE_CREATE_BROKER = 'user.profile.create.broker';
const USER_PROFILE_CREATE_INVESTOR = 'user.profile.create.investor';
const USER_PROFILE_EDIT = 'user.profile.edit';
const USER_PROFILE_SUB_USER_EDIT = 'user.profile_sub_user.edit';
const USER_PROFILE_SUB_USER_UPDATE = 'user.profile_sub_user.update';
const USER_PROFILE_STORE = 'user.profile.store';
const USER_PROFILE_UPDATE_EMAIL = 'user.profile.update.email';
const USER_HOME = 'home';
const USER_INFORMATION = 'user.information';
const USER_INFORMATION_DETAIL = 'user.information_detail';
const USER_LIST_TOPIC = 'user.list_topic';
const USER_LIST_PHOTO = 'user.list_photo';
const USER_SUPPORT_CREATE = 'user.support.create';
const USER_SUPPORT_STORE = 'user.support.store';
const USER_CONTACT_CREATE = 'user.contact.create';
const USER_CONTACT_STORE = 'user.contact.store';

const SUB_USER_INDEX = 'sub_user.index';
const SUB_USER_PROFILE_CREATE = 'sub_user.profile.create';
const SUB_USER_PROFILE_STORE = 'sub_user.profile.store';
const SUB_USER_SHOW_SET_PASSWORD = 'sub_user.show.set.password';
const SUB_USER_SET_PASSWORD = 'sub_user.set.password';
const SUB_USER_PROFILE_EDIT = 'sub_user.profile.edit';
const SUB_USER_DESTROY = 'sub_user.destroy';
const SUB_USER_PROPERTY_CREATE = 'sub_user.property.create';
const SUB_USER_PROPERTY_STORE = 'sub_user.property.store';
const SUB_USER_CHANGE_PERMISSION = 'sub_user.change.permission';

const TOP = 'top';
const LOGIN = 'login';
const SHOW_LOGIN = 'show.login';
const LOGOUT = 'logout';
const PRIVACY = 'privacy';
const LEGAL = 'legal';
const TERMS = 'terms';
const USER_SIMULATION_CREATE = 'user.simulation.create';
const USER_SIMULATION_STORE = 'user.simulation.store';

const USER_PROPERTY_INDEX = 'user.property.index';
const USER_PROPERTY_ADD = 'user.property.create';
const USER_PROPERTY_EDIT = 'user.property.edit';
const USER_PROPERTY_UPDATE = 'user.property.update';
const USER_PROPERTY_RENT_ROLL_INDEX = 'user.property.rent_roll.index';
const USER_PROPERTY_RENT_ROLL_CREATE = 'user.property.rent_roll.create';
const USER_PROPERTY_RENT_ROLL_ROOM = 'user.property.rent_roll.room';
const USER_PROPERTY_RENT_ROLL_CONTRACT_RENEWAL = 'user.property.rent_roll.contract_renewal';
const USER_PROPERTY_RENT_ROLL_STORE = 'user.property.rent_roll.store';
const USER_PROPERTY_RENT_ROLL_EDIT = 'user.property.rent_roll.edit';
const USER_PROPERTY_RENT_ROLL_UPDATE = 'user.property.rent_roll.update';
const USER_PROPERTY_RENT_ROLL_DESTROY = 'user.property.rent_roll.destroy';
const USER_PROPERTY_ANNUAL_PERFORMANCE_CREATE = 'user.property.annual_performance.create';
const USER_PROPERTY_ANNUAL_PERFORMANCE_STORE = 'user.property.annual_performance.store';
const USER_PROPERTY_ANNUAL_PERFORMANCE_EDIT = 'user.property.annual_performance.edit';
const USER_PROPERTY_ANNUAL_PERFORMANCE_UPDATE = 'user.property.annual_performance.update';
const USER_PROPERTY_ANNUAL_PERFORMANCE_INDEX = 'user.property.annual_performance.index';
const USER_PROPERTY_ANNUAL_PERFORMANCE_SPIDERWEB = 'user.property.annual_performance.spiderweb';
const USER_PROPERTY_ANNUAL_PERFORMANCE_GRAPH_BELOW = 'user.property.annual_performance.graph_below';
const USER_PROPERTY_ANNUAL_PERFORMANCE_DESTROY = 'user.property.annual_performance.destroy';

const USER_PROPERTY_PORTFOLIO_ANALYSIS = 'user.property.portfolio_analysis';
const USER_PROPERTY_PORTFOLIO_ANALYSIS_CREATE_OR_UPDATE = 'user.property.portfolio_analysis.create_or_update';
const USER_PROPERTY_STORE = 'user.property.store';
const USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_TABLE = 'user.property.portfolio_analysis.table.index';
const USER_PROPERTY_PORTFOLIO_ANALYSIS_SORT_UPDATE_ORDER = 'user.property.portfolio_analysis.sort.update.order';
const USER_SETTING_INDEX = 'user.setting';
const USER_SETTING_PAY_BASIC_CHECKOUT = 'user.setting.pay.basic.checkout';
const USER_SETTING_PAY_BASIC_UPGRADE = 'user.setting.pay.basic.upgrade';
const USER_SETTING_PAY_PREMIUM_CHECKOUT = 'user.setting.pay.premium.checkout';
const USER_SETTING_PAY_PREMIUM_UPGRADE = 'user.setting.pay.premium.upgrade';
const USER_SETTING_PAY_CHECKOUT_UPDATE_CARD = 'user.setting.pay.checkout.update_card';
const USER_SETTING_PAY_CREATE_CARD = 'user.setting.pay.create_card';
const USER_SETTING_PAY_STORE_CARD = 'user.setting.pay.store.card';
const USER_SETTING_PAY_DELETE_CARD = 'user.setting.pay.delete.card';
const USER_SETTING_PAYMENT_INFO = 'user.setting.payment.info';
const USER_SETTING_PAYMENT_INFO_DETAIL = 'user.setting.payment.info.detail';
const USER_SETTING_PAY_CHANGE_DEFAULT_CARD = 'user.setting.pay.change.default.card';
const USER_SETTING_PAY_DOWNGRADE = 'user.setting.pay.downgrade';
const USER_SETTING_PAY_CHECK_CARD = 'user.setting.pay.check.card';
const USER_CHANGE_MEMBER_STATUS = 'user.change_member_status';
const USER_DELETE_INDEX = 'user.delete';
const USER_DESTROY = 'user.destroy';
const USER_RESET_PASSWORD_INDEX = 'user.reset.password.index';
const USER_RESET_PASSWORD_CONFIRM = 'user.reset.password.confirm';
const USER_RESET_PASSWORD_SEND_MAIL = 'user.reset.password.send.mail';
const USER_RESET_PASSWORD_UPDATE = 'user.reset.password.update';
const USER_ESSENTIAL = 'user.essential';
const USER_ESSENTIAL_STORE = 'user.essential.store';
const USER_BORROWING = 'user.property.borrowing';
const USER_GET_DATA_BORROWING_CHART_ALL = 'user.get.data.borrowing.chart.all';
const USER_BORROWING_SORT = 'user.property.borrowing_sort';
const USER_BORROWING_SORT_UPDATE_ORDER = 'user.property.borrowing_sort.update.order';
const USER_SINGLE_ANALYSIS = 'user.single_analysis';
const USER_SINGLE_ANALYSIS_INDEX = 'user.single_analysis.index';
const USER_PROPERTY_SIMPLE_ASSESSMENT = 'user.property.simple_assessment';
const USER_PROPERTY_SIMPLE_ASSESSMENT_UPDATE = 'user.property.simple_assessment.update';

const USER_PROPERTY_SEARCH = 'user.property.search';
const USER_PROPERTY_LIST_SEARCH = 'user.property.list.search';

const ARRAY_BALANCE_ANALYSIS_ROUTE = [USER_SINGLE_ANALYSIS, USER_PROPERTY_PORTFOLIO_ANALYSIS, USER_BORROWING, USER_PROPERTY_SEARCH];

const USER_PROPERTY_BUSINESS_PLAN_CREATE = 'user.property.business_plan.create';
const USER_PROPERTY_BUSINESS_PLAN_STORE = 'user.property.business_plan.store';
const USER_PROPERTY_BUSINESS_PLAN_EDIT = 'user.property.business_plan.edit';
const USER_PROPERTY_BUSINESS_PLAN_UPDATE = 'user.property.business_plan.update';

const USER_REPORT = 'user.report';

const USER_ARTICLE_PHOTO_CREATE = 'user.article.photo.create';
const USER_ARTICLE_PHOTO_STORE = 'user.article.photo.store';
const USER_ARTICLE_PHOTO_EDIT = 'user.article.photo.edit';
const USER_ARTICLE_PHOTO_UPDATE = 'user.article.photo.update';
const USER_ARTICLE_PHOTO_DESTROY = 'user.article.photo.destroy';

const USER_MOVE_REPAIR_HISTORY = 'user.repair_history.move';
const USER_REPAIR_HISTORY = 'user.repair_history';
const USER_REPAIR_HISTORY_CREATE = 'user.repair_history.create';
const USER_REPAIR_HISTORY_STORE = 'user.repair_history.store';
const USER_REPAIR_HISTORY_EDIT = 'user.repair_history.edit';
const USER_REPAIR_HISTORY_UPDATE = 'user.repair_history.update';
const USER_REPAIR_HISTORY_DESTROY = 'user.repair_history.destroy';

const USER_DOCUMENT_CONFIRM_FINAL_CREATE = 'user.document.confirm_fina.create';
const USER_DOCUMENT_CONFIRM_FINAL_STORE = 'user.document.confirm_fina.store';
const USER_DOCUMENT_CONFIRM_FINAL_EDIT = 'user.document.confirm_fina.edit';
const USER_DOCUMENT_CONFIRM_FINAL_UPDATE = 'user.document.confirm_fina.update';

const USER_TAX_INDEX = 'user.tax.index';
const USER_TAX_DESTROY = 'user.tax.destroy';

const USER_PHOTO_ARCHIVE_INDEX = "user.photo_archive.index";
const USER_LIST_PHOTO_INDEX = "user.list_photo.index";

const USER_PROPERTY_MONTHLY_BALANCE_INDEX = 'user.property.monthly_balance.index';
const USER_PROPERTY_MONTHLY_BALANCE_CREATE = 'user.property.monthly_balance.create';
const USER_PROPERTY_MONTHLY_BALANCE_STORE = 'user.property.monthly_balance.store';
const USER_PROPERTY_MONTHLY_BALANCE_EDIT = 'user.property.monthly_balance.edit';
const USER_PROPERTY_MONTHLY_BALANCE_UPDATE = 'user.property.monthly_balance.update';
const USER_PROPERTY_MONTHLY_BALANCE_GRAPH = 'user.property.monthly_balance.graph';

const NAME_ARTICLE_TEXT = 'article_text';
const USER_ARTICLE_TEXT = 'user.article.text.index';
const USER_ARTICLE_TEXT_ADD = 'user.article.text.add';
const USER_ARTICLE_TEXT_STORE = 'user.article.text.store';
const USER_ARTICLE_TEXT_DELETE = 'user.article.text.delete';
const USER_ARTICLE_TEXT_EDIT = 'user.article.text.edit';
const USER_ARTICLE_TEXT_UPDATE = 'user.article.text.update';

const MY_PAGE = 'my_page';

/**
 * Define flag
 */
const FLAG_ZERO = 0;
const FLAG_ONE = 1;
const FLAG_TWO = 2;
const FLAG_THREE = 3;
const FLAG_FOUR = 4;
const FLAG_FIVE = 5;
const FLAG_SIX = 6;
const FLAG_SEVEN = 7;
const FLAG_EIGHT = 8;
const FLAG_NINE = 9;
const FLAG_TEN = 10;
const FLAG_ELEVEN = 11;
const FLAG_TWELVE = 12;
const FLAG_TWENTY = 20;
const FLAG_TWENTY_ONE = 21;
const FLAG_FIFTY = 50;
const FLAG_ONE_HUNDRED = 100;
const FLAG_TWO_HUNDRED = 200;
const FLAG_ONE_THOUSAND = 1000;
const FLAG_MIN_MONTH = 1;
const FLAG_MAX_MONTH = 12;
const STATUS_ACTIVE = 1;
const MAX_POINT = 100;
const OPTION_PAGINATE_MANAGER_USER = 50;
const LENGTH_PAY_CODE = 15;

/**
 * Define role value
 */
const INVESTOR = 0;
const BROKER = 1;
const EXPERT = 2;
const ADMIN = 3;
const SUB_USER = 4;
const ROLES = [
    INVESTOR => 'investor',
    BROKER => 'broker',
    EXPERT => 'expert',
    ADMIN => 'admin'
];

const ROLES_USER = [
    INVESTOR => 'investor',
    BROKER => 'broker',
    EXPERT => 'expert'
];

const TOPIC_CATEGORIES = ['お知らせ', '活動・実績', '調査・研究', 'イベント', '採用情報'];
const INFORMATION_CATEGORIES = ['NEWS', 'EVENT'];

const FREE = 0;
const BASIC = 1;
const PREMIUM = 2;
const TRIALS = 3;

const MEMBER_STATUS = [
    FREE => '無料会員',
    BASIC => '有料会員',
    PREMIUM => 'プレミアム会員',
    TRIALS => 'トライアル中'
];

const MEMBER_STATUS_PAY = [
    FREE => '無料会員',
    BASIC => 'ベーシックプラン ',
    PREMIUM => 'プレミアムプラン ',
    TRIALS => 'トライアル中'
];

const ROLES_JA = [
    INVESTOR => '不動産経営者',
    BROKER => '業者',
    EXPERT => '専門家'
];

const ROLES_TEXT_JA = ['不動産経営者', '業者', '専門家'];

const IN_USE = 0;
const USE_STOP = 1;

const USER_BLOCK = [
    IN_USE => '利用中',
    USE_STOP => '利用停止'
];

const ROLE_MY_PAGES = [
    'broker' => BROKER,
    'expert' => EXPERT
];

const ROLES_CHAR = [
    INVESTOR => 'I',
    BROKER => 'B',
    EXPERT => 'E',
    SUB_USER => 'S',
];
const PROFILE_EXIST = 'profile_exist';
const REGISTER_LINK_REDIRECT = [
    USER_PROFILE_CREATE_INVESTOR, USER_PROFILE_CREATE_BROKER, USER_PROFILE_CREATE_EXPERT
];

/**
 * Define status active User
 */
const ACTIVE_FAIL = 0;
const ACTIVE_SUCCESS = 1;
const ACTIVE_ERROR_EXPIRY_TIME = 2;
const ACTIVE_ERROR_USER_ACHIEVED = 3;
const REDIRECT_TO_HOME = 4;
const REDIRECT_TO_LOGIN = 5;
/**
 * Define home network domain email
 */
const HOME_NETWORK_DOMAIN = [
    'docomo'    => '@docomo.ne.jp',
    'softbank'  => '@softbank.ne.jp',
    'ezweb'     => '@ezweb.ne.jp',
];

/**
 * Define flash
 */
const STR_FLASH_ERROR = 'error';
const STR_FLASH_SUCCESS = 'success';
const STR_ERROR_FLASH = 'error-flash';
const STR_SUCCESS_FLASH = 'success-flash';
/**
 * Define response send mail
 */
const EMAIL_SEND_FAIL = '0';
const EMAIL_SEND_SUSSCESS = '1';
const EMAIL_USER_VERIFIED = '2';
const EMAIL_SENDED = '3';
const STEP_NAME = [
    1 => 'step1',
    2 => 'step2',
    3 => 'step3',
    4 => 'step4'
];
const EMAIL_WATTING_ACCURACY = 0;
const EMAIL_VERIFIED = 1;

/**s
 * Define list search tool
 */
const SEARCH_TOOL = [
    'その他', 'Yahoo!・Googleなどでの検索', '知人や取引業者の紹介', '他のサイトでの紹介', 'WEB上の広告', '新聞・雑誌', 'DM'
];
const PRESENTER = '知人や取引業者の紹介';

/**s
 * Define list province of Japan
 */
const PROVINCES = [
    '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県', '茨城県', '栃木県', '群馬県',
    '埼玉県', '千葉県', '東京都', '神奈川県', '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県',
    '岐阜県', '静岡県', '愛知県', '三重県', '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
    '鳥取県', '島根県', '岡山県', '広島県', '山口県', '徳島県', '香川県', '愛媛県', '高知県', '福岡県',
    '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
];

/**
 * Define list licenses of Japan
 */
const LICENSES = [
    '国土交通大臣', '北海道知事', '青森県知事', '岩手県知事', '宮城県知事', '秋田県知事', '山形県知事', '福島県知事', '茨城県知事', '栃木県知事',
    '群馬県知事', '埼玉県知事', '千葉県知事', '東京都知事', '神奈川県知事', '新潟県知事', '富山県知事', '石川県知事', '福井県知事', '山梨県知事',
    '長野県知事', '岐阜県知事', '静岡県知事', '愛知県知事', '三重県知事', '滋賀県知事', '京都府知事', '大阪府知事', '兵庫県知事', '奈良県知事',
    '和歌山県知事', '鳥取県知事', '島根県知事', '岡山県知事', '広島県知事', '山口県知事', '徳島県知事', '香川県知事', '愛媛県知事', '高知県知事',
    '福岡県知事', '佐賀県知事', '長崎県知事', '熊本県知事', '大分県知事', '宮崎県知事', '鹿児島県知事', '沖縄県知事'
];

/**
 * Define list specialty of expert
 */
const SPECIALTIES_EXPERT = 0;
const SPECIALTIES_BROKER = 1;

/**
 * Define const of image
 */
const COEFFICIENT_RESIZE = 0.5;
const ARTICLE_PHOTO_RESIZE = 0.5;
const ARTICLE_PHOTO_MAX_POST = 3;
const ARTICLE_PHOTO_MAX_SIZE = 1000;
const THUMBNAIL_IMAGE_FIRST_NAME = 'thumbnail_';
const MAX_SIZE_AVATAR = 5242880;
const EXTENSION_IMAGE = ['jpg','png','jpeg'];

/**
 * Define basement
 */
const BASEMENT = [
    '地下1階付', '地下2階付', '地下3階付', '地下4階付', '地下5階付',
    '地下6階付', '地下7階付', '地下8階付', '地下9階付', '地下10階付',
];

/**
 * Define storeys
 */
const STOREYS = [
    '平家建', '2階建', '3階建', '4階建', '5階建', '6階建', '7階建', '8階建', '9階建', '10階建',
    '11階建', '12階建', '13階建', '14階建', '15階建', '16階建', '17階建', '18階建', '19階建', '20階建',
    '21階建', '22階建', '23階建', '24階建', '25階建', '26階建', '27階建', '28階建', '29階建', '30階建',
    '31階建', '32階建', '33階建', '34階建', '35階建', '36階建', '37階建', '38階建', '39階建', '40階建',
    '41階建', '42階建', '43階建', '44階建', '45階建', '46階建', '47階建', '48階建', '49階建', '50階建',
    '51階建', '52階建', '53階建', '54階建', '55階建', '56階建', '57階建', '58階建', '59階建', '60階建',
    '61階建', '62階建', '63階建', '64階建', '65階建', '66階建', '67階建', '68階建', '69階建', '70階建',
    '71階建', '72階建', '73階建', '74階建', '75階建', '76階建', '77階建', '78階建', '79階建', '80階建',
    '81階建', '82階建', '83階建', '84階建', '85階建', '86階建', '87階建', '88階建', '89階建', '90階建',
    '91階建', '92階建', '93階建', '94階建', '95階建', '96階建', '97階建', '98階建', '99階建', '100階建',
];
const ALPHABET = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
const BASEMENT_RENT_ROLL = [
    '地下10階', '地下9階', '地下8階', '地下7階', '地下6階', '地下5階', '地下4階', '地下3階', '地下2階', '地下1階',
    '1階', '2階', '3階', '4階', '5階', '6階', '7階', '8階', '9階', '10階',
    '11階', '12階', '13階', '14階', '15階', '16階', '17階', '18階', '19階', '20階',
    '21階', '22階', '23階', '24階', '25階', '26階', '27階', '28階', '29階', '30階',
    '31階', '32階', '33階', '34階', '35階', '36階', '37階', '38階', '39階', '40階',
    '41階', '42階', '43階', '44階', '45階', '46階', '47階', '48階', '49階', '50階',
    '51階', '52階', '53階', '54階', '55階', '56階', '57階', '58階', '59階', '60階',
    '61階', '62階', '63階', '64階', '65階', '66階', '67階', '68階', '69階', '70階',
    '71階', '72階', '73階', '74階', '75階', '76階', '77階', '78階', '79階', '80階',
    '81階', '82階', '83階', '84階', '85階', '86階', '87階', '88階', '89階', '90階',
    '91階', '92階', '93階', '94階', '95階', '96階', '97階', '98階', '99階', '100階',
];


/**
 * Define status house
 */
const STATUS_HOUSE = [
    1 => '保有中',
    2 => '売却済',
    3 => '検討段階',
    4 => '検討中止',
];

/**
 * Define status house
 */
const STATUS_HOUSE_SIMPLE = [
    0 => '---',
    1 => '保有中',
    2 => '売却済',
    3 => '検討段階',
    4 => '検討中止',
];


const OWNING = 1;
const SOLD = 2;
const NEGOTIATING = 3;
const NEGOTIATED = 4;
const LIMIT_POST_USER_NORMAL = 3;


const MONTH = [
    1 => "1月期",
    2 => "2月期",
    3 => "3月期",
    4 => "4月期",
    5 => "5月期",
    6 => "6月期",
    7 => "7月期",
    8 => "8月期",
    9 => "9月期",
    10 => "10月期",
    11 => "11月期",
    12 => "12月期",
];

/**
 * Define land evaluation notes
 */
const EVALUATION_NOTE = [
    '自用地', '貸宅地（借地権）', '貸宅地（借地権・相当の地代）', '貸宅地（借地権・無償返還届出）', '貸宅地（借地権・使用貸借）', '貸宅地（定期借地権）',
    '貸宅地（地上権）', '貸宅地（区分地上権）', '貸宅地（区分地上権に準ずる地役権）', '貸家建付地', '借地権', '借地権（相当の地代）',
    '借地権（無料返還届出）', '借地権（使用貸借）', '定期借地権', '区分地上権', '区分地上権に準ずる地役権', '貸家建付借地権',
    '転貸借地権', '転借権', '余剰容積率の移転がある', '無道路地', '容積率が２以上の地域にわたる', '土地区画整理事業施行中',
    '造成中', '地積規模の大きな宅地（旧広大地）', '都市計画道路予定地', 'セットバックを要する宅地', '文化財建造物の敷地', '高圧線下地',
    '農林・山林・原野', '鉱泉地', '雑種地', '私道', '農業用施設用地', '砂防指定地', '特別緑地保全地区内',
];

/**
 * define path thumbnail house
 */
const PATH_THUMBNAIL_HOUSE = '/storage/imagesProperty/';
const PATH_SRC_AVATAR = 'storage/imagesProfileUser/';
const FOLDER_NAME_SAVE_GENERAL_INFO = 'imagesGeneralInfo';
const FOLDER_IMAGES_PROFILE = 'imagesProfileUser';
const FOLDER_IMAGES_PROPERTY = 'imagesProperty';
const PATH_SRC_ARTICLE_PHOTO = '/storage/articlePhotos/';

/**
 * define path article photo
 */
const FOLDER_NAME_SAVE_ARTICLE_PHOTO = '/articlePhotos/';
const STORAGE_LOCATION = 'storage/articlePhotos/';

/**
 * define max number page
 */
const MAX_NUMBER_PAGE = 14286;

/**
 * define time year by seconds
 */
const TIME_YEAR_SECONDS = 31536000;

const DATE_YEAR_MIN = '1950';

/**
 * define bank types
 */
const BANK_TYPES = [
    1 => "office_area",
    2 => "house_area",
    3 => "store_area",
    4 => "regional_area",
    5 => "regional_area",
    6 => "regional_area",
    7 => "regional_area",
    8 => "regional_area",
    9 => "",
    10 => "",
];

/**
 * define series spider-web
 */
const SPIDER_WEB_SERIES = ['dataSpiderWeb', 'dataFirstQuarter', 'dataAverageNumber', 'dataThirdQuarter', 'scoreMap'];

/**
 * define index series spider-web
 */
const INDEX_SERIES = ['', 'first_quarter', 'average_number', 'third_quarter'];

/**
 * define max rent rate
 */
const MAX_RENT_RATE = 100;

const LIMIT_RECORD_DEFAULT = 10;
const LIMIT_RECORD_LIST_HOUSE_DEFAULT = 7;
const LIMIT_RECORD_SEARCH_DEFAULT = 30;
const LIST_OPTION_PAGINATE = [
    '10' => '10件',
    '20' => '20件',
    '30' => '30件',
    '50' => '50件'
];

/**
 * define series classify
 */
const CLASSIFY = ['給排水', '空調', '電気', '建築', 'その他'];

/**
 * define max record
 */
const MAX_RECORD_LIST_PROPERTY = 7;
const MAX_RECORD_BUSINESS_PLAN = 10;
const HEISEI_LABEL = '平成';
const REIWA_LABEL = '令和';
const HEISEI_YEAR_MAX = 31;
const LIST_YEAR_LABEL = ['大正', '昭和', '平成', '令和'];

const CONTRACT_TYPE = ['普通賃貸借', '定期賃貸借', '使用貸借', 'その他'];

const SCREEN_ALLOWED = ['report', 'property'];

const ATTRIBUTE_SUM_RENT_ROLL = ['contract_area', 'contract_area_2', 'monthly_rent', 'monthly_service', 'deposit', 'deposit_monthly'
    , 'key_money', 'key_money_monthly', 'real_estate_type_id', 'room_status', 'totalRecord'];

/**
 * define check room empty or not empty
 */
const CHECK_EMPTY_ROOM = 'empty';
const CHECK_NOT_EMPTY_ROOM = 'no_empty';

/**
 * define score inside house
 */
const MIN_SCORE_INSIDE_HOUSE = 30;
const MAX_SCORE_INSIDE_HOUSE = 100;

/**
 * define id real estate type
 */
const MIN_REAL_ESTATE_TYPE = 1;
const MAX_REAL_ESTATE_TYPE = 8;

const REAL_ESTATE_TYPE = [
    1 => '事務所',
    2 => '住宅',
    3 => '店舗',
    4 => 'ホテル・旅館',
    5 => '倉庫',
    6 => 'データセンター・工場',
    7 => '病院・診療所',
    8 => 'ヘルスケア',
    9 => 'その他',
];

const DATE_MONTH = [
    1 => "1月",
    2 => "2月",
    3 => "3月",
    4 => "4月",
    5 => "5月",
    6 => "6月",
    7 => "7月",
    8 => "8月",
    9 => "9月",
    10 => "10月",
    11 => "11月",
    12 => "12月",
];

/**
 * define 12 month in year
 */
const JAN = 1;
const FEB = 2;
const MAR = 3;
const APR = 4;
const MAY = 5;
const JUN = 6;
const JULY = 7;
const AUG = 8;
const SEP = 9;
const OCT = 10;
const NOV = 11;
const DEC = 12;

/**
 * define data all
 */
const DATA_ALL = 'すべて';

/**
 * define array item url search
 */
const ITEM_URL_SEARCH = ['real_estate_type_search', 'area','total_floor_area', 'house_longevity'];
/**
 * define array attribute real estate type search
 */
const REAL_ESTATE_TYPE_SEARCH = [
    0 => '用途を選択してください',
    1 => 'オフィスビル_事務所',
    2 => 'レジデンス_住宅',
    3 => 'リテール_店舗',
    4 => 'ロジ・インダストリー',
    5 => 'ヘルスケア・ホテル'
];

/**
 * define display in units of 100㎡
 */
const UNIT_100 = 100;

/**
 * define house longevity
 */
const TEN_YEAR = 10;
const TWENTY_YEAR = 20;
const THIRTY_YEAR = 30;

/**
 * define array attribute condition search
 */
const OFFICE_AREA = [
    'すべて', '首都圏', '東京都23区', '東京都心5区', '東京都心5区を除く23区'
    , '東京都23区を除く首都圏', '中部圏', '名古屋市', '近畿圏', '大阪市', 'その他政令指定都市'
];

const HOUSE_AREA = [
    'すべて', '首都圏', '東京都23区', '東京都23区を除く首都圏', '都心部（東京都23区）'
    , '南西部（東京都23区）',  '中部圏', '名古屋市', '近畿圏', '大阪市', 'その他政令指定都市'
];

const DEFAULT_PARAMS_TAX = [
    "rent_income" => 0,
    "general_services" => 0,
    "utilities_revenue" => 0,
    "parking_revenue" => 0,
    "income_input_money" => 0,
    "income_update_house_contract" => 0,
    "other_income" => 0,
    "bad_debt_losses" => 0,
    "sum_income" => 0,
    "management_fee" => 0,
    "utilities_fee" => 0,
    "repair_fee" => 0,
    "intact_reply_fee" => 0,
    "asset_management_fee" => 0,
    "tenant_recruitment_fee" => 0,
    "taxes_dues" => 0,
    "insurance_premium" => 0,
    "land_tax" => 0,
    "other_fee" => 0,
    "sum_fee" => 0,
    "sum_difference" => 0,
    "crop_yield" => 0,
    "dscr" => 0,
];

const SHOP_AREA = ['すべて', '都心型', '郊外型'];

const INDUSTRY_AND_HOTEL_AREA = ['すべて', '首都圏', '東京都23区',  '中部圏', '近畿圏', 'その他政令指定都市'];

const OFFICE_TOTAL_AREA_FLOOR = ['すべて', '3,000㎡未満', '3,000㎡以上10,000㎡未満', '10,000㎡以上30,000㎡未満', '30,000㎡以上'];

const HOUSE_TOTAL_AREA_FLOOR = ['すべて', '2,000㎡未満', '2,000㎡以上3,000㎡未満', '3,000㎡以上5,000㎡未満', '5,000㎡以上'];

const SHOP_TOTAL_AREA_FLOOR = ['すべて', '1,000㎡未満', '1,000㎡以上10,000㎡未満', '10,000㎡以上'];

const INDUSTRY_AND_HOTEL_TOTAL_AREA_FLOOR = ['すべて', '5,000㎡未満', '5,000㎡以上10,000㎡未満', '10,000㎡以上'];

const HOUSE_AGE = ['すべて', '10年未満', '10年以上20年未満', '20年以上'];

const OFFICE_AND_SHOP_AGE = ['すべて', '10年未満', '10年以上20年未満', '20年以上30年未満', '30年以上'];

const INDUSTRY_AND_HOTEL_AGE = ['すべて', '20年未満', '20年以上'];

const SCREEN_MY_PAGE = ['article_text', 'my_page', 'topic_list'];
const PREVIEW_TOPIC_DETAIL = 'my_page.topic.detail';
const LIST_TOPIC = 'my_page.topic';
const LIMIT_PAGINATION_MY_PAGE_TOPIC = 20;
const ADMIN_LIMIT_PAGINATION_MY_PAGE_TOPIC = 50;
const LIMIT_RECORD_PROPERTY_USER_DETAIL = 20;
const LIMIT_RECORD_ADMIN_TOP = 4;
const LIMIT_RECORD_PHOTO_USER_DETAIL = 6;
const MIN_PROPERTY_CODE = 1;
const MAX_PROPERTY_CODE = 99999;

const EXTENSION_CSV = '.csv';
const CSV_NAME = 'ユーザー一覧';
const BLOCK_USER = '利用停止';
const NO_BLOCK_USER = '利用中';
const TIME_START = ' 00:00:00';
const TIME_END = ' 23:59:59';
const MONEY_SUB_USER = 500;
const MONEY_SUB_USER_BY_INVESTOR = 400;
const MONEY_SUB_USER_BY_BROKER_EXPERT = 1200;
const MONEY_BASIC_BY_INVESTOR = 980;
const MONEY_BASIC_BY_BROKER_EXPERT = 2980;
const MONEY_PREMIUM_BY_INVESTOR = 3000;
const MONEY_PREMIUM_BY_BROKER_EXPERT = 10000;

const AMOUNT_SUB_USER_BY_ROLE = [
    INVESTOR => 400,
    BROKER => 1200,
    EXPERT => 1200
];

const AMOUNT_BY_ROLE_MEMBER_STATUS = [
    INVESTOR => [
        FREE => 0,
        BASIC => 980,
        PREMIUM => 3000,
        TRIALS => 0
    ],
    BROKER => [
        FREE => 0,
        BASIC => 2980,
        PREMIUM => 10000,
        TRIALS => 0
    ],
    EXPERT => [
        FREE => 0,
        BASIC => 2980,
        PREMIUM => 10000,
        TRIALS => 0
    ]
];

const ROLE = [
    0 => '不動産経営者',
    1 => '業者',
    2 => '専門家'
];

const GENDER = [
    0 => '男',
    1 => '女'
];

const NOTIFICATION = [
    0 => '配信を希望する',
    1 => '配信を希望しない'
];

const STATUS_USER = [
    DATA_ALL, NO_BLOCK_USER, BLOCK_USER
];

const PROPERTY_PERCENT = [
    'interest_rate',
    'rental_percentage'
];

const PROPERTY_DATE = [
    'receive_house_date',
    'loan_date',
    'construction_time',
    'rental_period_from',
    'date_lease',
    'rental_period_to',
];

const PROPERTY_SQUARE_METER = [
    'ground_area',
    'total_area_floors',
    'area_may_rent',
    'area_rent',
    'area_rental_operating',
];

const NUMBER_FORMAT_PROPERTY = [
    'money_receive_house',
    'loan',
    'deposits',
    'revenue_land_taxes',
    'revenue_room_rentals',
    'revenue_service_charges',
    'revenue_utilities',
    'revenue_car_deposits',
    'turnover_revenue',
    'revenue_contract_update_fee',
    'revenue_other',
    'bad_debt',
    'total_revenue',
    'maintenance_management_fee',
    'electricity_gas_charges',
    'repair_fee',
    'recovery_costs',
    'property_management_fee',
    'find_tenant_fee',
    'tax',
    'loss_insurance',
    'land_rental_fee',
    'other_costs',
    'total_cost',
    'operating_expenses',
];

const PROPERTY_LABEL_TEXT = [
    'avatar' => '物件写真',
    'proprietor' => '所有者（顧客名）入力欄',
    'status' => 'ステータス',
    'receive_house_date' => '物件取得日',
    'loan_date' => '借入日',
    'loan_bank_name' => '借入金融機関',
    'bank_branch_name' => '支店名',
    'money_receive_house' => '取得金額',
    'loan' => '借入金額',
    'contract_loan_period' => '契約借入期間',
    'interest_rate' => '借入利息',
    'house_name' => '物件名称',
    'zip_code' => '郵便番号',
    'address_city' => '都道府県',
    'address_district' => '所在地(都市区)',
    'address_town' => '所在地 (都市区以降)',
    'apartment_number' => '地番',
    'room_number' => '家屋番号',
    'real_estate_type_id' => '主要用途',
    'detail_real_estate_type_id' => '用途詳細',
    'house_material_id' => '構造',
    'house_roof_type_id' => '構造',
    'basement' => '階数',
    'storeys' => '階数',
    'ground_area' => '土地延べ面積',
    'total_area_floors' => '建物延床面積',
    'construction_time' => '竣工年月日',
    'land_right_id' => '土地権利',
    'building_right_id' => '建物権利',
    'total_tenants' => 'テナント総数',
    'area_may_rent' => '賃貸可能面積',
    'deposits' => '敷金・保証金',
    'type_rental_id' => '借地権種類',
    'area_rent' => '借地面積',
    'rental_period_from' => '借地期間 自',
    'rental_period_to' => '借地期間 至',
    'date_lease' => '現行地代合意日(直近地代更新日)',
    'deposit_host' => '敷金・保証金',
    'prize_money' => '権利金',
    'room_cede_fee' => '名義書換料',
    'fee_rebuild_rented_house' => '建替等承諾料',
    'contract_update_fee' => '更新料',
    'notes' => '備考',
    'date_year_registration_revenue' => '年間収支登録年度月期',
    'date_month_registration_revenue' => '年間収支登録年度月期',
    'revenue_land_taxes' => '地代収入(借地地代徴収権)',
    'revenue_room_rentals' => '貸室賃料収入',
    'revenue_service_charges' => '共益費収入',
    'revenue_utilities' => '水道光熱費収入',
    'revenue_car_deposits' => '駐車場収入',
    'turnover_revenue' => '礼金・権利金収入',
    'revenue_contract_update_fee' => '更新料収入',
    'revenue_other' => 'その他収入',
    'bad_debt' => '貸倒れ損失等',
    'total_revenue' => '計',
    'maintenance_management_fee' => '維持管理費',
    'electricity_gas_charges' => '水道光熱費',
    'repair_fee' => '修繕費',
    'recovery_costs' => '原状回復費',
    'property_management_fee' => 'プロパティマネジメントフィ',
    'find_tenant_fee' => 'テナント募集費用',
    'tax' => '公租公課',
    'loss_insurance' => '損害保険料',
    'land_rental_fee' => '支払地代',
    'other_costs' => 'その他費用',
    'total_cost' => '計',
    'operating_expenses' => '運営収支',
    'area_rental_operating' => '賃貸稼働面積',
    'rental_percentage' => '稼働率',
    'main_application' => '底地上建物等の主要用途',
];

const MONEY_DEFAULT = 1980;
const MONEY_FEE_ONE_SUB_USER = 500;
const LIMIT_NUMBER_DELETE_SUB_USER = 10;
const NUMBER_MAIN_APPLICATION = 10;
const MAIN_APPLICATION = [
    1 => 'オフィスビル_事務所',
    2 => 'レジデンス_住宅',
    3 => 'リテール_店舗',
    4 => 'ホテル・旅館',
    5 => 'ロジスティクス_倉庫',
    6 => '工場・作業所・データセンター',
    7 => '病院・診療所',
    8 => 'ヘルスケア',
    9 => '土地_及び構築物',
];
const SIMPLE_SCREEN = 'simple';

const CONTENT_OF_INQUIRY = [
    '入力代行', '財産診断資産コンサルティング', '経営分析改善コンサルティング', 'アセットマネジメント', '売買価格オピニオン', '不動産鑑定評価'
];
const TRIAL_DAYS = 60;
const TRIAL_DAY_BY_SECONDS = 5184000;
const THIRTY_DAY_BY_SECONDS = 2592000;
const TRIAL_DAYS_DEFAULT = 0;
const FREE_NAME = 'free';
const TRIAL_NAME = 'trial';
const BASIC_NAME = 'basic';
const PREMIUM_NAME = 'premium';
const PLAN_NAME = [
    FREE => FREE_NAME,
    BASIC => BASIC_NAME,
    PREMIUM => PREMIUM_NAME,
    TRIALS => TRIAL_NAME
];
const CURRENCY_UNIT = "jpy";
const OPEN = 1;
const CLOSE = 0;
const DISABLE = 2;

/**
 * define permission sub user
 */
const VIEW_PERMISSION = 1;
const VIEW_EDIT_PERMISSION = 2;
const VIEW_DELETE_PERMISSION = 3;
const VIEW_EDIT_DELETE_PERMISSION = 4;
const VIEW_REPORT_PERMISSION = 5;
const VIEW_EDIT_REPORT_PERMISSION = 6;
const VIEW_DELETE_REPORT_PERMISSION = 7;
const VIEW_EDIT_DELETE_REPORT_PERMISSION = 8;

const EDIT_SCREEN = 'edit';
const DELETE_SCREEN = 'delete';
const REPORT_SCREEN = 'report';
const INFORMATION_SCREEN = 'information';
const SCREEN_TOPICS = 'user_topics';

const ARRAY_EDIT_PERMISSION = [VIEW_EDIT_PERMISSION, VIEW_EDIT_DELETE_PERMISSION, VIEW_EDIT_REPORT_PERMISSION, VIEW_EDIT_DELETE_REPORT_PERMISSION];
const ARRAY_DELETE_PERMISSION = [VIEW_DELETE_PERMISSION, VIEW_EDIT_DELETE_PERMISSION, VIEW_DELETE_REPORT_PERMISSION, VIEW_EDIT_DELETE_REPORT_PERMISSION];
const ARRAY_REPORT_PERMISSION = [VIEW_REPORT_PERMISSION, VIEW_EDIT_REPORT_PERMISSION, VIEW_DELETE_REPORT_PERMISSION, VIEW_EDIT_DELETE_REPORT_PERMISSION];

const CHANGE_PROPERTY = 'change_property';
const CHANGE_SUB_USER = 'change_sub_user';
const CHANGE_PLAN = 'change_plan';
const CHANGE_MYPAGE = 'change_mypage';

const VIEW_PROPERTY = [VIEW_PERMISSION, VIEW_EDIT_PERMISSION, VIEW_DELETE_PERMISSION, VIEW_EDIT_DELETE_PERMISSION, VIEW_REPORT_PERMISSION];
const VIEW_REPORT = [VIEW_REPORT_PERMISSION, VIEW_EDIT_REPORT_PERMISSION, VIEW_DELETE_REPORT_PERMISSION, VIEW_EDIT_DELETE_REPORT_PERMISSION];
const ADMIN_ROUTES = [ADMIN_TOP, ADMIN_MANAGE_USER_INDEX, ADMIN_SHOW_LIST_TOPIC_SCREEN, ADMIN_ARTICLE_PHOTO_INDEX, ADMIN_USER_CREATE, ADMIN_MANAGE_USER_LIST_CSV, ADMIN_MANAGE_CONTACT, ADMIN_MANAGE_SUPPORT, ADMIN_MANAGE_INFORMATION];

/**
 * Define type show list sub user
 */
const SHOW_BY_SUB_USER = 1;
const SHOW_BY_FREE_MAIN_USER = 2;
const SHOW_BY_FEE_MAIN_USER = 3;
const TIME_DAY_BY_SECONDS = 86400;

/**
 * Define class name in list tax
 */
const CLASS_NO_DATA_FIRST = 'td-no-data';
const CLASS_NO_DATA_SECOND = 'td-no-data-2';
const TAX_PERSONAL = 0.1;
const TAX_COEFFICIENT = 1.1;
const PLAN_TEXT_NAME = [
    FREE => 'フリープラン ',
    BASIC => 'ベーシックプラン',
    PREMIUM => 'プレミアム',
];

/**
 * Define type supported
 */
const NOT_RESPONSE = 1;
const PROCESSING = 2;
const PROCESSED = 3;
const DONE = 4;

const SUPPORT_STATUS = [
    NOT_RESPONSE => '未返信',
    PROCESSING => '対応中',
    PROCESSED => '対応済み（請求中）',
    DONE => '対応済み（入金完了）',
];

const PAUSED_BY_USER = 1;
const PAUSED_BY_PAY_ERROR = 2;
const PAUSED_BY_LOW_AMOUNT = 3;

const AMOUNT_MIN_PAY = 50;
