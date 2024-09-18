<?php

namespace FastboardCode;

use pocketmine\Player;
use pocketmine\Server;

class PlaceholderManager {

    private $placeholders = [];

    public function __construct() {
        $this->placeholders = [
            "{server_name}" => Server::getInstance()->getMotd(), 
            "{max_players}" => (string) Server::getInstance()->getMaxPlayers(), 
        ];
    }

    public function getPlaceholders(Player $player): array {
        $this->placeholders["{player_name}"] = $player->getName(); // Nama pemain
        $this->placeholders["{ping}"] = (string) $player->getPing(); // Ping pemain
        $this->placeholders["{player_world}"] = $player->getLevel()->getFolderName(); // Dunia pemain
        $this->placeholders["{online_players}"] = (string) count(Server::getInstance()->getOnlinePlayers()); // Jumlah pemain online
        $this->placeholders["{player_health}"] = (string) $player->getHealth(); // Kesehatan pemain
        $this->placeholders["{time}"] = date("H:i:s"); // Waktu server

        return $this->placeholders;
    }
}