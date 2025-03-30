<?php

function getAvatarUrl($ex_avatar_logo, $ex_account_type)
{
    $defaultAvatarUrl = '/assets/images/avatar/avatar-';
    $randomNumber = rand(1, 13);
    $defaultAvatarUrl .= $randomNumber . '.png';

    // Vérifie si l'image spécifiée existe et est valide
    if (!empty($ex_avatar_logo) && @getimagesize($ex_avatar_logo)) {
        return $ex_avatar_logo;
    }

    $avatarUrls = [
        "google" => $ex_avatar_logo,
        "discord" => $ex_avatar_logo,
        "meta" => $ex_avatar_logo,
        "twitch" => $ex_avatar_logo,
    ];

    // Vérifie si $ex_account_type est vide
    if (empty($ex_account_type) || !array_key_exists($ex_account_type, $avatarUrls) || empty($avatarUrls[$ex_account_type])) {
        return $defaultAvatarUrl;
    }

    // Vérifie si l'image associée à $ex_account_type est valide
    if (!@getimagesize($avatarUrls[$ex_account_type])) {
        return $defaultAvatarUrl;
    }

    return $avatarUrls[$ex_account_type];
}
