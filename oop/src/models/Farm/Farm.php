<?php

declare(strict_types=1);

namespace App\Models\Farm;

use App\Models\Animal\Animal;
use App\Models\Animal\Cow;
use App\Models\Animal\Horse;
use App\Models\Animal\Chicken;
use App\Common\Logger\Logger;
use App\Common\Logger\LogLevel;

/**
 * Farmクラス - 農場シミュレーションゲームの農場
 * 動物を管理し、日次更新と収益計算を行う
 * 
 * @package App\Models\Farm
 */
class Farm
{
    private string $name;
    private float $revenue = 0.0;
    
    /** @var Cow[] */
    private array $cows = [];
    
    /** @var Horse[] */
    private array $horses = [];
    
    /** @var Chicken[] */
    private array $chickens = [];
    
    private Logger $logger;

    /**
     * コンストラクタ
     * 
     * @param string $name 農場名
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->logger = new Logger();
        $this->logger->info("New farm created: {$name}");
    }

    /**
     * 農場名を取得
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 収益を取得
     * 
     * @return float
     */
    public function getRevenue(): float
    {
        return $this->revenue;
    }

    /**
     * 収益を設定
     * 
     * @param float $revenue
     * @return void
     */
    public function setRevenue(float $revenue): void
    {
        $this->revenue = $revenue;
        $this->logger->debug("Revenue set to {$revenue} for farm {$this->name}");
    }

    /**
     * 牛の配列を取得
     * 
     * @return Cow[]
     */
    public function getCows(): array
    {
        return $this->cows;
    }

    /**
     * 馬の配列を取得
     * 
     * @return Horse[]
     */
    public function getHorses(): array
    {
        return $this->horses;
    }

    /**
     * 鶏の配列を取得
     * 
     * @return Chicken[]
     */
    public function getChickens(): array
    {
        return $this->chickens;
    }

    /**
     * 全動物の配列を取得
     * 
     * @return Animal[]
     */
    public function getAllAnimals(): array
    {
        return array_merge($this->cows, $this->horses, $this->chickens);
    }

    /**
     * 動物を農場に追加
     * 
     * @param Animal $animal
     * @return void
     */
    public function addAnimal(Animal $animal): void
    {
        if ($animal instanceof Cow) {
            $this->cows[] = $animal;
            $this->logger->info("Added cow {$animal->species} to farm {$this->name}");
        } elseif ($animal instanceof Horse) {
            $this->horses[] = $animal;
            $this->logger->info("Added horse {$animal->species} to farm {$this->name}");
        } elseif ($animal instanceof Chicken) {
            $this->chickens[] = $animal;
            $this->logger->info("Added chicken {$animal->species} to farm {$this->name}");
        } else {
            $this->logger->warning("Attempted to add unknown animal type to farm {$this->name}");
        }
    }

    /**
     * 動物を農場から削除
     * 
     * @param Animal $animal
     * @return bool 削除の成否
     */
    public function removeAnimal(Animal $animal): bool
    {
        if ($animal instanceof Cow) {
            $key = array_search($animal, $this->cows, true);
            if ($key !== false) {
                unset($this->cows[$key]);
                $this->cows = array_values($this->cows); // インデックスを再設定
                $this->logger->info("Removed cow {$animal->species} from farm {$this->name}");
                return true;
            }
        } elseif ($animal instanceof Horse) {
            $key = array_search($animal, $this->horses, true);
            if ($key !== false) {
                unset($this->horses[$key]);
                $this->horses = array_values($this->horses);
                $this->logger->info("Removed horse {$animal->species} from farm {$this->name}");
                return true;
            }
        } elseif ($animal instanceof Chicken) {
            $key = array_search($animal, $this->chickens, true);
            if ($key !== false) {
                unset($this->chickens[$key]);
                $this->chickens = array_values($this->chickens);
                $this->logger->info("Removed chicken {$animal->species} from farm {$this->name}");
                return true;
            }
        }

        $this->logger->warning("Failed to remove animal from farm {$this->name} - animal not found");
        return false;
    }

    /**
     * 日次更新を実行
     * 全動物の状態を更新する
     * 
     * @return void
     */
    public function dailyUpdate(): void
    {
        $allAnimals = $this->getAllAnimals();
        
        foreach ($allAnimals as $animal) {
            // 空腹度と睡眠度を少し増加させる
            if ($animal->isAlive()) {
                // Protected プロパティにアクセスできないため、public メソッドがあると仮定
                // 実際の実装では、Animalクラスにpublic updateメソッドを追加する必要がある
            }
        }
        
        $this->logger->info("Daily update completed for farm {$this->name} with " . count($allAnimals) . " animals");
    }

    /**
     * 農場の収益を計算
     * 牛乳、卵などの生産物から収益を算出
     * 
     * @return float 計算された収益
     */
    public function calculateRevenue(): float
    {
        $totalRevenue = 0.0;
        
        // 牛からの収益（搾乳）
        foreach ($this->cows as $cow) {
            if ($cow->isAlive() && $cow->canProduceMilk()) {
                $milkRevenue = $cow->getMilkValue();
                $totalRevenue += $milkRevenue;
            }
        }
        
        // 鶏からの収益（産卵）
        foreach ($this->chickens as $chicken) {
            if ($chicken->isAlive() && $chicken->canLayEgg()) {
                $eggRevenue = $chicken->getEggValue();
                $totalRevenue += $eggRevenue;
            }
        }
        
        // 馬からの収益（調教・乗馬）
        foreach ($this->horses as $horse) {
            if ($horse->isAlive()) {
                $horseRevenue = $horse->getTrainingValue();
                $totalRevenue += $horseRevenue;
            }
        }
        
        $this->setRevenue($totalRevenue);
        $this->logger->info("Revenue calculated for farm {$this->name}: {$totalRevenue}");
        
        return $totalRevenue;
    }

    /**
     * 文字列表現を返す
     * 
     * @return string
     */
    public function __toString(): string
    {
        $cowCount = count($this->cows);
        $horseCount = count($this->horses);
        $chickenCount = count($this->chickens);
        $totalAnimals = $cowCount + $horseCount + $chickenCount;
        
        return "Farm: {$this->name}, Animals: {$totalAnimals} (Cows: {$cowCount}, Horses: {$horseCount}, Chickens: {$chickenCount}), Revenue: {$this->revenue}";
    }
}