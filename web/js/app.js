$(function () {

    var countBtn = $('#count_btn');
    var addBtn = $('#add_btn');
    var lp = 1;

    countBtn.on('click', function (e) {
        e.preventDefault();
        var rows = $('.product_row');

        for (var row of rows) {

            var productQuantity = $(row).find('.product_quantity > input').val();
            var nettoPrice = $(row).find('.netto_price > input').val();
            var vat = $(row).find('.vat > input').val();

            var nettoValue = productQuantity * nettoPrice;
            var vatValue = nettoValue * (vat / 100);
            var bruttoValue = nettoValue + vatValue;
            $(row).find('.netto_value > input').val(nettoValue);
            $(row).find('.brutto_value > input').val(bruttoValue);
            $(row).find('.vat_value > input').val(vatValue);

        }

        var nettoValues = $('.netto_value > input');
        var vatValues = $('.vat_value > input');
        var bruttoValues = $('.brutto_value > input');

        $('#netto_sum').text(getSum(nettoValues));
        $('#vat_sum').text(getSum(vatValues));
        $('#brutto_sum').text(getSum(bruttoValues));
    });

    addBtn.on('click', function (e) {
        e.preventDefault();

        $('#products > tbody').append('<tr class="product_row">'+
            '<td>' + (parseInt(lp)+parseInt(1)) + '</td>'+
            '<td class="product_name"><input type="text" class="form-control" name="product['+lp+'][product_name]"></td>'+
            '<td class="product_quantity"><input type="number" class="form-control" name="product['+lp+'][product_quantity]"></td>'+
            '<td class="netto_price"><input type="number" class="form-control" name="product['+lp+'][netto_price]"></td>'+
            '<td class="netto_value"><input type="number" class="form-control" readonly="readonly" name="product['+lp+'][netto_value]"></td>'+
            '<td class="vat"><input type="number" class="form-control" value="23" readonly="readonly" name="product['+lp+'][vat]"></td>'+
            '<td class="vat_value"><input type="number" class="form-control" readonly="readonly" name="product['+lp+'][vat_value]"></td>'+
            '<td class="brutto_value"><input type="number" class="form-control" readonly="readonly" name="product['+lp+'][brutto_value]"></td>'+
            '</tr>');
        lp++
    });

    function getSum(object) {
        var sum = 0;

        for (var value of object) {
            sum += parseInt($(value).val());
        }

        return sum;
    }

//    var optionsSeller = {
//
//        url: function(phrase) {
//            return "api/seller_search";
//        },
//
//        list: {
//
//            onChooseEvent: function () {
//                var data = $("#seller_name").getSelectedItemData();
//                //$("input[name='seller_name']").val(data.sellerName);
//                $("input[name='seller_address']").val(data.sellerAddress);
//                $("input[name='seller_city']").val(data.sellerCity);
//                $("input[name='seller_postal']").val(data.sellerPostal);
//                $("input[name='seller_NIP']").val(data.sellerNIP);
//            }
//        },
//
//        getValue: function(element) {
//            return element.sellerName;
//        },
//
//        ajaxSettings: {
//            dataType: "json",
//            method: "POST",
//            data: {
//                dataType: "json"
//            }
//        },
//
//        preparePostData: function(data) {
//            data.phrase = $("#seller_name").val();
//            return data;
//        },
//
//        requestDelay: 400
//    };
//
//    var optionsClient = {
//
//        url: function(phrase) {
//            return "api/client_search";
//        },
//
//        list: {
//
//            onChooseEvent: function () {
//                var data = $("#client_name").getSelectedItemData();
//                //$("input[name='seller_name']").val(data.sellerName);
//                $("input[name='client_address']").val(data.clientAddress);
//                $("input[name='client_city']").val(data.clientCity);
//                $("input[name='client_postal']").val(data.clientPostal);
//                $("input[name='client_NIP']").val(data.clientNIP);
//            }
//        },
//
//        getValue: function(element) {
//            return element.clientName;
//        },
//
//        ajaxSettings: {
//            dataType: "json",
//            method: "POST",
//            data: {
//                dataType: "json"
//            }
//        },
//
//        preparePostData: function(data) {
//            data.phrase = $("#client_name").val();
//            return data;
//        },
//
//        requestDelay: 400
//    };
//
//    $("#seller_name").easyAutocomplete(optionsSeller);
//    $("#client_name").easyAutocomplete(optionsClient);

});
