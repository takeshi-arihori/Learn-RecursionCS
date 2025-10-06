<?php

declare(strict_types=1);
// ========================================
// 1. 依存関係 (Dependency)
// ========================================
class MonsterDep
{
    public function getName(): string
    {
        return 'Goblin';
    }
}

class PlayerDep
{
    // attackメソッドで一時的にMonsterを利用
    public function attack(MonsterDep $monster): void
    {
        echo '[Dependency] Attacking ' . $monster->getName() . PHP_EOL;
    }
}

$playerDep = new PlayerDep();
$monsterDep = new MonsterDep();
$playerDep->attack($monsterDep);

// ========================================
// 2. 関連 (Association)
// ========================================
class MonsterAssoc
{
    public function getName(): string
    {
        return 'Dragon';
    }
}

class PlayerAssoc
{
    private MonsterAssoc $monster;

    public function __construct(MonsterAssoc $monster)
    {
        $this->monster = $monster;
    }

    public function showTarget(): void
    {
        echo '[Association] Target: ' . $this->monster->getName() . PHP_EOL;
    }
}

$monsterAssoc = new MonsterAssoc();
$playerAssoc = new PlayerAssoc($monsterAssoc);
$playerAssoc->showTarget();

// ========================================
// 3. 集約 (Aggregation)
// ========================================
class PlayerAgg
{
    public function __construct(private string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}

class TeamAgg
{
    /** @var PlayerAgg[] */
    private array $members = [];

    public function addMember(PlayerAgg $player): void
    {
        $this->members[] = $player;
    }

    public function listMembers(): void
    {
        echo '[Aggregation] Team Members:' . PHP_EOL;

        foreach ($this->members as $member) {
            echo '- ' . $member->getName() . PHP_EOL;
        }
    }
}

// PlayerはTeamがなくても存在可能
$player1 = new PlayerAgg('Alice');
$player2 = new PlayerAgg('Bob');

$teamAgg = new TeamAgg();
$teamAgg->addMember($player1);
$teamAgg->addMember($player2);
$teamAgg->listMembers();

// ========================================
// 4. コンポジション (Composition)
// ========================================
class WalletComp
{
    public function __construct(private int $gold)
    {
    }

    public function getGold(): int
    {
        return $this->gold;
    }
}

class PlayerComp
{
    private WalletComp $wallet;

    public function __construct(private string $name, int $gold)
    {
        // Playerの生成と同時にWalletも生成
        $this->wallet = new WalletComp($gold);
    }

    public function getWalletGold(): int
    {
        return $this->wallet->getGold();
    }
}

$playerComp = new PlayerComp('Charlie', 100);
echo '[Composition] Wallet Gold: ' . $playerComp->getWalletGold() . PHP_EOL;
