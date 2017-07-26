/********STOCKAGE INFORMATIONS DANS BALISE HIDDEN************/

//alert('ok');
$(function() 
{
    $('.select_img').click(function()
    {
        var id = $(this).data('id');
        console.log(id);
        $('#custom_product').val(id);
    });
});      