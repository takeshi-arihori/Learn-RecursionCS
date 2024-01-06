package advanced.binarytree.number_of_leaf_nodes;

public class BinaryTree<E> {
    public E data;
    public BinaryTree<E> left;
    public BinaryTree<E> right;

    public BinaryTree() {
    }

    public BinaryTree(E data) {
        this.data = data;
    }

    public BinaryTree(E data, BinaryTree<E> left, BinaryTree<E> right) {
        this.data = data;
        this.left = left;
        this.right = right;
    }

}