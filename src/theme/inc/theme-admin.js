(function($){
$(document).ready(function() {
    var $body = $('body');


      // if($body.hasClass('post-type-inscricoes') || $body.hasClass('post-type-marcacoes_consultas')) {
      //   var name = $(".buro-link-name").find("input").attr("value");
      //   var link = $(".buro-link").find("input").attr("value");

      //   $("#postbox-container-2").find($('input')).attr('disabled', 'disabled');
      //   $("#postbox-container-2").find($('.buro-selectable input')).attr('disabled', false);
      //   //$(".buro-link").find(".acf-input").html("<a target='_blank' href='" + link + "'>" + name + "</a>");


      //   $(".buro-payment .add-attachment").text("Adicionar comprovativo");
      // }


      if($('a[href$="edit.php?post_type=product&page=product_attributes"]')) {
        $('a[href$="edit.php?post_type=product&page=product_attributes"]').parent().hide();
      }
        
    });
})(jQuery);
