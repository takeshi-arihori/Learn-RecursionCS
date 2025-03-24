// 二分木(Binary Tree)はデータ構造の一つで、根付きの木構造で、各ノードが最大で2つの子ノードを持つことができる。
// これらの子ノードは通常、「左の子ノード」と「右の子ノード」と呼ばれる。
// データが一つも含まれていない場合もあり、それはそれは「空の木」と呼ばれる
// 探索時間がデータの数の対数「log n」になるため、大量のデータを効率的に探索できる

class BinaryTree {
    int data;
    // 左二分木
    BinaryTree left;
    // 右二分木
    BinaryTree right;

    BinaryTree(int data) {
        this.data = data;
    }

    public static void main(String[] args) {
        BinaryTree root = new BinaryTree(1);
        root.left = new BinaryTree(2);
        root.right = new BinaryTree(3);
        root.left.left = new BinaryTree(4);
        root.left.right = new BinaryTree(5);

        System.out.println(root.data);
        System.out.println(root.left.data);
        System.out.println(root.right.data);
        System.out.println(root.left.left.data);
        System.out.println(root.left.right.data);
    }
}
