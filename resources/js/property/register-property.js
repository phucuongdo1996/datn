const TYPE_IMAGES_ALLOW = ['image/jpg', 'image/png', 'image/jpeg'];
const BASE_URL_IMAGES = window.location.origin + '/storage/images/';
const TOTAL_NUMBER_PREFECTURE = 47;
const TOTAL_NUMBER_ESTATE_TYPE = 10;
const FLAG_ONE = 1;
const ADDRESS_DISTRICT = 'address-district';
const OPERATING_REVENUE = [
    'revenue_land_taxes', 'revenue_room_rentals', 'revenue_service_charges', 'revenue_utilities',
    'revenue_car_deposits', 'turnover_revenue', 'revenue_contract_update_fee', 'revenue_other', 'bad_debt'
];
const OPERATING_FEE = [
    'maintenance_management_fee', 'electricity_gas_charges', 'repair_fee', 'recovery_costs',
    'property_management_fee', 'find_tenant_fee', 'tax', 'loss_insurance', 'land_rental_fee', 'other_costs'
];
const OPERATING_EXPENSES = [
    'total_revenue', 'total_cost'
];
const RENTAL_PERCENTAGE = [
    'area_rental_operating', 'area_may_rent'
];

let total,
    reducer,
    $inputAvatar = $('#input-avatar'),
    $imageAvatar = $('#image-avatar'),
    checkImage = true,
    categories = commonHighcharts.setCategoriesColumnChart(35);
let scatterChart;
let dateMonthRevenue = $('#date_month_registration_revenue');
let dateYearRevenue = $('#date_year_registration_revenue');
let balancePeriod = $('#balance-period');

