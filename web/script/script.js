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

        // On met en localStorage une KEy='panier et une VALUE=id_produit
        localStorage.setItem("panier",$(".title h1").attr('id'))

    });



/********STOCKAGE INFORMATIONS DANS BALISE HIDDEN************/

$('.select_img').click(function(){
    var id = $(this).data('id');
    console.log(id);
    $('#custom_product').val(id);
});




});
