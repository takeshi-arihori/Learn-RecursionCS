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

    // 間順走査
    public function printInOrder(): void
    {
        $this->inOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    public function inOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->inOrderWalk($tRoot->left);
            echo ($tRoot->data . " ");
            $this->inOrderWalk($tRoot->right);
        }
    }

    // 前順走査
    public function printPreOrder(): void
    {
        $this->preOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    public function preOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            echo ($tRoot->data . " ");
            $this->preOrderWalk($tRoot->left);
            $this->preOrderWalk($tRoot->right);
        }
    }

    // 後順走査
    public function printPostOrder(): void
    {
        $this->postOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    public function postOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->postOrderWalk($tRoot->left);
            $this->postOrderWalk($tRoot->right);
            echo ($tRoot->data . " ");
        }
    }

    // 逆間順走査
    public function printReverseInOrder(): void
    {
        $this->reverseInOrderWalk($this);
        echo ("") . PHP_EOL;
    }

    public function reverseInOrderWalk($tRoot): void
    {
        if ($tRoot !== null) {
            $this->reverseInOrderWalk($tRoot->right);
            echo ($tRoot->data . " ");
            $this->reverseInOrderWalk($tRoot->left);
        }
    }
}

$binaryTree = new BinaryTree(1);
