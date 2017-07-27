$(function()
{
    ///// CALCUL DU PRIX TOTL DU PANIER
    
    //Initialisation du montant total du panier
    let totalAmount = 0;
    
    //on boucle sur toutes les produits ou configs
    $('.customOrProduct').each(function(index)
    {
        //calcul du prix pour le produit ou config sur lequel ou boucle
        let currentPrice = $(this).find('td').eq(1).text();
        currentPrice = parseFloat(currentPrice);
  
        //calcul de la quantité pour le produit ou config sur lequel ou boucle
        let currentQuantity = $(this).find('td').eq(2).text();
        currentQuantity = parseFloat(currentQuantity);     
        
        //calcul du montant pour le(s) produit(s) ou config(s) sur lequel/lesquels on boucle
        let currentAmount = currentPrice * currentQuantity;
        
        //Mise a jour du montant toal du panier
        totalAmount += currentAmount;
        
    }); //Fin boucle
    
    //On met le prix total du panier dans le bon champ pour le visualiser sur la vue
    $('.montantPanier').text(totalAmount + ' €').css('font-weight','bolder');
    
    //On met le prix total du panier dans le bon champ (champ hidden) pour le passer en post lors de la validation du formulaire
    $('.montantPanierPourPost').val(totalAmount);
    
    
    
    ///// GESTION DE LA SOURIS SUR LE BOUTON
   
   $('button').mouseover(function()
   {
       $(this).css('background','#C8E6C9 ');
   });
   
   $('button').mouseleave(function()
   {
       $(this).css('background', 'initial');
   });
   
   $('button').mousedown(function()
   {
       $(this).css('background','#81C784 ');
   });
    
});//Fin fonction globale
