# 静的、スタック、ヒープメモリ

メモリ割り当て（memory allocation）とは、変数、データ構造、クラスインスタンスなどの値を格納するために、メモリ上の特定の領域を確保するプロセスのことです。これにより、プログラムは必要に応じてこれらの値にアクセスし、操作することができるようになり、プログラムを実行する上で重要な役割を担っています。一般的にメモリ割り当てには、以下の 3 つの方法があります。

## 静的メモリ割り当て

静的メモリ割り当て（static memory allocation）は、プログラムが実行される前であるコンパイル時に行われます。割り当てられるサイズは固定されており、静的に割り当てられた変数はプログラムの開始から終了まで存続します。スコープの説明としてグローバル変数はプログラムが終了するまでメモリを占有すると言及しましたが、これは静的メモリ割り当てによるものだからです。

## スタックメモリ割り当て

スタックメモリ割り当て（stack memory allocation）は、コンピュータが関数を呼び出すたびに新しいメモリスペースを確保する方法です。このメモリスペースは、コールスタックと呼ばれる場所に一時的に保存されます。このメモリスペースには、関数で使用する変数のデータが格納されます。

関数が呼び出されると、その関数に対応するスコープがスタックに追加され、変数はこのスコープに保存されます。スコープが終了すると、変数とそのデータは削除され、スタック領域は再利用されます。つまり、変数の有効期間はスコープに制限されるため、自動メモリ割り当て（automatic memory allocation）と呼ばれます。

## ヒープメモリ割り当て

スタックメモリが自動的に割り当てられるメモリ領域であるのに対し、ヒープメモリはプログラマーが明示的に割り当てることのできるメモリ領域です。ヒープ割り当ては動的に実行されるので、動的メモリ割り当て（dynamic memory allocation）とも呼ばれます。メモリを割り当てるためには `new` や `malloc` などのキーワードや関数が使用され、そのサイズもプログラマーによって決められます（malloc は memory allocation の略です）。

連結リストや二分木のような動的なデータ構造を格納するために使用され、プログラム自身によって管理されます。スタックメモリとは異なり、ヒープメモリは特定の方法で編成されておらず、任意の順序でアクセスすることができます。

新しいメモリを割り当てる際、オペレーティングシステムはメモリ内の空き領域を探し、そのメモリアドレスを取得します。ヒープメモリはスタックメモリとは完全に分離されており、関数がスタックからポップされてもメモリアドレスとその内容が空になることはありません。メモリアドレスが参照可能な限り、そのメモリ領域が保有するデータを取得することができます。

ヒープメモリは隔離されているので、スコープがメモリアドレスを知っている限り、どのスコープからでもその中にあるデータを取得することができます。キーワードを介して `delete` を呼び出したり、`delete` や `free` などの関数を呼び出すことで、特定のヒープメモリをクリアすることができます。したがって、ヒープメモリの有効期間はユーザによって決定されます。

ヒープメモリの大きな問題は、メモリの割り当てをユーザが管理する責任があることです。ユーザーがヒープ割り当てを削除し忘れて、そのメモリが二度と使われない状態をメモリリーク（memory leak）と呼びます。メモリリークはメモリの性能低下の原因となるため注意が必要です。

C や C++ のようにメモリを完全に制御できる言語では、メモリリークを回避する責任はユーザにありますが、他のほとんどの言語では、インタプリタやコンパイラがその処理を行います。特にオブジェクトがヒープに保存され、自動処理が行われる言語の場合は何も行う必要はありません。使用しなくなったメモリをヒープメモリから自動的に削除する処理は、ガベージコレクタ（garbage collector）と呼ばれており、メモリリークを避けるために、最近ではマークアンドスイープなどの多くのアルゴリズムに基づいて処理が実行されています。

ヒープメモリを自動的に管理する言語では、オブジェクトインスタンスの作成などには、ヒープメモリ内の新しい割り当てを手動で作成し管理する機能がありません。ヒープメモリの管理は全て自動的に行われます。したがって、データがどこに保存され、それがスタック、もしくはヒープによるものなのかを理解するだけで問題ありません。

限られたスコープかつ参照渡しを通してのみ、スタックメモリの変数にアクセスできない一方、メモリアドレスの値を使うと、ヒープメモリへどのスコープからでもアクセスすることができるという利点があります。