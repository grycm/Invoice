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
            '<td class="product_name"><input type="text" name="product['+lp+'][product_name]"></td>'+
            '<td class="product_quantity"><input type="number" name="product['+lp+'][product_quantity]"></td>'+
            '<td class="netto_price"><input type="number" name="product['+lp+'][netto_price]"></td>'+
            '<td class="netto_value"><input type="number" readonly="readonly" name="product['+lp+'][netto_value]"></td>'+
            '<td class="vat"><input type="number" value="23" readonly="readonly" name="product['+lp+'][vat]"></td>'+
            '<td class="vat_value"><input type="number" readonly="readonly" name="product['+lp+'][vat_value]"></td>'+
            '<td class="brutto_value"><input type="number" readonly="readonly" name="product['+lp+'][brutto_value]"></td>'+
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

});
