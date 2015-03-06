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
		 $('.play').attr("disabled", false);
		$(".messageBox1 ").html(" ");
		$(".messageBox1").css({display: "none"});
		$(".tools").html(" ");
		$(".box2 ").html(" ");
		$(".box4").html(" ");
		
	});

	$("#gameForm").on("submit",function(){
		 $('.play').attr("disabled", true);
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
			console.log(data);
				$(".messageBox1").css({display: "block"});
				$('.messageBox1').append("<h1>player Information: </h1>");
				
				var humanPlayer=data.players[0];
				var bot1=data.players[1];
				var bot2=data.players[2];
				//console.log(humanPlayer,bot1,bot2)
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
				$(".box2 ").html(" ");
				 $(".box2").append("<p class='two'>You either accept or change the challenge below! A random change will cost you -5 success points.</p><br>"+
                                  "<p>You are offered  this challenge: <br>"+
                                    "*" +data["description"]+ "*"+"</p><br><br>"+
                                  "<button class = 'accept'>Accept</button><button class='randomCh'>Random change</button>");
								  
				}
			});
			
	}
	
	
	$("body").on('click', ".accept", function() {
			$(".messageBox1").html("");
			$(".box2 p.two").html("");
			$(".box2 .accept").remove();
			$(".box2 .randomCh").remove();
			$(".box2").append("<button class='doChallengeAlone'>Do challenge alone</button>");
			$(".box2").append("<button class='doChallengeTeam'>Do challenge together with team</button>");
	});

	$("body").on('click', ".randomCh", function() {
		$.ajax({
			url: "php/get_challenge.php",
			dataType: "json",
			data: {
			  ch_new:1
			},
			success: function(data) {
			$(".messageBox1").html(" ");
			  $(".box2").html("<p>This change cost you 5 success-points. <br> Your new challange is: </p>" +
									"*" +data["description"]+ "*"+"<br><br>"
									);
			   $(".box2").append("<button class='doChallengeAlone'>Do challenge alone</button>");
			   $(".box2").append("<button class='doChallengeTeam'>Do challenge with team</button>");						
			  
			},
			error: function(data) {
			  console.log("Data: ", data, data.responseText);
			}
        });	
	});

	
	$("body").on('click', ".doChallengeAlone", function() {
     $(".doChallengeTeam").hide();
		$.ajax({
			url: "php/do_chalenge.php",
			dataType: "json",
			data: {
			  alone: 1
			},
			success: getResultAlone
		});
    });
	
	
	$("body").on('click', ".doChallengeTeam", function() {
	$(".doChallengeAlone").hide();
		$.ajax({
			url: "php/do_chalenge.php",
			dataType: "json",
			data: {
			  team: 1
			},
			success: getResultTeam
        });
  
	});
	
	function getResultAlone(data){
		//console.log(data)
		
		$(".tools").html(" ");
		var tools=data.result[0]['tools'];
		for(var k=0 ; k <tools.length ;k++){
			$(".tools").prepend(
			"<p><b>"+data.playing[0]['name'] +"</b> gets this  ** "+
			data.result[0]['tools'][k]['description']+
			" ** tool.It helps her/him to have more cooking skills!</p><br>"
			);
		}
		for(var y=0 ; y <3 ;y++){
			$(".tools").append( "<p>player"+ (y+1) +"  is "+ data.result[y]['name'] +" with "+data.result[y]['success']+"points</p>");
			}
			
		$(".box4").html("")
		for(var p=0 ; p <3 ;p++){
			if(data.result[p]['success']>=100){
				$(".box4").append("<p>The winner is: "+data.result[p]['name'] )	
			}
			if(data.result[p]['success']<=0){
				$(".box4").append("<p>The looser is: "+data.result[p]['name'] )
			}
		}		
	}
	
	
	function getResultTeam(data){
	console.log(data)
		$(".tools").html(" ");
		var tools=data.result[0]['tools'];
		for(var k=0 ; k <tools.length ;k++){
			$(".tools").prepend(
			"<p>Team  get this  **"+
			data.result[0]['tools'][k]['description']+"** tool!"
			);
		}
		$(".box4").html("");
		$(".box4").append("<p>Team members : "+data.result[0]['members'][0]['name'] + " and "+data.result[0]['members'][1]['name']+"</p>");
		
		for(var h=0 ; h<2 ;h++){
		console.log(data.result[h]['success'])
			if(data.result[h]['success']>=100){
			
				$(".box4").append("<p>The winner is: "+data.result[h]['name'] )	
			}
			if(data.result[h]['success']<=0){
				$(".box4").append("<p>The looser is: "+data.result[h]['name'] )
			}
		}	
	}
	


	
	
	
	
});
