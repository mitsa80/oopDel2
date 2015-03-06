<?php

class Character {
	public $name;
	public $tools=array();
	public $success=50;
	
	public function __construct ($name){
		$this->name=$name;	
	}
	
	
	
 public function winTool(&$tools) {
   
    if (count($this->tools) < 3) {
      $random_tool_index = rand(0, count($tools)-1);
      $random_tool = $tools[$random_tool_index];
      $this->tools[] = $random_tool;
      //and remove it from $ds->available_tools
      array_splice($tools, $random_tool_index, 1);
    }
  }

  public function loseTool(&$tools) {
    
    //if the Character has any tools.
    if (count($this->tools) > 0) {
      $tools[] = array_shift($this->tools);
    }
  }
 
/*
  public function doChallenge($challenge, &$players) {
    //find the winners and return them
    return $challenge->playChallenge($players);
  }

//doChallengeWithFriend
  public function doChallengeWithFriend($challenge, &$players) {

    return $this->doChallenge($challenge, $players);
  }
*/	
 public function acceptChallenge($challenge, &$players) {
	return $this->carryOutChallenge($challenge, $players);
 }
 
 public function changeChallenge($challenge, &$players) {
	// nothing to do here...
 }
 
 public function carryOutChallenge($challenge, &$players) {
	return $challenge->playChallenge($players);
 }
 
 public function carryOutChallengeWithCompanion($challenge, &$players) {
	return $this->carryOutChallenge($challenge, $players);
 }

	
}