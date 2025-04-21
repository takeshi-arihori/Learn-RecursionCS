<?php

namespace App\Http\Controllers\BinaryTree;

use App\Http\Controllers\Controller;
use BinaryTree;

class BinaryTreeController extends Controller
{
    private int $data;
    private ?BinaryTreeController $left;
    private ?BinaryTreeController $right;

    public function __construct(int $data, ?BinaryTreeController $left = null, ?BinaryTreeController $right = null)
    {
        $this->data = $data;
        $this->left = $left;
        $this->right = $right;
    }

    public function getData(): int
    {
        return $this->data;
    }

    public function getLeftTree(): ?BinaryTreeController
    {
        return $this->left;
    }

    public function getRightTree(): ?BinaryTreeController
    {
        return $this->right;
    }

    public function setLeftTree(int $data): void
    {
        $this->left = new BinaryTreeController($data);
    }

    public function setRightTree(int $data): void
    {
        $this->right = new BinaryTreeController($data);
    }
}
