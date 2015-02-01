

$(document).ready(function() {
 $("#pmt_chk_all").click(function(){
  if($(this).prop("checked") == true){ //check all
   $("input[name='pmt_chk[]']").each(function(){
    $(this).prop("checked",true);
   });
  }else{
   $("input[name='pmt_chk[]']").each(function(){
    $(this).prop("checked",false);
   });
  }
 });
});



		$(function(){ 
    		$("#vendor_name").autocomplete({ 
    			delay:500,
        		source: "../vendorsearch", 
        		minLength: 2,
        		select: function(event,ui){
        			
        			$("#bank_info").autocomplete("search",ui.item.label);
        		}      		
    		}); 
		}); 
		
		$(function(){
			$("#bank_info").autocomplete({
				source: "../banksearch",
			});
		});
