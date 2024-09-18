# Fastboard Plugin

Fastboard is a highly customizable scoreboard plugin for PocketMine-MP, designed to provide real-time updates and dynamic placeholders to enhance the player experience.

## Features
- Real-time scoreboard updates with dynamic placeholders.
- Customizable scoreboard text through `config.yml`.
- Easy-to-use commands to manage scoreboard visibility and reload configurations.
- Multiple placeholders, such as player name, ping, online players, player health, and server time.
- Supports custom commands like `/fastboard reload`, `/fastboard hide`, and `/fastboard show`.

## Requirements
- PocketMine-MP (latest version)
- PHP 7.4 or higher

## Installation
1. Download the Fastboard plugin `Fastboard.jar` file.
2. Place the `Fastboard.jar` file into your PocketMine `plugins` directory.
3. Start or restart your PocketMine server.
4. A folder named `FastboardData` will be created automatically, containing the default `config.yml`.

## Commands

| Command | Description | Permission |
|---------|-------------|------------|
| `/fastboard reload` | Reloads the plugin's configuration. | `fastboard.reload` |
| `/fastboard hide` | Hides the scoreboard for the current player. | N/A |
| `/fastboard show` | Shows the scoreboard for the current player. | N/A |

### Permissions
- `fastboard.reload` — Allows a player to reload the configuration.

## Configuration

The `config.yml` file allows you to fully customize the scoreboard text and behavior. It is located in the `FastboardData` folder.

### Example `config.yml`

```yaml
scoreboard_text: |
  Welcome {player_name}!
  Ping: {ping}
  World: {player_world}
  Players Online: {online_players}/{max_players}
  Health: {player_health}
  Time: {time}
  Server: {server_name}