package advanced.binarytree.dfs_bfs_java_learning;

// # 深さ優先探索と幅優先探索を使って、以下の問題に取り組む

// ## 問題
// 深さ最小
// medium
// 二分木 root が与えられるので、最小の深さを返す、minDepth という関数を作成してください。
// ここでの最小の深さとは、根ノードから最も近い葉ノードまでのノード数を指します。

// ## テストケース
// 1. Input:
//     8
//    / \
//   9   11
// Output: 1

// 2. Input:
//      93
//     /  \
//    16   65
//   /
//  80
// Output: 1

// ## 関数の入出力例

// 入力のデータ型：binaryTree<integer>root
// 出力のデータ型：integer

// minDepth(toBinaryTree([8,9,11]))-->1
// minDepth(toBinaryTree([93,16,65,80]))-->1
// minDepth(toBinaryTree([92,88,53,36,27,16,80,45]))-->2
// minDepth(toBinaryTree([44,12,49,3,29,46,62,null,null,null,null,null,null,null,70]))-->2
// minDepth(toBinaryTree([19,34,73,39,56,4,86,17,84,34]))-->2
// minDepth(toBinaryTree([97,10,77,32,40,70,32,96,27,10,12,93,82,33,55,71,59,82,37,75,25,31,14,96,85,41,28,70,9,56,8,90,8,65,49,45,34,30,25,7,7,97,23,66,84,57,38,38,95,9,77,60,44,3,81,41,89,90,73,100,86,53,96,40]))-->5

import java.util.ArrayList;
import java.util.Deque;
import java.util.prefs.BackingStoreException;
import java.util.ArrayDeque;

public class Main {
    public static void main(String[] args) {

        // minDepth(toBinaryTree([8,9,11]))-->1
        BinaryTree<Integer> root1 = new BinaryTree<Integer>(8);
        root1.left = new BinaryTree<Integer>(9);
        root1.right = new BinaryTree<Integer>(11);
        System.out.println(minDepth(root1));

        // minDepth(toBinaryTree([44,12,49,3,29,46,62,null,null,null,null,null,null,null,70]))-->2
        BinaryTree<Integer> root2 = new BinaryTree<Integer>(44);
        root2.left = new BinaryTree<Integer>(12);
        root2.right = new BinaryTree<Integer>(49);
        root2.left.left = new BinaryTree<Integer>(3);
        root2.left.right = new BinaryTree<Integer>(29);
        root2.right.left = new BinaryTree<Integer>(46);
        root2.right.right = new BinaryTree<Integer>(62);
        root2.right.right.right = new BinaryTree<Integer>(70);
        System.out.println(minDepth(root2));

    }

    // 深さ優先探索 (一番深さが浅いノードを確認したいため、深さ優先探索だと全ての木を無駄に走査する可能性がある。)
    // public static int minDepth(BinaryTree<Integer> root) {
    // // ベースケース
    // if (root == null) {
    // return 0;
    // }
    // // 葉ノードに辿り着いたら、0を返す。
    // if (root.left == null && root.right == null) {
    // return 0;
    // }

    // // 左側の部分木がnullだったら右側の子に対して再帰する。
    // if (root.right == null) {
    // return minDepth(root.left) + 1;
    // }

    // // 左側の部分木がnullだったら右側の子に対して再帰する。
    // if (root.left == null) {
    // return minDepth(root.right) + 1;
    // }

    // return 1 + Math.min(minDepth(root.left), minDepth(root.right));
    // }

    // 幅優先探索
    public static int minDepth(BinaryTree<Integer> root) {
        // NULL
        if (root == null) {
            return 0;
        }
        // キューを作成し、根ノードを入れておく
        Deque<BinaryTree<Integer>> queue = new ArrayDeque<>();
        queue.add(root);
        // 根ノードをiteratorとする
        BinaryTree<Integer> iterator = root;
        // 最初の深さを0とする
        int level = 0;

        // キューが空になるまで走査
        while (!queue.isEmpty()) {
            // キューのサイズを取得
            int size = queue.size();

            // キューのサイズだけループして、同じ深さのノードを走査する
            for (int i = 0; i < size; i++) {
                // キューの先頭を削除し、新しいiteratorとする
                iterator = queue.pop();
                // 右の子も左の子もnullの場合、葉ノードに到達したことになるので、その時の深さを返す。
                if (iterator.left == null && iterator.right == null) {
                    return level;
                }
                // iteratorの左右の子をキューに入れる
                if (iterator.left != null) {
                    queue.add(iterator.left);
                }
                if (iterator.right != null) {
                    queue.add(iterator.right);
                }
            }
            level++;
        }
        return level;

    }
}