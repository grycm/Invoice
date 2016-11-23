$(function () {

    var countBtn = $('#count_btn');
    var addBtn = $('#add_btn');
    var lp = 1;

    countBtn.on('click', function (e) {
        e.preventDefault();
        var rows = $('.product_row');

        for (var row of rows) {

            console.log(row);
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
    });

    addBtn.on('click', function (e) {
        e.preventDefault();

        $('#products > tbody').append('<tr class="product_row">'+
            '<td>' + ++lp + '</td>'+
            '<td class="product_name"><input type="text" name="product_name[]"></td>'+
            '<td class="product_quantity"><input type="number" name="product_quantity[]"></td>'+
            '<td class="netto_price"><input type="number" name="netto_price[]"></td>'+
            '<td class="netto_value"><input type="number" disabled="disabled" name="netto_value[]"></td>'+
            '<td class="vat"><input type="number" value="23" disabled="disabled" name="vat[]"></td>'+
            '<td class="vat_value"><input type="number" disabled="disabled" name="vat_value[]"></td>'+
            '<td class="brutto_value"><input type="number" disabled="disabled" name="brutto_value[]"></td>'+
            '</tr>');
    });

});
