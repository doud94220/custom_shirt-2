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
                    $('.display').html(data);
                })

        });



    $('.ajout_panier').off('click').on('click', function (e) {
        console.log('ok');
       e.preventDefault();
        $.ajax({
            url: ajaxApiUrlPanier,
            method: "POST",
            data: {
                id: $(".title h1").attr('id')
            }


        })

            .done(function (data) {
                 console.log(data);

            })
        localStorage.setItem("panier", $(".title h1").attr('id'))
        localStorage.getItem("panier")

    });






});
