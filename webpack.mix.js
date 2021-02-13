const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/custom/custom.scss', 'public/dist/css/custom.min.css')
    .js('resources/js/custom/*', 'public/dist/js/custom.min.js')
    .js('resources/js/property/borrowing.js', 'public/dist/js/borrowing.min.js')
    .js('resources/js/property/essential-property.js', 'public/dist/js/essential-property.min.js')
    .js('resources/js/property/portfolio-analysis.js', 'public/dist/js/portfolio-analysis.min.js')
    .js('resources/js/property/property.js', 'public/dist/js/property.min.js')
    .js('resources/js/property/register-property.js', 'public/dist/js/register-property.min.js')
    .js('resources/js/property/single-analysis.js', 'public/dist/js/single-analysis.min.js')
    .js('resources/js/property/simulation.js', 'public/dist/js/simulation.min.js')
    .js('resources/js/property/simple-assessment.js', 'public/dist/js/simple-assessment.min.js')
    .js('resources/js/graph/*', 'public/dist/js/graph.min.js')
    .js('resources/js/report/report.js', 'dist/js/report.min.js')
    .js('resources/js/property/rent-roll.js', 'public/dist/js/rent-roll.min.js')
    .js('resources/js/property/tax.js', 'public/dist/js/tax.min.js')
    .js('resources/js/report/repair_history.js', 'public/dist/js/repair_history.min.js')
    .js('resources/js/property/business_plan.js', 'public/dist/js/business_plan.min.js')
    .js('resources/js/property/monthly-balance.js', 'public/dist/js/monthly-balance.min.js')
    .js('resources/js/property/annual-performance.js', 'public/dist/js/annual-performance.min.js')
    .js('resources/js/my_page/list.js', 'public/dist/js/list.min.js')
    .js('resources/js/property/search.js', 'public/dist/js/search.min.js')
    .js('resources/js/my_pages/article_photo.js', 'public/dist/js/article_photo.min.js')
    .js('resources/js/my_page/topic.js', 'public/dist/js/topic.min.js')
    .js('resources/js/profile/profile.js', 'public/dist/js/profile.min.js')
    .js('resources/js/profile/sub_user.js', 'public/dist/js/profile_sub_user.min.js')
    .js('resources/js/admin/top.js', 'public/dist/js/top.min.js')
    .js('resources/js/admin/user.js', 'public/dist/js/user-manage.min.js')
    .js('resources/js/admin/user-detail.js', 'dist/js/admin-user-detail.min.js')
    .js('resources/js/admin/invite-user.js', 'public/dist/js/invite-user.min.js')
    .js('resources/js/admin/support_user.js', 'public/dist/js/admin_support_user.min.js')
    .js('resources/js/admin/contact_user.js', 'public/dist/js/admin_contact_user.min.js')
    .js('resources/js/user_setting/create-card.js', 'public/dist/js/create-card.min.js')
    .js('resources/js/user_setting/pay-card.js', 'public/dist/js/pay-card.min.js')
    .js('resources/js/user_setting/pay-detail.js', 'public/dist/js/pay-detail.min.js')
    .js('resources/js/top/*', 'public/dist/js/new_top.min.js')
    .js('resources/js/csv/download.js', 'public/dist/js/download.min.js')
    .js('resources/js/information/add.js', 'public/dist/js/information_add.min.js')
    .js('resources/js/information/index.js', 'public/dist/js/information_index.min.js')
    .js('resources/js/home/home.js', 'public/dist/js/home.min.js')
    .js('resources/js/home/top_index.js', 'public/dist/js/top_index.min.js')
    .js('resources/js/property/sub-user-property.js', 'public/dist/js/sub-user-property.min.js');
