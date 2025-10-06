<?php

declare(strict_types=1);

namespace App\Models\Animal;

use App\Common\Logger\Logger;
use App\Models\Farm\Farm;

/**
 * Personクラス - 農場シミュレーションゲームのプレイヤー
 * Mammalクラスを継承し、農場経営に関する機能を提供
 *
 * @package App\Models\Animal
 */
class Person extends Mammal
{
    private string $name;
    private float $money;
    private ?Farm $farm = null;
    private Logger $logger;

    /**
     * コンストラクタ
     *
     * @param string $species 種名
     * @param float $heightM 身長（メートル）
     * @param float $weightKg 体重（キログラム）
     * @param float $lifeSpanDays 寿命（日数）
     * @param string $biologicalSex 生物学的性別
     * @param float $age 年齢（年数）
     * @param float $furLengthCm 毛の長さ（センチメートル）
     * @param string $furType 毛のタイプ
     * @param float $avgBodyTemperatureC 平均体温（摂氏）
     * @param string $name 名前
     * @param float $money 所持金
     */
    public function __construct(
        string $species,
        float $heightM,
        float $weightKg,
        float $lifeSpanDays,
        string $biologicalSex,
        float $age,
        float $furLengthCm,
        string $furType,
        float $avgBodyTemperatureC,
        string $name,
        float $money,
    ) {
        parent::__construct($species, $heightM, $weightKg, $lifeSpanDays, $biologicalSex, $age, $furLengthCm, $furType, $avgBodyTemperatureC);
        $this->name = $name;
        $this->money = $money;
        $this->logger = new Logger();
    }

    /**
     * 名前を取得
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * 所持金を取得
     *
     * @return float
     */
    public function getMoney(): float
    {
        return $this->money;
    }

    /**
     * 農場を取得
     *
     * @return Farm|null
     */
    public function getFarm(): ?Farm
    {
        return $this->farm;
    }

    /**
     * 農場を設定
     *
     * @param Farm $farm
     * @return void
     */
    public function setFarm(Farm $farm): void
    {
        $this->farm = $farm;
        $this->logger->info("{$this->name} now owns farm: {$farm->getName()}");
    }

    /**
     * 動物を購入する
     *
     * @param Animal $animal 購入する動物
     * @param float $price 価格
     * @return bool 購入の成否
     */
    public function buyAnimal(Animal $animal, float $price): bool
    {
        if (!$this->farm) {
            $this->logger->warning("{$this->name} tried to buy animal without owning a farm");

            return false;
        }

        if ($this->money < $price) {
            $this->logger->warning("{$this->name} has insufficient money to buy animal (has: {$this->money}, needs: {$price})");

            return false;
        }

        $this->money -= $price;
        $this->farm->addAnimal($animal);
        $this->logger->info("{$this->name} bought {$animal->species} for {$price}. Remaining money: {$this->money}");

        return true;
    }

    /**
     * 動物を売却する
     *
     * @param Animal $animal 売却する動物
     * @param float $price 価格
     * @return bool 売却の成否
     */
    public function sellAnimal(Animal $animal, float $price): bool
    {
        if (!$this->farm) {
            $this->logger->warning("{$this->name} tried to sell animal without owning a farm");

            return false;
        }

        if (!$this->farm->removeAnimal($animal)) {
            $this->logger->warning("{$this->name} tried to sell animal not owned by their farm");

            return false;
        }

        $this->money += $price;
        $this->logger->info("{$this->name} sold {$animal->species} for {$price}. New money: {$this->money}");

        return true;
    }

    /**
     * 動物に餌を与える
     *
     * @param Animal $animal
     * @return void
     */
    public function feedAnimal(Animal $animal): void
    {
        if (!$this->farm) {
            $this->logger->warning("{$this->name} tried to feed animal without owning a farm");

            return;
        }

        $animal->eat();
        $this->logger->info("{$this->name} fed {$animal->species}");
    }

    /**
     * 農場の収益を回収する
     *
     * @return void
     */
    public function collectRevenue(): void
    {
        if (!$this->farm) {
            $this->logger->warning("{$this->name} tried to collect revenue without owning a farm");

            return;
        }

        $revenue = $this->farm->getRevenue();
        $this->money += $revenue;
        $this->farm->setRevenue(0.0);

        if ($revenue > 0) {
            $this->logger->info("{$this->name} collected revenue: {$revenue}. New money: {$this->money}");
        }
    }

    /**
     * お金を使う
     *
     * @param float $amount 使用金額
     * @return void
     */
    public function spendMoney(float $amount): void
    {
        if ($amount <= 0) {
            return;
        }

        $this->money = max(0, $this->money - $amount);
        $this->logger->debug("{$this->name} spent {$amount}. Remaining: {$this->money}");
    }

    /**
     * お金を稼ぐ
     *
     * @param float $amount 稼いだ金額
     * @return void
     */
    public function earnMoney(float $amount): void
    {
        if ($amount <= 0) {
            return;
        }

        $this->money += $amount;
        $this->logger->debug("{$this->name} earned {$amount}. New total: {$this->money}");
    }

    /**
     * 文字列表現を返す（Mammalクラスの__toStringメソッドを拡張）
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString() . $this->getPersonInformation();
    }

    /**
     * 人物特有の情報を文字列で返す
     *
     * @return string
     */
    protected function getPersonInformation(): string
    {
        $farmName = $this->farm ? $this->farm->getName() : 'No farm';

        return " Person: {$this->name}, Money: {$this->money}, Farm: {$farmName}.";
    }
}
