<?php

declare(strict_types=1);

namespace App\Models\Animal;

// Animalクラス: 動物の基本的な属性と振る舞いを表現
class Animal
{
    // 動物の種別
    protected string $species;
    // BMIオブジェクト（身長・体重から計算）
    protected BMI $bmi;
    // 寿命（日数）
    protected float $lifeSpanDays;
    // 生物学的性別
    protected string $biologicalSex;
    // 生まれた日時
    protected \DateTime $spawnTime;
    // 死亡日時（生存中はnull）
    protected ?\DateTime $deathTime = null;
    // 空腹度（0:満腹, 100:空腹）
    protected int $hungerPercent = 100;
    // 眠気度（0:十分睡眠, 100:眠い）
    protected int $sleepPercent = 100;

    // 年齢（年数）
    protected float $age;

    // コンストラクタ
    public function __construct(string $species, float $heightM, float $weightKg, float $lifeSpanDays, string $biologicalSex, float $age)
    {
        $this->species = $species;
        $this->bmi = new BMI($heightM, $weightKg);
        $this->lifeSpanDays = $lifeSpanDays;
        $this->biologicalSex = $biologicalSex;
        $this->age = $age;
        $this->spawnTime = new \DateTime();
    }

    // 食事をする（空腹度リセット）
    public function eat(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->hungerPercent = 0;
    }

    // 強制的に空腹状態にする
    public function setAsHungry(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->hungerPercent = 100;
    }

    // 空腹かどうか判定
    public function isHungry(): bool
    {
        return $this->hungerPercent >= 70;
    }

    // 睡眠をとる（眠気リセット）
    public function sleep(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->sleepPercent = 0;
    }

    // 強制的に眠い状態にする
    public function setAsSleepy(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->sleepPercent = 100;
    }

    // 眠いかどうか判定
    public function isSleepy(): bool
    {
        return $this->sleepPercent >= 70;
    }

    // 死亡処理
    public function die(): void
    {
        $this->sleepPercent = 0;
        $this->hungerPercent = 0;
        $this->deathTime = new \DateTime();
    }

    // 生存しているかどうか判定
    public function isAlive(): bool
    {
        return $this->deathTime === null;
    }

    // 種名を取得
    public function getSpecies(): string
    {
        return $this->species;
    }

    // 年齢を取得
    public function getAge(): float
    {
        return $this->age;
    }

    // 身長を取得
    public function getHeight(): float
    {
        return $this->bmi->getHeightM();
    }

    // 体重を取得
    public function getWeight(): float
    {
        return $this->bmi->getWeightKg();
    }

    // 寿命を取得
    public function getLifeSpan(): float
    {
        return $this->lifeSpanDays;
    }

    // 生物学的性別を取得
    public function getBiologicalSex(): string
    {
        return $this->biologicalSex;
    }

    // 移動する
    public function move(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        echo 'This animal just moved...' . PHP_EOL;
    }

    // 文字列化
    public function __toString(): string
    {
        return $this->species . $this->bmi->toString() . ' lives ' . $this->lifeSpanDays . ' days/' . 'gender:' . $this->biologicalSex . '.' . $this->status();
    }

    // ステータス情報を返す
    public function status(): string
    {
        return $this->species . ' status:' . ' Hunger - ' . $this->hungerPercent . '%, ' . 'sleepiness:' . $this->sleepPercent . '%, Alive - ' . ($this->isAlive() ? 'true' : 'false') . '. First created at ' . $this->dateCreated();
    }

    // 作成日時を返す
    public function dateCreated(): string
    {
        return $this->spawnTime->format('m/d/Y H:i:s');
    }
}
