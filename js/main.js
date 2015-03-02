$(function(){

	$(".reset").on("click",function(){
		
		$(".headerMessage").css({display: "block"});
		$("#player").val("");
		$("select#selectClass option:first").attr('selected','selected');
		
		$.ajax({
			url:"php/start_game.php",
			dataType:"json",
			success:function(data){
			}
		});
	
		$(".messageBox1 ").html(" ");
		$(".messageBox1").css({display: "none"});
		
	});

	$("#gameForm").on("submit",function(){
		var player=$("#player").val();
		var cahracter=$("select#selectClass option:selected").val();
		startNewGame(player,cahracter);
		
		return false;
	});

	function startNewGame(player,cahracter){
		$(".headerMessage").css({display: "none"});
		$.ajax({
			url:"php/start_game.php",
			dataType:"json",
			data:{
				player_name: player,
				player_class:cahracter
			},
			success:function(data){
			//console.log(data.tools)
			console.log(data.players)
				$(".messageBox1").css({display: "block"});
				$('.messageBox1').append("<p>These are facts about you: <p><br>");
				
				var humanPlayer=data.players[0];
				var bot1=data.players[1];
				var bot2=data.players[2];
				console.log(humanPlayer,bot1,bot2)
				$.each( humanPlayer, function( key, value ) {
					$(".messageBox1").append("<p>",key + " : " +value+"</p>");
				});
				
				getChalleng();
			}
			
			
		});
	}

function getChalleng(){

$.ajax({
			url:"php/get_challenge.php",
			dataType:"json",
			data:{
				ch:1
			},
			success:function(data){
				console.log("gdggfggf")
				 console.log(data);
				}
			});
			
		}









});


