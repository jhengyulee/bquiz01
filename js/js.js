// JavaScript Document
$(document).ready(function(e) {
    $(".mainmu").mouseover(
		function()
		{
			$(this).children(".mw").stop().show()
		}
	)
	$(".mainmu").mouseout(
		function ()
		{
			$(this).children(".mw").hide()
		}
	)
});


function lo(x)
{
	location.replace(x) //replace(選擇器:網址) 換頁函式
}
function op(x,y,url)
{
	$(x).fadeIn()
	if(y)                  //if後面只有一行，那行被視為true第二行以後視為f alse  Fr:C語言
	$(y).fadeIn()
	if(y&&url)
	$(y).load(url)
}
function cl(x)
{
	$(x).fadeOut();
}