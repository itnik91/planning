$(function(){
	$(".plng").click(function(){
		$('.planningjs').hide();
			var semaine = $(this).attr("href");
			$.post('plng.php',{semaine:semaine,action:"getSemaine"},function(data){
					$('.planningjs').slideDown().html(data);
			});
	return false;
	});
});