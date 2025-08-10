<?php


// あなたはエンタープライズ向けのクラウドシステムを構築する開発チームの一員です。このソフトウェアには、ユーザーがファイルを保存、読み取り、書き込みできる機能が含まれています。ユーザーはファイルを共有したり、上書きを防ぐためにファイルをロックしたりすることもできます。以下の指示に従って `Files` クラスを作成し、テストケースを出力してください。

### クラス: Files

#### プロパティ:
// - `String fileName`: ファイルの名前。
// - `String fileExtension`: ファイルの拡張子。`.word`、`.png`、`.mp4`、または `.pdf` でない場合は `.txt` に設定します。
// - `String content`: ファイルの内容。
// - `String parentFolder`: ファイルが保存されているフォルダの名前。

#### メソッド:
// - `String getLifetimeBandwidthSize()`: サービス中にファイルが使用する最大帯域幅サイズを返します。`content` の文字数（スペースを含む）に対して 25MB を掛けて計算します。例えば、`content` が 40 文字の場合、サイズは 40 * 25MB = 1,000MB = 1GB です。サイズが 1000MB 以上の場合は GB を使用します。
// - `String prependContent(String data)`: データ文字列をファイルの `content` の先頭に追加し、新しい `content` を返します。
// - `String addContent(String data, int position)`: 指定されたインデックスにデータ文字列をファイルの `content` に追加し、新しい `content` を返します。
// - `String showFileLocation()`: ファイルの場所を `parentFolder > fileName.fileExtension` の形式で返します。


class Files
{
    public string $fileName;
    public string $fileExtension;
    public string $content;
    public string $parentFolder;

    public function __construct($fileName, $fileExtension, $content, $parentFolder)
    {
        $this->fileName = $fileName;
        $this->fileExtension = $fileExtension;
        $this->content = $content;
        $this->parentFolder = $parentFolder;
    }


    // サービス中に使われるファイルの最大容量を返す
    public function getLifetimeBandwidthSize(): string
    {
        $fileM = strlen($this->content) * 25;
        return $fileM >= 1000 ? strVal($fileM / 1000) . 'GB' : strVal($fileM) . 'MB';
    }

    // ファイルの content の先頭にデータ文字列を追加し、新しい content を返す
    public function prependContent(string $data): string
    {
        $this->content = $data . $this->content;
        return $this->content;
    }

    // ファイルの content の指定した位置（インデックス）にデータ文字列を追加し、新しい content を返す
    public function addContent(string $data, int $position): string
    {
        $front = substr($this->content, 0, $position);
        $back = substr($this->content, $position);
        return $front . $data . $back;
    }

    // 親ファイル > ファイル名.拡張子という形で返す
    public function showFileLocation(): string
    {
        return $this->parentFolder . ' > ' . $this->fileName . $this->fileExtension;
    }
}
