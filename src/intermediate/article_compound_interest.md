# 問題例

[銀行のソフトウェアの複利計算とブラックボックス関数の使用例](https://recursionist.io/dashboard/course/2/lesson/121)

複利計算の公式 P(1 + i)n を使用します。ここで、P は投資初期金額、i は年利、n は期間を指します。  
例えば、元金 300 万円を年利 3% で 20 年間運用すると、最終的に得られる金額は 300 × (1 + 0.03)20 = 5,418,321 円となります。

次に、ログインユーザーが年初から退職年まで、日本で最も収益が大きい会社の株を固定の年利で運用した場合の未来価値を計算するプログラムの例を考えます。それには、以下のブラックボックス関数を使用します。

-   loggedInUserId(): ログイン中のユーザー ID を返す関数
-   userInvestmentFunds(id): ID を入力として受け取り、ユーザーの投資初期金額（元金）を返す関数
-   userRetirementYear(id): ID を入力として受け取り、ユーザーの退職年を返す関数
-   yearsFrom(year): 年を入力として受け取り、現在からその年まであと何年残っているかを返す関数
-   topRankingStockByCountry(country): 国名を入力として受け取り、その国で最も収益が大きい株の名前を返す関数
-   getStockMarketReturnRate(stock): 株の名前を入力として受け取り、その株の年間収益率を返す関数
-   これらの関数を組み合わせて複利公式の各パーツを計算します。ユーザーの元金 P、運用期間 n、年利 i を得るためには、関数の出力を他の関数の入力として使用します。

### ユーザー ID の取得

$userId = loggedInUserId();

### 投資資金の取得

$investmentFunds = userInvestmentFunds($userId);

### 退職年の取得

$retirementYear = userRetirementYear($userId);

### 期間の計算

$years = yearsForm($retirementYear);

### 最も利回りの大きい株の取得

$topStock = topRankingStockByCountry("Japan");

### 年間収益率の取得

$annualReturn = getStockMarketReturnRate($topStock);

### 未来価値の計算

$futureValue = $investmentFunds \* pow(1 + $annualReturn, $years);
