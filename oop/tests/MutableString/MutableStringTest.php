<?php

declare(strict_types=1);

namespace Tests\MutableString;

use PHPUnit\Framework\TestCase;
use App\Models\MutableString\MutableString;

/**
 * MutableStringTestクラス
 * 
 * MutableStringクラスのappendメソッドに対するTDD（テスト駆動開発）テストケース
 * TDDの練習として、詳細なコメントを含めて実装
 * 
 * TDDのサイクル：
 * 1. Red（レッド）: 失敗するテストを書く
 * 2. Green（グリーン）: テストを通す最小限のコードを書く
 * 3. Refactor（リファクタ）: コードをより良く改善する
 */
class MutableStringTest extends TestCase
{
    /**
     * appendメソッドの基本的な動作をテスト
     * 
     * Given（前提条件）: 空のMutableStringオブジェクトが存在する
     * When（実行）: append("H")メソッドを呼び出す
     * Then（期待結果）: 文字列が"H"になる
     * 
     * このテストは現在失敗する（Red状態）
     * なぜなら、MutableStringクラスのappendメソッドがまだ実装されていないため
     */
    public function testAppendSingleCharacterToEmptyString(): void
    {
        // Given: 空のMutableStringオブジェクトを作成
        $mutableString = new MutableString("");

        // When: 文字"H"を追加
        $mutableString->append("H");

        // Then: 文字列が"H"になることを確認
        $this->assertEquals("H", (string)$mutableString);
    }

    /**
     * 既存の文字列に文字を追加するテスト
     * 
     * Given（前提条件）: "Hello"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append("!")メソッドを呼び出す
     * Then（期待結果）: 文字列が"Hello!"になる
     * 
     * このテストは、appendメソッドが既存の文字列の末尾に正しく文字を追加することを確認
     */
    public function testAppendCharacterToExistingString(): void
    {
        // Given: "Hello"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("Hello");

        // When: 文字"!"を追加
        $mutableString->append("!");

        // Then: 文字列が"Hello!"になることを確認
        $this->assertEquals("Hello!", (string)$mutableString);
    }

    /**
     * 複数回のappend操作をテスト
     * 
     * Given（前提条件）: "H"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append("e")、append("l")、append("l")、append("o")を順次実行
     * Then（期待結果）: 文字列が"Hello"になる
     * 
     * このテストは、連続したappend操作が正しく動作することを確認
     * 複数回の状態変更が期待通りに蓄積されることをテスト
     */
    public function testMultipleAppendOperations(): void
    {
        // Given: "H"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("H");

        // When: 複数の文字を順次追加
        $mutableString->append("e");
        $mutableString->append("l");
        $mutableString->append("l");
        $mutableString->append("o");

        // Then: 文字列が"Hello"になることを確認
        $this->assertEquals("Hello", (string)$mutableString);
    }

    /**
     * 空文字の追加をテスト
     * 
     * Given（前提条件）: "Test"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append("")メソッドを呼び出す（空文字を追加）
     * Then（期待結果）: 文字列が"Test"のまま変わらない
     * 
     * このテストは、空文字を追加しても元の文字列が変更されないことを確認
     * エッジケース（境界値）のテスト
     */
    public function testAppendEmptyString(): void
    {
        // Given: "Test"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("Test");

        // When: 空文字を追加
        $mutableString->append("");

        // Then: 文字列が変わらずに"Test"のままであることを確認
        $this->assertEquals("Test", (string)$mutableString);
    }

    /**
     * 複数文字を一度に追加するテスト
     * 
     * Given（前提条件）: "Hello"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append(" World")メソッドを呼び出す（複数文字を追加）
     * Then（期待結果）: 文字列が"Hello World"になる
     * 
     * このテストは、append メソッドが単一文字だけでなく、
     * 複数文字（文字列）も正しく追加できることを確認
     * API仕様では「文字」とあるが、実際の使用では文字列の追加も必要になる可能性がある
     */
    public function testAppendMultipleCharacters(): void
    {
        // Given: "Hello"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("Hello");

        // When: 複数文字（文字列）" World"を追加
        $mutableString->append(" World");

        // Then: 文字列が"Hello World"になることを確認
        $this->assertEquals("Hello World", (string)$mutableString);
    }

    /**
     * 特殊文字の追加をテスト
     * 
     * Given（前提条件）: "Test"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append("\n")メソッドを呼び出す（改行文字を追加）
     * Then（期待結果）: 文字列が"Test\n"になる
     * 
     * このテストは、改行文字などの特殊文字も正しく追加されることを確認
     * 文字エンコーディングに関する問題がないかをチェック
     */
    public function testAppendSpecialCharacters(): void
    {
        // Given: "Test"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("Test");

        // When: 改行文字を追加
        $mutableString->append("\n");

        // Then: 文字列に改行文字が正しく追加されることを確認
        $this->assertEquals("Test\n", (string)$mutableString);
    }

    /**
     * 数値文字の追加をテスト
     * 
     * Given（前提条件）: "Version"という文字列を持つMutableStringオブジェクトが存在する
     * When（実行）: append("1")メソッドを呼び出す（数値文字を追加）
     * Then（期待結果）: 文字列が"Version1"になる
     * 
     * このテストは、数値文字も正しく文字列として追加されることを確認
     * 型の混在による問題がないかをチェック
     */
    public function testAppendNumericCharacter(): void
    {
        // Given: "Version"という文字列でMutableStringオブジェクトを作成
        $mutableString = new MutableString("Version");

        // When: 数値文字"1"を追加
        $mutableString->append("1");

        // Then: 文字列が"Version1"になることを確認
        $this->assertEquals("Version1", (string)$mutableString);
    }

    /**
     * start から最後までの部分文字列を持つ新しい mutableString オブジェクトを返します。
     * 文字列のインデックス start から最後までの部分文字列を持つ新しい mutableString オブジェクトを返します。
     */
}
