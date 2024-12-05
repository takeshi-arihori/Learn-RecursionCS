# Javaにおける型変換（キャスティング）の基本と実践

## 型変換とは

型変換（キャスティング）は、あるデータ型を別のデータ型に変更する重要な操作です。Javaでは、データ型間の変換を安全かつ柔軟に行うことができます。

## 型変換の種類

Javaには主に2種類の型変換があります：

### 1. 暗黙の型変換（Widening Conversion）

暗黙の型変換は、コンパイラが自動的に実行する型変換で、データの損失なく安全に変換できる場合に適用されます。

#### 変換の優先順位
```
byte → short → int → long → float → double
char → int
```

#### 例
```java
int intValue = 100;
long longValue = intValue;  // 暗黙の型変換
double doubleValue = longValue;  // 自動変換
```

### 2. 明示的な型変換（Narrowing Conversion）

明示的な型変換は、開発者が意図的に型を変更する方法で、データ損失の可能性があります。

#### 変換方法
```java
(変換したい型) 変数名
```

#### 例
```java
double doubleValue = 100.55;
int intValue = (int) doubleValue;  // 明示的な型変換
```

## 型変換の注意点

### データ損失のリスク
- 大きな型から小さな型に変換する際、データが失われる可能性があります
- 浮動小数点から整数への変換で、小数点以下が切り捨てられます

### オーバーフローに注意
```java
int largeValue = 1000000;
short shortValue = (short) largeValue;  // 予期せぬ結果
```

## 型変換の実践的なパターン

### 計算時の型変換
```java
int a = 5;
int b = 3;
double result = (double) a / b;  // 1.6666666666666667
```

### ラッパークラスを使用した変換
```java
String strValue = "123";
int intValue = Integer.parseInt(strValue);
```

## ベストプラクティス

1. 可能な限り暗黙の型変換を活用する
2. 明示的な型変換は慎重に行う
3. データ損失の可能性を常に意識する
4. オーバーフローチェックを行う

## まとめ

型変換は Javaプログラミングにおいて重要な概念です。データ型の特性を理解し、適切に型変換を行うことで、安全で効率的なコードを作成できます。
