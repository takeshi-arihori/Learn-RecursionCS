<?php

namespace App\Http\Controllers\BinaryTree;

use App\Http\Controllers\Controller;

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

    public function getLeftData(): ?BinaryTreeController
    {
        return $this->left;
    }

    public function getRightData(): ?BinaryTreeController
    {
        return $this->right;
    }
}
