package oop_battery;

// ゲッターとセッターの練習
// それでは、以下のエディタで Battery7v を更新して、実装と使用を分離してください。

// 全てのメンバ変数をプライベートに設定し、ユーザがデータにアクセスして読み込めるようにセッターとゲッターを作成してください。
// ただし、メーカーやモデル、製造数量を表す manufacturedCount は、一度設定された後はユーザによる上書きができないように設定してください。
// これにより、意図しないデータの変更を防ぐことができます。他の属性（例えばバッテリーの容量や重量など）は、修理やアップグレードの際に自由に更新できるようにしてください。

class Main {
	public static void main(String[] args) {
		Battery7v zlD72 = new Battery7v("MT-Dell Tech", "ZL-D72", 9.9, 1.18, 38, 80, 70);
		Battery7v zlD50 = new Battery7v("MT-Dell Tech", "ZL-D50", 6.6, 0.9, 28, 50, 65);
		Battery7v zlD40 = new Battery7v("MT-Dell Tech", "ZL-D40", 5.3, 1.18, 38, 80, 70);
		// privateにはアクセスできません。
		// System.out.println("Total batteries manufactured: " +
		// Battery7v.manufacturedCount);

		System.out.println();
		ExternalModule.dangerousMethod("AD515221", zlD40);
		ExternalModule.otherDangerousMethod();

		System.out.println();
		// privateにはアクセスできません。
		// System.out.println("Total batteries manufactured: " +
		// Battery7v.manufacturedCount);
	}
}
