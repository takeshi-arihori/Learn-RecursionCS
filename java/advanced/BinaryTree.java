// 二分木(Binary Tree)はデータ構造の一つで、根付きの木構造で、各ノードが最大で2つの子ノードを持つことができる。
// これらの子ノードは通常、「左の子ノード」と「右の子ノード」と呼ばれる。
// データが一つも含まれていない場合もあり、それはそれは「空の木」と呼ばれる
// 探索時間がデータの数の対数「log n」になるため、大量のデータを効率的に探索できる

class BinaryTree {
    private int data;
    // 左二分木
    private BinaryTree left;
    // 右二分木
    private BinaryTree right;

    BinaryTree(int data) {
        this.data = data;
    }

    public static void main(String[] args) {
        // テストケース1: [0,-10,5,null,-3,null,9]
        Integer[] arr1 = { 0, -10, 5, null, -3, null, 9 };
        BinaryTree root1 = toBinaryTree(arr1);
        System.out.println("Test 1: " + sumOfThreeNodes(root1)); // 期待値: 1

        // テストケース2: [5,2,18,-4,3]
        Integer[] arr2 = { 5, 2, 18, -4, 3 };
        BinaryTree root2 = toBinaryTree(arr2);
        System.out.println("Test 2: " + sumOfThreeNodes(root2)); // 期待値: 24

        // テストケース3: [27,14,35,10,19,31,42]
        Integer[] arr3 = { 27, 14, 35, 10, 19, 31, 42 };
        BinaryTree root3 = toBinaryTree(arr3);
        System.out.println("Test 3: " + sumOfThreeNodes(root3)); // 期待値: 178

        // テストケース4: [10,null,3]
        Integer[] arr4 = { 10, null, 3 };
        BinaryTree root4 = toBinaryTree(arr4);
        System.out.println("Test 4: " + sumOfThreeNodes(root4)); // 期待値: 13

        // テストケース5: [10,9]
        Integer[] arr5 = { 10, 9 };
        BinaryTree root5 = toBinaryTree(arr5);
        System.out.println("Test 5: " + sumOfThreeNodes(root5)); // 期待値: 19

        // テストケース6: [null]
        Integer[] arr6 = { null };
        BinaryTree root6 = toBinaryTree(arr6);
        System.out.println("Test 6: " + sumOfThreeNodes(root6)); // 期待値: 0
    }

    // 配列から二分木を構築するヘルパーメソッド
    private static BinaryTree toBinaryTree(Integer[] arr) {
        if (arr == null || arr.length == 0 || arr[0] == null) {
            return null;
        }
        return buildTree(arr, 0);
    }

    private static BinaryTree buildTree(Integer[] arr, int index) {
        if (index >= arr.length || arr[index] == null) {
            return null;
        }
        BinaryTree root = new BinaryTree(arr[index]);
        root.left = buildTree(arr, 2 * index + 1);
        root.right = buildTree(arr, 2 * index + 2);
        return root;
    }

    public static int sumOfThreeNodes(BinaryTree root) {
        if (root == null) {
            return 0;
        }

        int leftSum = sumOfThreeNodes(root.left);
        int rightSum = sumOfThreeNodes(root.right);
        return root.data + leftSum + rightSum;
    }
}
