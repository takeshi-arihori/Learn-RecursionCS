// 問題: 葉ノードの数
// medium
// 二分木 root が与えられるので、最深層に存在する葉ノードの合計値を返す、deepestLeaves という関数を作成してください。

// 入力のデータ型： binaryTree<integer> root
// 出力のデータ型： integer

// テストケース
// deepestLeaves( toBinaryTree([3,2,1,null,7,8]) )--> 15
// deepestLeaves( toBinaryTree([5,8,1,10,12,8,null,null,null,null,null,9,10])
// )--> 19
// deepestLeaves( toBinaryTree([5,2,18,4,3]) )--> 7
// deepestLeaves( toBinaryTree([27,14,35,10,19,31,42]) )--> 102
// deepestLeaves( toBinaryTree([30,15,60,7,22,45,75,null,null,17,27]) )--> 44
// deepestLeaves( toBinaryTree([50,17,76,9,23,54,null,null,14,19,null,null,72])
// )--> 105
// deepestLeaves( toBinaryTree([16,14,10,8,7,9,3,2,4,1]) )--> 7
// deepestLeaves( toBinaryTree([0,-10,5,null,-3,null,9]) )--> 6

package advanced.binarytree.number_of_leaf_nodes;

import java.util.ArrayList;
import java.util.Deque;
import java.util.ArrayDeque;

public class Main {
    public static void main(String[] args) {
        // deepestLeaves( toBinaryTree([3,2,1,null,7,8]) )--> 15

        BinaryTree<Integer> root = new BinaryTree<Integer>(3);
        root.left = new BinaryTree<Integer>(2);
        root.right = new BinaryTree<Integer>(1);
        root.left.left = null;
        root.left.right = new BinaryTree<Integer>(7);
        root.right.left = new BinaryTree<Integer>(8);

        System.out.println("test1: " + deepestLeaves(root));

        // toBinaryTree([5,8,1,10,12,8,null,null,null,null,null,9,10]) )--> 19
        BinaryTree<Integer> root2 = new BinaryTree<Integer>(5);
        root2.left = new BinaryTree<Integer>(8);
        root2.right = new BinaryTree<Integer>(1);
        root2.left.left = new BinaryTree<Integer>(10);
        root2.left.right = new BinaryTree<Integer>(12);
        root2.right.left = new BinaryTree<Integer>(8);
        root2.right.right = null;
        root2.left.left.left = null;
        root2.left.left.right = null;
        root2.left.right.left = null;
        root2.left.right.right = null;
        root2.right.left.left = new BinaryTree<Integer>(9);
        root2.right.left.right = new BinaryTree<Integer>(10);

        System.out.println("test2: " + deepestLeaves(root2));

    }

    public static int deepestLeaves(BinaryTree<Integer> root) {
        // BinaryTreeのノードを要素として両端キューを作成
        Deque<BinaryTree<Integer>> queue = new ArrayDeque<>();
        // 根ノードを両端キューに入れておく。
        if (root != null) {
            queue.add(root);
        }
        // ヘルパー関数が返す両端キューをresultに保存。resultの要素はすべて葉ノード。
        Deque<BinaryTree<Integer>> result = deepestLeavesHelper(queue);
        // 葉ノードを合計するための変数
        int total = 0;
        // resultをループして要素を足す
        for (BinaryTree<Integer> node : result) {
            total += node.data;
        }

        return total;
    }

    // ヘルパー関数を定義し、両端キューを引数にとります。
    public static Deque<BinaryTree<Integer>> deepestLeavesHelper(Deque<BinaryTree<Integer>> queue) {

        // 子ノードを入れるための両端キューを作成
        Deque<BinaryTree<Integer>> child = new ArrayDeque<>();
        // 引数queueをループして、その要素の子ノードをchildに入れる
        for (BinaryTree<Integer> node : queue) {
            if (node.left != null) {
                child.add(node.left);
            }
            if (node.right != null) {
                child.add(node.right);
            }
        }

        // ベースケース: childが空になった時、queueに入っているのは全て最深層の葉ノードになる。
        if (child.isEmpty()) {
            return queue;
        } else {
            // 再帰呼び出し: childを引数にして再帰呼び出しを行う。
            return deepestLeavesHelper(child);
        }
    }
}
