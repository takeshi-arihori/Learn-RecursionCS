<?php

namespace Advanced\BinaryTree;

class BinaryTree
{
    private int $data;
    private ?BinaryTree $left;
    private ?BinaryTree $right;

    public function __construct(int $data, ?BinaryTree $left = null, ?BinaryTree $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }

    // getter
    public function getData(): int
    {
        return $this->data;
    }
    public function getLeft(): ?BinaryTree
    {
        return $this->left;
    }
    public function getRight(): ?BinaryTree
    {
        return $this->right;
    }

    // setter
    public function setData(int $data): void
    {
        $this->data = $data;
    }
    public function setLeft(?BinaryTree $left): void
    {
        $this->left = $left;
    }
    public function setRight(?BinaryTree $right): void
    {
        $this->right = $right;
    }
}
