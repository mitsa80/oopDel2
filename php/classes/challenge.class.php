<?php 

class Challenge {	
	public $description;
	public $skills;
	
	public function __construct($description,$skills){	
		$this->description=$description;
		$this->skills=$skills;
	}

	public function playChallenge(&$players) {

			
		$matches = array();
		//get chances to win for each player
		foreach ($players as $player) {
		  $matches[] = array(
			"success_rate" => $this->howGoodAMatch($player),
			"player" => $player,
		  );
		}

		//then find out who won
		$winners = array();
		$last_match = 0;
		foreach ($matches as $match) {
		  //if higher score than current 1st place
		  if ($match["success_rate"] > $last_match) {
			//add first in winners array
			array_unshift($winners, $match["player"]);
			$last_match = $match["success_rate"];
		  } else {
			//add last in winners array
			$winners[] = $match["player"];
		  }
		}
		
		return $winners;
		
	}
		
		
	public function howGoodAMatch($person){
		//total points a person has
		$sum= 0;
		//total points possible for this challenge
		$max = 0;

		//calculate how good of a match a person is to this challenge
		foreach($this->skills as $skill => $points){
		  //by checking how many skillpoints the challenge requires
		  $needed = $points;
		  //and by checking how many skillpoints a person has
		  $has = $person->{$skill}; 

		  //check if a person has any tools
		  if (count($person->tools) > 0) {
			//if they do, go through them
			for ($i = 0; $i < count($person->tools); $i++) {
			  //and for each skill the tool has
			  foreach ($person->tools[$i]->skills as $toolSkill => $value) {
				//if a toolSkill matches the skill we are currently calculating
				if ($toolSkill == $skill) {
				  //add the toolSkill points 
				  $has += $value;
				}
			  }
			} 
		  }

		  //if a person has more points than needed, only count the points needed (to preserve our percentage)
		  //else count the skillpoints a person has
		  $sum += $has > $needed ? $needed : $has;
		  $max += $needed;
		}

		//return the percentage of skill points they have
		return $sum/$max;
	}	
		
	
	
}