var property = (function () {
    let modules = {};

    modules.displayDataDate = function() {
        if(dateMonthRevenue.val() != '' && dateYearRevenue.val() != '') {
            let dataMonth = dateMonthRevenue.find(':selected').data('id');
            let dataYear = dateYearRevenue.find(':selected').data('id');

            if(dataMonth == 12) {
                balancePeriod.html('収支期間 : ' + dataYear + '年 ' + 1  + '月 〜 ' + dataYear +'年 ' + dataMonth + '月')
            } else {
                balancePeriod.html('収支期間 : ' + (dataYear - 1)  + '年 ' + (dataMonth + 1) + '月 〜 ' + dataYear +'年 ' + dataMonth + '月')
            }
        } else {
            balancePeriod.html('');
        }
    };

    modules.appendData = function (id, className) {
        let number = (className === ADDRESS_DISTRICT) ? TOTAL_NUMBER_PREFECTURE : TOTAL_NUMBER_ESTATE_TYPE;
        for(let i=FLAG_ONE; i<=number ; i++) {
            if(id  === i) {
                $('.' + className + '-' + i).each(function (index, element) {
                    $('.' + className).append( '<option class="property-'+ className +'" value="'+ $(element).val() +'">'+ $(element).data('name') +'</option>' );
                });
                break;
            }
        }
    };

    modules.getIdReadEstateType = function (id) {
        $('.property-detail-real-estate-type-id').remove();
        $('select[name=detail_real_estate_type_id]').val('');
        property.appendData(parseInt(id), 'detail-real-estate-type-id');
    };

    modules.setValueEditReadEstateType = function () {
        let idReadEstateType = $('select#read-estate-type').children("option:selected").val();
        let idDetail = $('.edit-detail-real-estate').val();
        property.getIdReadEstateType(idReadEstateType);
        $('select[name=detail_real_estate_type_id]').val(idDetail);
    };

    modules.setValueEditDistrict= function () {
        let id = $('select.address-city').children("option:selected").data("id");
        let idDistrict = $('.edit-address-district').val();
        property.appendData(id, 'address-district');
        $('select[name=address_district]').val(idDistrict);
    };

    modules.sumTotal = function (arr, reducer, inputName) {
        if (arr.reduce(reducer) === 0) {
            total = 0;
        } else {
            total = arr.reduce(reducer);
        }

        $(inputName).val(modules.addCommas(total.toString()));
    };

    modules.getValueOperatingRevenue = function (reducer) {
        return modules.sumTotal(Common.getValueOperatingItem(OPERATING_REVENUE), reducer, ':input[name="total_revenue"]');
    };

    modules.getValueOperatingFee = function(reducer) {
        return modules.sumTotal(Common.getValueOperatingItem(OPERATING_FEE), reducer, ':input[name="total_cost"]');
    };

    modules.getValueOperatingExpenses = function () {
        let reducerOperatingExpenses = (accumulator, currentValue) => accumulator - currentValue;
        total = Common.getValueOperatingItem(OPERATING_EXPENSES).reduce(reducerOperatingExpenses);
        $(':input[name="operating_expenses"]').val(modules.addCommas(total.toString()));
        $(':input[id="operating-expenses"]').val(modules.addCommas(total.toString()) + ' 円');
    };

    modules.getValueRentalPercentage = function () {
        let reducerRentalPercentage  = (accumulator, currentValue) => (accumulator / currentValue) * 100;
        if ($(':input[name="area_may_rent"]').val() != '' && $(':input[name="area_rental_operating"]').val() != '' && $(':input[name="area_may_rent"]').val() != 0) {
            total = Common.getValueOperatingItem(RENTAL_PERCENTAGE).reduce(reducerRentalPercentage);
            $(':input[id="rental-percentage"]').val(modules.addCommas(total.toFixed(2).toString())+' %');
            $(':input[name="rental_percentage"]').val(modules.addCommas(total.toFixed(2).toString()));
        } else {
            total = 0;
            $(':input[name="rental_percentage"]').val(modules.addCommas(total.toFixed(2).toString()));
            $(':input[id="rental-percentage"]').val(modules.addCommas(total.toFixed(2).toString())+' %');
        }
    };

    modules.getAddressZipCode = function (zipCode) {
        let postal_code = require('japan-postal-code');

        $('select[name=address_city]').val('');
        $('select[name=address_district]').val('');
        $('input[name=address_town]').val('');

        postal_code.get(zipCode, function(address) {
            $('select[name=address_city]').val(address.prefecture);
            property.appendData($('select[name=address_city]').find(':selected').data("id"), 'address-district');
            $('select[name=address_district]').val(address.city);
            $('input[name=address_town]').val(address.area );
        });
    };

    modules.setValueBankName = function () {
        let listBank = require('zengin-code');
        $.each(listBank, function (key, value) {
            let code = value['code'];
            let name = value['name'];
            $('#api-bank').append( '<option value="'+code+'">'+name+'</option>' );
            if ( $("#api-bank-branch").hasClass('bank-branch-'+code+'')) {
                $("#api-bank-branch").removeClass('bank-branch-'+code+'');
            }
        });
    };

    modules.getBankNameToShowInEdit = function () {
        let listBank = require('zengin-code');
        let $loanBankNameEdit = $('#loan-bank-name').val();
        let $bankBranchNameEdit = $('#bank-branch-name').val();
        if (typeof $loanBankNameEdit != 'undefined' && $loanBankNameEdit != "") {
            $('#api-bank').val(listBank[$loanBankNameEdit]['code']);
            $('#api-bank').find('option[value='+listBank[$loanBankNameEdit]['code']+']')[0].checked = true;
            modules.setValueBankBranchName(listBank[$loanBankNameEdit]['code']);
        }
        if (typeof $bankBranchNameEdit != 'undefined' && $bankBranchNameEdit != "") {
            $('#api-bank-branch').val(listBank[$loanBankNameEdit]['branches'][$bankBranchNameEdit]['code']);
            $('#api-bank-branch').find('option[value='+listBank[$loanBankNameEdit]['branches'][$bankBranchNameEdit]['code']+']')[0].checked = true;
        }
    };

    modules.setValueBankBranchName = function (bankCode) {
        $('#api-bank-branch').addClass('bank-branch-'+bankCode+'');
        let listBank = require('zengin-code');
        $(".bank-branch-"+bankCode).children('option').remove();

        if (!bankCode || (bankCode && bankCode.length == 0)) {
            $('#api-bank-branch').append( '<option value="">---</option>' );
        }
        $.each(listBank, function (key, value) {
            if (key === bankCode) {
                $('#api-bank-branch').append( '<option value="">---</option>' );
                $.each(value['branches'], function (key, value) {
                   $('#api-bank-branch').append( '<option class="bank-'+bankCode+'" value="'+ value['code'] +'">'+ value['name'] +'</option>' );
               });
           }
        });
    };

    modules.filterByText = function (selectId, filterId) {
        return $(selectId).each(function() {
            let select = this, options = [];
            $(select).find('option').each(function() {
                options.push({
                    value: $(this).val(),
                    text: $(this).text()
                });
            });
            if (selectId == '#api-bank-branch' && (!$('#api-bank').val() || ($('#api-bank').val() && $('#api-bank').val().length == 0))) {
                $(select).data('options', []);
            }
            $(select).data('options', options);
            $(filterId).bind('change keyup', function() {
                let options = $(select).empty().data('options'), search = $.trim($(this).val()), regex = new RegExp(search, "gi");
                $.each(options, function(i) {
                    let option = options[i];
                    if (option.text.match(regex) !== null) {
                        $(select).append(
                            $('<option>').text(option.text).val(option.value)
                        );
                    }
                });
                if (selectId == '#api-bank') {
                    property.setValueBankBranchName($(selectId).val());
                }
            });
        });
    };

    modules.setEventSelectImageMap = function ($imageMap, $inputImageMap) {
        $imageMap.on('click', function (event) {
            modules.prevent(event);
            $inputImageMap.trigger('click');
        });
        $imageMap.on('dragover', function (event) {
            modules.prevent(event);
        });
        $imageMap.on('dragleave', function (event) {
            modules.prevent(event);
        });
        $imageMap.on('drop', function (event) {
            modules.fileSelectHandler(event, true);
        });
        $inputImageMap.on('change', function (event) {
            modules.fileSelectHandler(event, false);
        });
    };

    modules.fileSelectHandler = function (event, isDrop) {
        modules.prevent(event);
        let files = event.target.files || event.originalEvent.dataTransfer.files;
        if (files.length === 0) {
            return
        }
        if (isDrop) {
            $inputAvatar.prop('files', files);
        }
        $imageAvatar.html('');
        $imageAvatar.append(modules.createImageMapPreview(URL.createObjectURL(files[0])));
        $('#input-avatar-url').val('');
        modules.checkValidateImageAdd();
    };

    modules.createImageMapPreview = function (src) {
        let $container = $('<div>', {
                class: "dz-default dz-message"
            }),
            $img = $('<img>', {
                class: 'property-img-view-custom',
                src: src
            }).appendTo($container);
        return $container;
    };

    modules.prevent = function (event) {
        event.preventDefault();
        event.stopPropagation()
    };

    modules.getFormData = function () {
        let data = new FormData($('#form-data-property')[0]);
        data.append("address_city", $('.address-city').val());
        data.append("address_district", $('.address-district').val());
        data.append("address_town",  $('.address-town').val());
        data.append("total_cost",  $('.total-cost').val());
        data.append("total_revenue",  $('.total-revenue').val());
        data.append("operating_expenses",  $('.operating-expenses').val());
        data.append("rental_percentage",  $('.property-rental-percentage').val());
        data.append("_token", $('meta[name="csrf-token"]').attr('content'));
        data.append("bank_name", $('select[name="loan_bank_name"] option:selected').text());
        data.append("loan_bank_branch_name", $('select[name="bank_branch_name"] option:selected').text());
        if(checkImage == false) {
            data.set('avatar', '');
        }
        return data;
    };

    modules.saveData = function () {
        let dataCreate = modules.getFormData();
        Common.convertNumeralForForm(dataCreate);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/store/',
            data: dataCreate,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.save == false) {
                window.location.reload();
            } else {
                if (response.save == 1) {
                    window.location.href ='/property';
                } else  {
                    window.location.href ='/property?page=' + response.save;
                }
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList);
            $('.res-info-property').attr("disabled", false);
        });
    };

    modules.checkValidateImageAdd = function() {
        let file = $inputAvatar[0].files[0];
        if (TYPE_IMAGES_ALLOW.indexOf(file.type) === -1) {
            modules.showMessageValidateImage('画像の形式はjpgかpngの許可されています。');
            $imageAvatar.html('<i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>');
            checkImage = false;
        } else if (file.size > 5120000) {
            $imageAvatar.html('<i class="fa fa-picture-o fa-3x" aria-hidden="true"></i>');
            modules.showMessageValidateImage('画像1枚の容量は5MBまでです。');
            checkImage = false;
        } else {
            checkImage = true;
        }

        if (checkImage) {
            modules.showMessageValidateImage('');
        }
    };

    modules.showMessageValidateImage = function(message) {
        if (message === '') {
            $('p[data-error=avatar]').text(message).show();
            $('p[data-error=avatar]').removeClass('image-error').show();
        } else {
            $('p[data-error=avatar]').text(message).show();
            $('p[data-error=avatar]').addClass('image-error').show();
        }
    };

    modules.updateData = function () {
        let dataUpdate = modules.getFormData();
        Common.convertNumeralForForm(dataUpdate);
        dataUpdate.append("revenue_land_taxes",  $('.revenue-land-taxes').val().split(",").join(""));
        let submitAjax = $.ajax({
            type: "POST",
            url: Common.buildUrlRequest('/property/update/'),
            data: dataUpdate,
            processData: false,
            contentType: false,
        });

        submitAjax.done(function (response) {
            if (response.updated == true) {
                if(response.redirect !== undefined) {
                    window.location.href = response.redirect;
                    return false;
                }
                if (response.pageNumber == 1) {
                    window.location.href ='/property';
                } else {
                    window.location.href ='/property?page=' + response.pageNumber;
                }
            } else {
                window.location.reload();
            }
        });

        submitAjax.fail(function (response) {
            let messageList = response.responseJSON.errors;
            Common.showMessageValidate(messageList);
            $('.update-property').attr("disabled", false);
        });
    };

    modules.convertDate = function (key, value) {
        $('input[name='+key+']').val(value.split("-").join("/"));

    };

    modules.addUnit = function () {
        $('input[id=rental-percentage]').val($('input[name=rental_percentage]').val() + ' %');
        $('input[id=operating-expenses]').val($('input[name=operating_expenses]').val() + ' 円');
    };

    modules.addCommas = function (nStr) {
        nStr += '';
        let x = nStr.split('.');
        let x1 = x[0];
        let x2 = x.length > 1 ? '.' + x[1] : '';
        let rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    };

    modules.checkValidate = function () {
        let listError = $(document).find('p.image-error');
        if (listError.length !== 0) {
            $('html, body').animate({
                scrollTop: (
                    $(document).find('p.image-error').offset().top - 300
                )
            }, 1000);
            return false
        }
        return true;
    };

    return modules;
}(window.jQuery, window, document));

