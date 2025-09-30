# 農場シミュレーションゲーム 要件定義書

## 1. 概要

本ドキュメントは、動物の継承関係をベースとした農場経営シミュレーションゲームのシステム要件を定義するものである。プレイヤーは農場を所有する人物（Person）となり、動物を飼育し、そこから得られる生産物や動物自体の売却によって収益を上げることを目指す。

## 2. システムの目的

オブジェクト指向における「継承」の概念を実用的な形でモデル化し、拡張性の高いシミュレーションの基盤を構築する。プレイヤーは、動物の種類ごとの特性を活かして農場を経営する楽しさを体験できる。

## 3. クラス設計

システムに登場する主要なクラスの設計は以下の通り。クラス図で定義された詳細な属性とメソッドを反映している。

### 3.1. 基底クラス

| クラス名 | 概要 | 主要な属性 | 主要なメソッド |
| :--- | :--- | :--- | :--- |
| `Animal` | 全ての動物の基底クラス。 | `species`, `lifeSpanDays`, `hungerPercent`, `sleepPercent`, `isAlive` | `eat()`, `sleep()`, `move()`, `die()` |
| `Mammal` | 哺乳類クラス。`Animal`を継承。 | `isPregnant`, `bodyTemperatureC` | `produceMilk()`, `mate()`, `giveBirth()` |
| `Bird` | 鳥類クラス。`Animal`を継承。 | `wingSpan` | `layEggs()`, `fly()`, `buildNest()` |

### 3.2. 主要クラス

| クラス名 | 概要 | 主要な属性 | 主要なメソッド |
| :--- | :--- | :--- | :--- |
| `Person` | プレイヤーの分身。`Mammal`を継承。 | `name`, `money`, `farm` | `buyAnimal()`, `sellAnimal()`, `feed()`, `collectRevenue()` |
| `Farm` | 動物を管理する農場。 | `name`, `funds`, `cows[]`, `horses[]`, `chickens[]` | `addAnimal()`, `removeAnimal()`, `dailyUpdate()`, `calculateRevenue()` |

### 3.3. 動物クラス

| クラス名 | 概要 | 主要な属性 | 主要なメソッド |
| :--- | :--- | :--- | :--- |
| `Cow` | 牛。`Mammal`を継承。 | `weight`, `milkFatPercentage`, `isMilkable` | `milk()`, `graze()`, `getPrice()` |
| `Horse` | 馬。`Mammal`を継承。 | `runningSpeed`, `breed`, `stamina` | `train()`, `ride()`, `getPrice()` |
| `Chicken` | 鶏。`Bird`を継承。 | `weight`, `eggColor`, `canLayEgg` | `layEgg(): Egg`, `peck()`, `getPrice()` |
| `Parrot` | オウム。`Bird`を継承。ペット。 | `featherColor`, `vocabulary[]` | `talk()`, `learnWord()` |

## 4. 機能要件

### 4.1. ゲームの進行

ゲームは1日単位で進行し、`Farm`クラスの`dailyUpdate()`メソッドが呼び出されることで、以下の処理が実行される。

*   全ての動物の空腹度(`hungerPercent`)、睡眠欲(`sleepPercent`)の更新。
*   動物の成長（年齢、体重などの変化）。
*   妊娠期間の更新。
*   搾乳や産卵の可否状態の更新。

### 4.2. プレイヤーのアクション

プレイヤー(`Person`)は以下の主要なアクションを実行できる。

*   **動物の売買:** `buyAnimal()` / `sellAnimal()` を通じて、所持金(`money`)を増減させ、農場の動物を管理する。
*   **餌やり:** `feed()` を通じて、動物の空腹度を回復させる。
*   **収益の回収:** `collectRevenue()` を通じて、生産物（牛乳、卵など）を資金に換える。
*   **トレーニング:** `Horse`に対して`train()`を実行し、その価値を高める。

### 4.3. 収益計算ロジック

農場の収益 (`revenue`) は、以下の要素から計算される。

*   **牛乳の販売:** `Cow`の`milk()`メソッドによって得られる。収益は量だけでなく、`milkFatPercentage`（乳脂肪率）によって変動する。
*   **卵の販売:** `Chicken`の`layEgg()`メソッドによって得られる。収益は`eggColor`などの希少性によって変動する可能性がある。
*   **動物の売却:**
    *   `Cow` / `Chicken`: 売却価格は`weight`（重さ）に比例する。
    *   `Horse`: 売却価格は`runningSpeed`（走行速度）と`stamina`（スタミナ）に比例する。`train()`によって価値を高めることができる。

## 5. 関係性

*   **継承:**
    *   `Mammal`, `Bird` ← `Animal`
    *   `Person`, `Cow`, `Horse` ← `Mammal`
    *   `Chicken`, `Parrot` ← `Bird`
*   **コンポジション:**
    *   `Person` "1" -- "1" `Farm` (PersonはFarmを所有する)
    *   `Farm` "1" -- "0..*"` `Cow`, `Horse`, `Chicken` (Farmは動物たちを飼育する)

## 6. 非機能要件

*   **拡張性:** 新しい種類の動物（例: `Sheep`, `Pig` など）や生産物（例: `Wool`）を容易に追加できる構造であること。
*   **保守性:** 各クラスの役割が明確であり、仕様変更やデバッグが容易であること。