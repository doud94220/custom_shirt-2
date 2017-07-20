$(function() {

        $('.request').change(function (e) {
            e.preventDefault();
            $.ajax({
                url: ajaxApiUrl,
                method: "GET",
                data: {
                    categorie: $("#categorie").val(),
                    type: $("#type").val(),
                    couleur: $("#couleur").val(),
                    taille: $("#taille").val(),
                    sexe: $("#sexe").val(),
                    prix: $("#prix").val(),
                    tissu: $("#tissu").val(),
                    range: $("#range").val(),
                    nombre: $('#nombre').val()
                }
            })

                .done(function (data) {
                    console.log(data);
                    $('.display').html(data);
                })

        });

    $('.ajout_panier').click(function (e) {
        e.preventDefault();
        console.log($(".title h1").attr('id'));
        $.ajax({
            url: ajaxApiUrlPanier,
            method: "POST",
            data: {
                id: $(".title h1").attr('id')
            }
        })

            .done(function (data) {
                console.log('ok');

            })
            
            .fail(function (data) {
                console.log('KO l ajout au panier...');

            })

    });




/********STOCKAGE INFORMATIONS DANS BALISE HIDDEN************/

$('.select_img').click(function(){
    var id = $(this).data('id');
    console.log(id);
    $('#custom_product').val(id);
});




});
