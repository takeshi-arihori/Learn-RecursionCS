const config = {
    parentId: 'parent',
    url: 'https://ndlsearch.ndl.go.jp/api/opensearch?',
}

// ログを出力
function logBookCall(params) {
    const url = config.url + params;
    fetch(url).then(res => res.json()).then(data => {
        console.log(data);
    });
}


// データを確認
logBookCall("");