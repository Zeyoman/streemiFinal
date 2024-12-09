<?php
// src/Enum/MediaType.php
// App\Enum\MediaType
namespace App\Enum;

enum MediaType: string
{
    case MOVIES = 'film';
    case SERIES = 'series';
    case DOCUMENTARY = 'documentary';
    case ANIMATION = 'animation';
    case SHORT_FILM = 'short_film';
    case OTHER = 'other';
}