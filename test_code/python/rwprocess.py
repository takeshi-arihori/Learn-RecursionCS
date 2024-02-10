import os

#os.pipe()は2つのファイル記述子を生成。1つは読み込み用、もう1つは書き込み用です。
r, w = os.pipe()
pid = os.fork()

if pid > 0:
    # 親プロセスでは読み取り端を閉じる(親プロセスはパイプにデータを書き込むだけで、読み取りはしないから。)
    os.close(r)
    # 親プロセスからのメッセージを生成(os.getpid()を使用して現在のプロセスID(親のプロセスID)を取得
    message = 'Message from parent with pid {}'.format(os.getpid())
    # 生成したメッセージを表示
    print("Parent, sending out the message - {}".format(message, os.getpid()))
    # メッセージをエンコードしてパイプに書き込む
    os.write(w, message.encode('utf-8'))
else:
    # 子プロセスでは書き込み端を閉じる(子プロセスはパイプからデータを読み込むだけで、書き込みはしないから。)
    os.close(w)
    # 子プロセスであることとそのプロセスIDを表示
    print("Fork is 0, this. is a Child PID:", os.getpid())
    # 読み取り用のファイルディスクリプタを開く
    f = os.fdopen(r)
    # パイプから読み取ったメッセージを表示
    print("Incoming string:", f.read())