var highchartRegisterProperty = (function () {
    let modules = {} ;

    modules.buildCharts = function () {
        modules.updateSpiderWebChart();
        modules.buildScatterChart();
        modules.updateColumnChart();
        modules.showOrHideScatterChart();
    };

    modules.showOrHideScatterChart = function () {
        let realEstateTypeId = $('select.real-estate-type').val();
        if (realEstateTypeId == 9 || realEstateTypeId == 10) {
            $("#scatter-chart").attr("hidden",false);
        } else {
            $("#scatter-chart").attr("hidden",true);
        }
    };

    modules.updateColumnChart = function () {
        let loan = Common.convertStringToNumber($('input[name="loan"]').val()),
            nper = Common.convertStringToNumber($('select[name="contract_loan_period"]').val()),
            rate = Common.convertStringToNumber($('input[name="interest_rate"]').val()) / 100,
            operatingExpenses = Common.convertStringToNumber($('input[name="operating_expenses"]').val()),
            series = [],
            title = '';
        if (loan !=0) {
            series.push(commonHighcharts.setItemColumnChart('ローン残高（右軸)', 'column', 1, '#4F81BD', commonHighcharts.calculateRepayment(loan, nper, rate, 0, 0), ''));
        }
        if (operatingExpenses != 0) {
            series.push(commonHighcharts.setItemColumnChart('累計CF（右軸)', 'column', 1, '#EE72DC', commonHighcharts.calculateGrandTotalCF(operatingExpenses, loan, nper, rate, 0), ''));
            series.push(commonHighcharts.setItemColumnChart('CF（左軸)', 'line', 0, 'red', commonHighcharts.calculateCF(operatingExpenses, loan, nper, rate, 0), ''));
        }
        if (series.length > 0) {
            $('.highcharts-note').show();
            title = 'CF シミュレーショ ン';
        } else {
            title = '';
            $('.highcharts-note').hide();
        }
        commonHighcharts.buildColumnChart('chart-simulation-add-home', title, categories, '(万円)', '（万円)', series);
    };

    modules.buildSpiderWebChart = function (data) {
        let idDiv = 'spiderweb-chart',
            categories = ['賃料水準', '運営費用', '損害保険料', '修繕費',
                '維持管理費', '運営収益'],
            series = [{
                name: 'center',
                data: defaultData,
                pointPlacement: 'on',
                color: '#707070',
                lineWidth: 2,
                tooltip: {
                    pointFormat: '',
                },
            },{
                name: '対象不動産',
                data: data,
                pointPlacement: 'on',
                color: '#0E7AFF'
            }];
        commonHighchart.buildSpiderWebChart(idDiv, categories, series, 'レジデンス-SCOREMAP-', false);
    };

    modules.buildScatterChart = function () {
        let formdata = new FormData();
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/highcharts/scatter/',
            data: formdata,
            processData: false,
            contentType: false,
        });
        const TYPES = ['オフィスビル_事務所', 'レジデンス_住宅', 'リテール_店舗', 'ヘルスケア・ホテル', 'ロジ・インダストリー'];
        const URL_ICON = [BASE_URL_ICON_01, BASE_URL_ICON_02, BASE_URL_ICON_03, BASE_URL_ICON_04, BASE_URL_ICON_05];
        submitAjax.done(function (response) {
            let seriesScatter = [];
            let listPoint = [];
            let checkParabol = false;
            $.each(response.data, function (key, value) {
                listPoint = listPoint.concat(value);
                seriesScatter.push({
                    name: TYPES[key],
                    type: 'scatter',
                    data: value,
                    marker: {
                        symbol: "url("+URL_ICON[key]+")",
                        width: 6,
                        height: 6,
                    }
                });
            });
            modules.sortData(listPoint);
            let parabol = [];
            if (listPoint.length > 1) {
                let augment = (Number(listPoint[listPoint.length - 1][0]) - Number(listPoint[0][0])) / 100;
                let xValues = [];
                let slope = regression('polynomial', listPoint);
                let a = slope.equation[2], b = slope.equation[1], c = slope.equation[0];
                for (let k = listPoint[0][0]; k < listPoint[listPoint.length - 1][0]; k += augment) {
                    xValues.push(k);
                }
                parabol =  modules.plottingPoints(xValues, a, b, c)
            }
            seriesScatter.push({
                    name: '全体',
                    type: 'scatter',
                    data: [],
                    marker: {
                        symbol: 'url()'
                    }
                },{
                    name: '対象不動産',
                    color: '#ff0000',
                    type: 'line',
                    data: [],
                    marker: {
                        enabled: false
                    }
                },{
                    type: 'spline',
                    name: '多項式（全体）',
                    color: '#0099FF',
                    data: parabol,
                    marker: {
                        enabled: false
                    },
                    enableMouseTracking: false,
                }
            );
            let idDiv = 'scatter-chart';
            scatterChart = commonHighchart.buildScatterChart(idDiv, seriesScatter, "底地上アセットタイプ別 設定地代散布図", "", "月額地代単価（円/坪）", "年間地代（円/㎡）÷ 前面路線価（円/㎡）");
            modules.updateScatterChart();
        });
    };

    modules.sortData = function ($data) {
        for (let i = 0; i < $data.length - 1; i++) {
            for (let k = i + 1; k < $data.length; k++) {
                if ($data[i][0] > $data[k][0]) {
                    let tg = $data[i];
                    $data[i] = $data[k];
                    $data[k] = tg
                }
            }
        }
    };

    modules.updateScatterChart = function () {
        let x = Common.convertStringToNumber($('input[name=revenue_land_taxes]').val()),
            y = Common.convertStringToNumber($('input[name=ground_area]').val());
        let value = Common.divisionNumber(x, y) / 12 / 0.3025;
        scatterChart.xAxis[0].options.plotLines[0].value = Common.convertStringToNumber(value.toFixed(2));
        scatterChart.xAxis[0].update();
        if (scatterChart.series.length == 10) {
            scatterChart.series[scatterChart.series.length -1].remove();
        }
        scatterChart.addSeries({
            name: "scatter",
            type: 'scatter',
            data: [[value, scatterChart.yAxis[0].min]],
            showInLegend: false,
            enableMouseTracking: false,
            marker: {
                enabled: false
            }
        });
    };

    modules.plottingPoints = function(xValues, a, b, c) {
        let dataLin = [];
        $.each(xValues, function (key, value) {
            dataLin.push([value, (a * value * value) + (b * value) + c]);
        });
        return dataLin;
    };

    modules.updateSpiderWebChart = function () {
        let formdata = new FormData($('#form-data-property')[0]);
        formdata.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formdata.append('provincial', $('select[name=address_city]').val());
        formdata.append('district', $('select[name=address_district]').val());
        formdata.append('real_estate_type_id', $('#read-estate-type').val());
        Common.convertNumeralForForm(formdata);
        let submitAjax = $.ajax({
            type: "POST",
            url: '/property/highcharts/spiderweb/',
            data: formdata,
            processData: false,
            contentType: false,
        });
        submitAjax.done(function (response) {
            highchartRegisterProperty.buildSpiderWebChart(response.dataSpiderWeb);
        });
    };

    return modules;
}(window.jQuery, window, document));

