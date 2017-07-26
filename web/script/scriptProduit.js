$(function()
{  
    $('.ajout_panier').click(function (e)
    {
        e.preventDefault();
        
        $.ajax({
            url: ajaxApiUrlPanier,
            method: "POST",
            data:
            {
                id: $(".title h2").attr('id')
            }
        })

        .done(function (data)
        {
            console.log('ok');

        })
            
        .fail(function (data)
        {
            console.log('KO...');
        })
    });
});
