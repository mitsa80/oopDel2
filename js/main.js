$(function(){

	$(".reset").click(function(){
		$(".headerMessage").css({display: "block"});
		$("#player").val("");
		$("select#selectClass option:first").attr('selected','selected');
		
		$.ajax({
			url:"php/start_game.php",
			dataType:"json",
			success:function(data){
			}
		});
	});

	$("#gameForm").submit(function(){
		var player=$("#player").val();
		var cahracter=$("select#selectClass option:selected").val();
		startNewGame(player,cahracter);
		
		return false;
	});

	function startNewGame(player,cahracter){
	
		$.ajax({
			url:"php/start_game.php",
			dataType:"json",
			data:{
				player_name: player,
				player_class:cahracter
			},
			success:function(data){
				$(".messageBox1").css({display: "block"});
				$('.messageBox1').append("<p>These are facts about you: <p><br>");
				var spObj=data.players[0];
				$.each( spObj, function( key, value ) {
					$(".messageBox1").append("<p>",key + " : " +value+"</p><br>");
				});
			}
		
		});
	}









});


