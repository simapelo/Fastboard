<?php

namespace FastboardCode;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;

class Main extends PluginBase {

    private $playerManager;
    private $placeholderManager;
    private $config;

    public function onEnable(): void {
        @mkdir($this->getDataFolder() . "FastboardData");
        
        $this->saveResource("config.yml", false, $this->getDataFolder() . "FastboardData");

        $this->config = new Config($this->getDataFolder() . "FastboardData/config.yml", Config::YAML);
        
        $this->playerManager = new PlayerManager($this);
        $this->placeholderManager = new PlaceholderManager();
        $this->getServer()->getPluginManager()->registerEvents($this->playerManager, $this);
        $this->getLogger()->info(TextFormat::GREEN . "Fastboard enabled!");
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "This command can only be used in-game.");
            return false;
        }

        if ($command->getName() === "fastboard") {
            if (!isset($args[0])) {
                $sender->sendMessage(TextFormat::RED . "Usage: /fastboard <reload|hide|show>");
                return false;
            }

            switch ($args[0]) {
                case "reload":
                    if ($sender->hasPermission("fastboard.reload")) {
                        $this->config->reload();
                        $this->playerManager->updateScoreboards();
                        $sender->sendMessage(TextFormat::GREEN . "Configuration reloaded.");
                    } else {
                        $sender->sendMessage(TextFormat::RED . "You don't have permission to reload.");
                    }
                    break;
                case "hide":
                    $this->playerManager->hideScoreboard($sender);
                    $sender->sendMessage(TextFormat::GREEN . "Scoreboard hidden.");
                    break;
                case "show":
                    $this->playerManager->showScoreboard($sender);
                    $sender->sendMessage(TextFormat::GREEN . "Scoreboard shown.");
                    break;
                default:
                    $sender->sendMessage(TextFormat::RED . "Usage: /fastboard <reload|hide|show>");
                    break;
            }
        }

        return true;
    }

    public function getConfigFile(): Config {
        return $this->config;
    }

    public function getPlayerManager(): PlayerManager {
        return $this->playerManager;
    }

    public function getPlaceholderManager(): PlaceholderManager {
        return $this->placeholderManager;
    }
}