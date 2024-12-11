<?php
// src/Enum/MediaType.php
// App\Enum\CommentStatus
namespace App\Enum;

enum CommentStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case DELETED = 'deleted';
}