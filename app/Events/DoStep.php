<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DoStep implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $game;
    public $player;
    public $lastMove;
    public function __construct($game, $player, $lastMove)
    {
        $this->game = $game;
        $this->player = $player;
        $this->lastMove = $lastMove;
    }

    public function broadcastOn()
    {
        return ['game.' . $this->game->id . '.' . $this->player];
    }

    public function broadcastWith()
    {
        // Additional data you want to send with the event
        return [
            'state' => $this->game->state,
            'game' =>  $this->game->id,
            'player' =>  $this->player,
            'lastMove' =>  $this->lastMove,
            ];
    }
}
