<?php

namespace FastboardCode;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\Server;

class PlayerManager implements Listener {

    private $plugin;
    private $scoreboards = [];

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function updateScoreboards(): void {
        foreach (Server::getInstance()->getOnlinePlayers() as $player) {
            $this->showScoreboard($player);
        }
    }

    public function showScoreboard(Player $player): void {
        $scoreboardText = $this->getScoreboardText($player);
        $player->setScoreboard($scoreboardText);
        $this->scoreboards[$player->getName()] = $scoreboardText;
    }

    public function hideScoreboard(Player $player): void {
        $player->setScoreboard(null);
        unset($this->scoreboards[$player->getName()]);
    }

    private function getScoreboardText(Player $player): string {
        // Ambil teks scoreboard dari config
        $text = $this->plugin->getConfig()->get("scoreboard_text");

        // Ambil placeholder dinamis untuk pemain ini
        $placeholders = $this->plugin->getPlaceholderManager()->getPlaceholders($player);

        // Gantikan placeholder dengan nilai yang sesuai
        foreach ($placeholders as $placeholder => $value) {
            $text = str_replace($placeholder, $value, $text);
        }

        return $text;
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void {
        $this->showScoreboard($event->getPlayer());
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void {
        $this->hideScoreboard($event->getPlayer());
    }
}