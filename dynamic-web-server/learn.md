## アプリケーションサーバー

### NGINX の役割

1. web サーバーとしての役割
2. リバースプロキシとしての役割
   クライアントからのリクエストを適切なバックエンドサーバ(この場合はアプリケーションサーバ)に転送し、そのバックエンドサーバからのレスポンスをクライアントに送信する。

PHP-FPM は、PHP の実行環境の一つであり、PHP スクリプトを効率的に実行するためのプロセス管理を行う。そのためリクエストごとに PHP インタープリタを起動することなく、事前に起動した PHP プロセスを再利用できる。
`結果:` 応答時間の短縮とシステムリソースの効率的な利用が可能となる。

## ローカル動的サーバ(1)

### sprintf 関数についての解説

sprintf 関数は、特定のフォーマットに合わせて文字列を作成するために使用されます。この関数では、プレースホルダ（フォーマット指定子）を用いて、引数として提供された値をフォーマットします。

- 主なフォーマット指定子

```
%s：文字列
%d：整数
%f：浮動小数点数
%b：バイナリ表現
%x：16 進表現
```

#### 例

以下の例では、%s と%d が使用されています：

```
$name = "Alice";
$age = 30;
$formattedString = sprintf("Name: %s, Age: %d", $name, $age);
echo $formattedString; // 出力: Name: Alice, Age: 30
```

#### sprintf の利点

sprintf を使用すると、文字列を連結するよりも読みやすく、整理されたコードを作成できます。複数の値を一度にフォーマットして組み込むため、コードの可読性が向上します。

#### printf との違い

sprintf はフォーマットされた文字列を返しますが、printf はフォーマットされた文字列をそのまま出力します。printf を使用すると、echo を使わずに直接文字列を表示できます。

```
$planet = "Earth";
echo sprintf("%s Rocks© Website %s. All rights reserved.", $planet, date("Y"));
// または
printf("%s Rocks© Website %s. All rights reserved.", $planet, date("Y"));
```

このように、sprintf や printf を使用することで、文字列の連結よりも効果的にフォーマットされた文字列を扱うことができます。

## Lorem Ipsum (1)

composer の install

Dockerfile に以下を追記

```
# Composer のインストール
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && HASH="$(curl -sS https://composer.github.io/installer.sig)" \
    && echo "$HASH composer-setup.php" | sha384sum -c - \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php
```

## Lorem Ipsum(2)

faker のインストール

```

```
