$(function () {
    var row = $('.product_row');

    var countBtn = $('#count_btn');

    countBtn.on('click', function (e) {
        e.preventDefault();

        var productQuantity = row.find('.product_quantity > input').val();
        var nettoPrice = row.find('.netto_price > input').val();
        var vat = row.find('.vat > input').val();

        var nettoValue = productQuantity * nettoPrice;
        var vatValue = nettoValue * (vat / 100);
        var bruttoValue = nettoValue + vatValue;
        $('.netto_value > input').val(nettoValue);
        $('.brutto_value > input').val(bruttoValue);
        $('.vat_value > input').val(vatValue);
    });

});