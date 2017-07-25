$(function()
{
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
});
