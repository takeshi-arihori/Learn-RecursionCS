<?php

declare(strict_types=1);

namespace App\Models\Animal;

// 哺乳類クラス：Animalクラスを継承し、哺乳類特有の属性と振る舞いを表現
class Mammal extends Animal
{
    // 毛の長さ（cm）
    protected float $furLengthCm;
    // 毛の種類
    protected string $furType;
    // 歯の交換回数
    protected int $toothCounter;
    // 体温（摂氏）
    protected float $bodyTemperatureC;
    // 平均体温（摂氏）
    protected float $avgBodyTemperatureC;
    // 乳腺の有無
    protected bool $mammaryGland = false;
    // 汗腺の有無
    protected bool $sweatGland = true;
    // 妊娠しているかどうか
    protected bool $isPregnant = false;

    // コンストラクタ
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
    ) {
        // 親クラスのコンストラクタを呼び出す
        parent::__construct($species, $heightM, $weightKg, $lifeSpanDays, $biologicalSex, $age);
        $this->furLengthCm = $furLengthCm;
        $this->furType = $furType;
        $this->toothCounter = 0;
        $this->mammaryGland = ($biologicalSex === 'female');
        $this->avgBodyTemperatureC = $avgBodyTemperatureC;
        $this->bodyTemperatureC = $this->avgBodyTemperatureC;
    }

    // 汗をかく
    public function sweat(): void
    {
        if (!$this->isAlive()) {
            return;
        }

        if ($this->sweatGland) {
            echo 'Sweating....';
        }
        $this->bodyTemperatureC -= 0.3;
        echo "Body temperature is now {$this->bodyTemperatureC}C\n";
    }

    // 母乳を出す
    public function produceMilk(): void
    {
        if (!$this->isAlive()) {
            return;
        }

        if ($this->isPregnant() && $this->mammaryGland) {
            echo "Producing milk...\n";
        } else {
            echo "Cannot produce milk\n";
        }
    }

    // 交尾する
    public function mate(Mammal $mammal): void
    {
        if (!$this->isAlive()) {
            return;
        }

        if ($this->species !== $mammal->species) {
            return;
        }

        if ($this->biologicalSex === 'female' && $mammal->biologicalSex === 'male') {
            $this->fertilize();
        } elseif ($this->biologicalSex === 'male' && $mammal->biologicalSex === 'female') {
            $mammal->fertilize();
        }
    }

    // 受精する
    public function fertilize(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        $this->isPregnant = true;
    }

    // 妊娠しているかどうかを返す
    public function isPregnant(): bool
    {
        if (!$this->isAlive()) {
            return false;
        }

        return $this->isPregnant;
    }

    // 噛む
    public function bite(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        echo $this->species . ' bites with their single lower jaws which has' . ($this->toothCounter == 0 ? ' not' : '') . ' replaced its teeth: ' . ($this->toothCounter > 0 ? 'true' : 'false') . "\n";
    }

    // 歯を交換する
    public function replaceTeeth(): void
    {
        if (!$this->isAlive()) {
            return;
        }

        if ($this->toothCounter == 0) {
            $this->toothCounter++;
        }
    }

    // 体温を上げる
    public function increaseBodyHeat(float $celsius): void
    {
        $this->bodyTemperatureC += $celsius;
    }

    // 体温を下げる
    public function decreaseBodyHeat(float $celsius): void
    {
        $this->bodyTemperatureC -= $celsius;
    }

    // 体温を平均体温に調整する
    public function adjustBodyHeat(): void
    {
        $this->bodyTemperatureC = $this->avgBodyTemperatureC;
    }

    // 毛のタイプを取得
    public function getFurType(): string
    {
        return $this->furType;
    }

    // 毛の長さを取得
    public function getFurLengthCm(): float
    {
        return $this->furLengthCm;
    }

    // 体温を取得
    public function getBodyTemperatureC(): float
    {
        return $this->bodyTemperatureC;
    }

    // 平均体温を取得
    public function getAvgBodyTemperatureC(): float
    {
        return $this->avgBodyTemperatureC;
    }

    // Animalクラスのmoveメソッドをオーバーライド
    public function move(): void
    {
        if (!$this->isAlive()) {
            return;
        }
        echo "This mammal is moving.....\n";
    }

    // Animalクラスの__toStringメソッドをオーバーライド
    public function __toString(): string
    {
        return parent::__toString() . $this->mammalInformation();
    }

    // 哺乳類の情報を文字列で返す
    public function mammalInformation(): string
    {
        return "This is a mammal with the following - fur:{$this->furType}/teethReplaced:" . ($this->toothCounter > 0 ? 'true' : 'false') . '/Pregnant:' . ($this->isPregnant() ? 'true' : 'false') . "/Body Temperature:{$this->bodyTemperatureC}";
    }

    // Animalクラスのeatメソッドをオーバーライド
    public function eat(): void
    {
        parent::eat();
        $this->bite();
        echo "this {$this->species} is eating with its single lower jaw\n";
    }
}
