// JavaScript Document


//$(document).ready(function()
//{
//	moreOptions('.recurr' , '.pMore'  );
//});


function  moreOptions( recur  , opt)
{
	$(opt).hide();
	$(recur).attr({checked: ""});
	$(recur).bind('click',
										
				function()
				  {
					var temp = $(recur).attr('checked');
					var var_value = $(recur).val();
					
					if( temp)
					{
						get_tariff_cost(var_value);
						$(opt).slideDown();
						
						$(opt).animate({opacity: 1}, 'slow');
						
					  
					}
					if( temp  == false)
					{
						get_tariff_cost("undefined");
						$(opt).animate({opacity: 0} ,  {complete :  function()
									   {
													$(this).slideUp('slow');
										  
										  }});
					}
						
					 });
										
}
var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }

