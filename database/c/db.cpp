#include <iostream>
#include <vector>
#include <tuple>
using namespace std;

// TODO: C++の環境構築

// dan bernstein氏によるシンプルなdjb2アルゴリズム。MD5, SHA、その他多くのハッシュアルゴリズムをパスワードに使用される。
unsigned long passHash(const char *str)
{
    unsigned long hash = 5381;
    int c;
    while ((c = *str++))
    {
        hash = ((hash << 5) + hash) + c;
    }
    return hash;
}

// タプルはデータのリストですが、それぞれのリストは同じデータ型である必要はありません。
// 型定義を使用して、独自のカスタムデータ型を定義することができます。ここでは，userTypeスキーマを定義します。次のようなタプルになります。
typedef tuple<string, string, unsigned long, string, int> userType;

namespace users
{
    vector<tuple<string, string, unsigned long, string, int>> relation = {};
}

void printUsersRelation(vector<userType> relation)
{
    cout << "----Printing users----" << endl;
    for (int i = 0; i < relation.size(); i++)
    {
        // get<position>　でタプルのインデックスにアクセスできます。
        cout << "[";
        cout << "username: " << get<0>(relation[i]);
        cout << ", email: " << get<1>(relation[i]);
        cout << ", password: " << get<2>(relation[i]);
        cout << ", date of birth: " << get<3>(relation[i]);
        cout << ", country code: " << get<4>(relation[i]);
        cout << "]" << endl
             << endl;
    }
    cout << "--------" << endl;
}

int main()
{
    users::relation.push_back(tuple<string, string, unsigned long, string, int>("tommy434", "tommy434@example.com", passHash("secretpass"), "05/25/1982", 1));
    // userTypeを使うことができます。スキーマと考えてください。
    users::relation.push_back(userType("doorpink9", "doors2doors@example.com", passHash("anothersecret"), "02/16/1979", 1));
    users::relation.push_back(userType("parkriderz", "parkriderz@example.com", passHash("moreandmoresecrets"), "10/18/1990", 1));

    printUsersRelation(users::relation);
}