<?php

class Team extends Character {
  //a members array in case we need to track who is in the team
  public $members = array();

  //give team the same skills/strengths as player classes so we don't
  //have to change any existing code (winChances, playChallenge etc)
  public $maindish;
  public $sauce;
  public $starter;
  public $desert;
  public $tools = array();

  //not using references as no player property values will be affected
  public function __construct($name, $humanPlayer, $computerPlayer) {
    $this->members[] = $humanPlayer;
    $this->members[] = $computerPlayer;

    // sum skill points of team members
    $this->maindish = $humanPlayer->maindish + $computerPlayer->maindish;
    $this->sauce = $humanPlayer->sauce + $computerPlayer->sauce;
    $this->starter = $humanPlayer->starter + $computerPlayer->starter;
    $this->desert = $humanPlayer->desert + $computerPlayer->desert;

    //how to add tools to a team, assuming any player can have tools
    for ($i=0; $i < count($this->members); $i++) { 
      for ($j=0; $j < count($this->members[$i]->tools); $j++) { 
        $this->tools[] = $this->members[$i]->tools[$j];
      }
    }

    //call the parent class (Character) __construct to set name of team
    parent::__construct($name);
  }
}