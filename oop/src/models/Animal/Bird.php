<?php

declare(strict_types=1);

namespace App\Models\Animal;

use App\Common\Logger\Logger;
use App\Common\Logger\LogLevel;

/**
 * Birdクラス - 鳥類の基底クラス
 * Animalクラスを継承し、鳥類特有の属性と振る舞いを表現
 * 
 * @package App\Models\Animal
 */
class Bird extends Animal
{
    protected float $wingSpan;
    private Logger $logger;

    /**
     * コンストラクタ
     * 
     * @param string $species 種名
     * @param float $heightM 身長（メートル）
     * @param float $weightKg 体重（キログラム）
     * @param float $lifeSpanDays 寿命（日数）
     * @param string $biologicalSex 生物学的性別
     * @param float $wingSpan 翼幅（メートル）
     */
    public function __construct(
        string $species,
        float $heightM,
        float $weightKg,
        float $lifeSpanDays,
        string $biologicalSex,
        float $wingSpan
    ) {
        parent::__construct($species, $heightM, $weightKg, $lifeSpanDays, $biologicalSex);
        $this->wingSpan = $wingSpan;
        $this->logger = new Logger();
    }

    /**
     * 翼幅を取得
     * 
     * @return float 翼幅（メートル）
     */
    public function getWingSpan(): float
    {
        return $this->wingSpan;
    }

    /**
     * 産卵する
     * 
     * @return void
     */
    public function layEggs(): void
    {
        if (!$this->isAlive()) {
            $this->logger->warning("Dead {$this->species} cannot lay eggs");
            return;
        }

        $this->logger->info("{$this->species} laid an egg");
    }

    /**
     * 飛行する
     * 
     * @return void
     */
    public function fly(): void
    {
        if (!$this->isAlive()) {
            $this->logger->warning("Dead {$this->species} cannot fly");
            return;
        }

        $this->logger->info("{$this->species} is flying with wingspan {$this->wingSpan}m");
    }

    /**
     * 巣作りをする
     * 
     * @return void
     */
    public function buildNest(): void
    {
        if (!$this->isAlive()) {
            $this->logger->warning("Dead {$this->species} cannot build nest");
            return;
        }

        $this->logger->info("{$this->species} is building a nest");
    }

    /**
     * 移動する（Animalクラスのmoveメソッドをオーバーライド）
     * 
     * @return void
     */
    public function move(): void
    {
        if (!$this->isAlive()) {
            return;
        }

        echo "This bird is moving by flying..." . PHP_EOL;
        $this->logger->debug("{$this->species} moved by flying");
    }

    /**
     * 文字列表現を返す（Animalクラスの__toStringメソッドを拡張）
     * 
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString() . $this->getBirdInformation();
    }

    /**
     * 鳥類特有の情報を文字列で返す
     * 
     * @return string
     */
    protected function getBirdInformation(): string
    {
        return " This is a bird with wing span: {$this->wingSpan}m.";
    }
}