Dropzone.autoDiscover = false;

$(document).ready(function () {
    property.setValueEditDistrict();
    Common.optionDateTime();
    property.setValueBankName();
    property.getBankNameToShowInEdit();
    property.filterByText('#api-bank','#filter-loan-bank');
    property.filterByText('#api-bank-branch','#filter-bank-branch');
    $('#filter-loan-bank').on('change', function () {
        $('#filter-bank-branch').val('');
        property.filterByText('#api-bank-branch','#filter-bank-branch');
    });
    property.setEventSelectImageMap($imageAvatar, $inputAvatar);
    property.setValueEditReadEstateType();
    highchartRegisterProperty.buildCharts();
    property.displayDataDate();

    $(document).on('change', '#form-data-property input[name=zip_code]', function () {
        property.getAddressZipCode($(this).val());
        setTimeout(function () {
            highchartRegisterProperty.updateSpiderWebChart();
        }, 500);
    });

    $('.address-city').on('change', function () {
        let id = $(this).find(':selected').data("id");
        $('.property-address-district').remove();
        $('select[name=address_district]').val('');
        property.appendData(id, 'address-district');
    });

    $('.address-city, .address-district, .address-town').on('change', function () {
        $('.zip-code').val(' ');
    });

    $("select#read-estate-type").on('change', function(){
        let id = $(this).children("option:selected").val();
        property.getIdReadEstateType(id);
    });

    $('input.money-receive-house').on('keypress keydown keyup change',　function() {
        let moneyReceiveHouse =  Common.convertStringToNumber($(':input[name="money_receive_house"]').val());

        if ($.isNumeric(moneyReceiveHouse) === true) {
            $(':input[name="loan"]').val(property.addCommas(Math.round(moneyReceiveHouse * 80 / 100)));
        } else {
            $(':input[name="loan"]').val('');
        }
    });

    reducer = (accumulator, currentValue) => accumulator + currentValue;

    $('input.operating-revenue').bind('keypress keydown keyup change',function() {
        property.getValueOperatingRevenue(reducer);
        property.getValueOperatingExpenses();
    });

    $('input.operating-fee').bind('keypress keydown keyup change',function() {
        property.getValueOperatingFee(reducer);
        property.getValueOperatingExpenses();
    });

    $('input.rental-percentage').bind('keypress keydown keyup change',function() {
        property.getValueRentalPercentage();
    });

    $("select#api-bank").on('change', function(){
        $('[class*="bank-branch-"]').attr('class', function(i, val){
            return val.replace(/(^|\s)bank-branch-\S+/g, '');
        });
        let bankCode = $(this).children("option:selected").val();
        $('#filter-bank-branch').val('');
        property.setValueBankBranchName(bankCode);
        property.filterByText('#api-bank-branch','#filter-bank-branch');
    });

    $('.res-info-property').on('click', function () {
        if (property.checkValidate()) {
            $('.res-info-property').attr("disabled", true);
            property.saveData();
        }
    });

    $('.update-property').on('click', function () {
        if (property.checkValidate()) {
            $('.update-property').attr("disabled", true);
            property.updateData();
        }
    });

    $('.find-property').on('click', function () {
        let id = $(this).data('id');
        property.findData(id);
    });

    $('select.real-estate-type').on('change',function() {
        let realEstateTypeId = $(this).children("option:selected").val();
        let revenueLandTaxes = $('.operating-revenue:input[name="revenue_land_taxes"]').val();
        let totalRevenue = $('.total-revenue').val();
        let operatingExpenses = $('.operating-expenses').val();
        let total = property.addCommas(Common.convertStringToNumber(totalRevenue) - Common.convertStringToNumber(revenueLandTaxes));
        let totalOperatingExpenses = property.addCommas(Common.convertStringToNumber(operatingExpenses) - Common.convertStringToNumber(revenueLandTaxes));
        if (realEstateTypeId == 9) {
            $('.revenue_land_taxes').removeAttr("disabled");
            $('.revenue_land_taxes').removeClass("disable-field");
            $('#div-main_application').css('display', 'none');
        } else if (realEstateTypeId == 10) {
            $('.revenue_land_taxes').removeAttr("disabled");
            $('.revenue_land_taxes').removeClass("disable-field");
            $('#div-main_application').css('display', 'flex');
        } else {
            $(':input[name="revenue_land_taxes"]').val('0');
            $(':input[name="total_revenue"]').val(total);
            $(':input[name="operating_expenses"]').val(totalOperatingExpenses);
            $(':input[id="operating-expenses"]').val(totalOperatingExpenses + ' 円');
            $('.revenue_land_taxes').attr('disabled', 'disabled');
            $('.revenue_land_taxes').addClass("disable-field");
            $('#div-main_application').css('display', 'none');
        }
        $('select[name="main_application"]').val('');
    });

    $('select[name="contract_loan_period"]').on('change',　function() {
        highchartRegisterProperty.updateColumnChart();
    });

    $('input[name="interest_rate"], input[name="loan"], input.money-receive-house, input.operating-fee, input.operating-revenue').on('focusout',　function() {
        highchartRegisterProperty.updateColumnChart();
    });

    $('#main-info-property select').on('change', function(){
        highchartRegisterProperty.updateSpiderWebChart();
    });

    $('#main-info-property input').not($("input[name='zip_code']")).on('focusout', function(){
        highchartRegisterProperty.updateSpiderWebChart();
    });

    $('input[name=revenue_land_taxes], input[name=ground_area]').on('focusout', function () {
        highchartRegisterProperty.updateScatterChart();
    });

    $(document).on('change focusout', '#date_month_registration_revenue', function () {
        property.displayDataDate();
    });

    $(document).on('change focusout', '#date_year_registration_revenue', function () {
        property.displayDataDate();
    });
    $('select.real-estate-type').on('change',function() {
        highchartRegisterProperty.showOrHideScatterChart();
        highchartRegisterProperty.updateScatterChart();
    });
});
