<?php

namespace App\Models\Animal;

// Animalクラス: 動物の基本的な属性と振る舞いを表現
class Animal
{
    // 動物の種別
    private string $species;
    // BMIオブジェクト（身長・体重から計算）
    private BMI $bmi;
    // 寿命（日数）
    private float $lifeSpanDays;
    // 生物学的性別
    private string $biologicalSex;
    // 生まれた日時
    private \DateTime $spawnTime;
    // 死亡日時（生存中はnull）
    private ?\DateTime $deathTime = null;
    // 空腹度（0:満腹, 100:空腹）
    private int $hungerPercent = 100;
    // 眠気度（0:十分睡眠, 100:眠い）
    private int $sleepPercent = 100;

    // コンストラクタ
    public function __construct(string $species, float $heightM, float $weightKg, float $lifeSpanDays, string $biologicalSex)
    {
        $this->species = $species;
        $this->bmi = new BMI($heightM, $weightKg);
        $this->lifeSpanDays = $lifeSpanDays;
        $this->biologicalSex = $biologicalSex;
        $this->spawnTime = new \DateTime();
    }

    // 食事をする（空腹度リセット）
    public function eat(): void
    {
        if (!$this->isAlive()) return;
        $this->hungerPercent = 0;
    }

    // 強制的に空腹状態にする
    public function setAsHungry(): void
    {
        if (!$this->isAlive()) return;
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
        if (!$this->isAlive()) return;
        $this->sleepPercent = 0;
    }

    // 強制的に眠い状態にする
    public function setAsSleepy(): void
    {
        if (!$this->isAlive()) return;
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

    // 移動する
    public function move(): void
    {
        if (!$this->isAlive()) return;
        echo "This animal just moved..." . PHP_EOL;
    }

    // 文字列化
    public function __toString(): string
    {
        return $this->species . $this->bmi->toString() . " lives " . $this->lifeSpanDays . " days/" . "gender:" . $this->biologicalSex . "." . $this->status();
    }

    // ステータス情報を返す
    public function status(): string
    {
        return $this->species . " status:" . " Hunger - " . $this->hungerPercent . "%, " . "sleepiness:" . $this->sleepPercent . "%, Alive - " . ($this->isAlive() ? 'true' : 'false') . ". First created at " . $this->dateCreated();
    }

    // 作成日時を返す
    public function dateCreated(): string
    {
        return $this->spawnTime->format('m/d/Y H:i:s');
    }
}
