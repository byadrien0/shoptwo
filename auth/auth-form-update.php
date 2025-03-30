<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Rediriger l'utilisateur vers la page d'accueil s'il est déjà connecté.
if (isset($_SESSION['user_id'])) {
    header("Location: /");
    exit();
}

// Configuration OAuth2 Discord
$client_id_discord = 'client_id';
$client_secret_discord = 'client_secret';
$redirect_uri_discord = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=discord';

// Configuration OAuth2 Google
$client_id_google = 'client_id';
$client_secret_google = 'client_secret';
$redirect_uri_google = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=google';

// Configuration OAuth2 Twitch
$client_id_twitch = 'client_id';
$client_secret_twitch = 'client_secret';
$redirect_uri_twitch = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=twitch';

// Configuration OAuth2 Meta
$client_id_meta = 'client_id';
$client_secret_meta = 'client_secret';
$redirect_uri_meta = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=meta';

// Étape 1: Redirection vers la page d'authentification
if (isset($_GET['provider'])) {
    if ($_GET['provider'] == 'discord') {
        $url = "https://discord.com/api/oauth2/authorize?client_id=$client_id_discord&redirect_uri=$redirect_uri_discord&response_type=code&scope=identify%20email";
    } elseif ($_GET['provider'] == 'google') {
        $url = "https://accounts.google.com/o/oauth2/auth?client_id=$client_id_google&redirect_uri=$redirect_uri_google&response_type=code&scope=https://www.googleapis.com/auth/userinfo.email%20https://www.googleapis.com/auth/userinfo.profile";
    } elseif ($_GET['provider'] == 'twitch') {
        $url = "https://id.twitch.tv/oauth2/authorize?client_id=$client_id_twitch&redirect_uri=$redirect_uri_twitch&response_type=code&scope=user:read:email";
    } elseif ($_GET['provider'] == 'meta') {
        $url = "https://www.facebook.com/v10.0/dialog/oauth?client_id=$client_id_meta&redirect_uri=$redirect_uri_meta&response_type=code&scope=email,public_profile";
    }
    header("Location: $url");
    exit();
}

// Étape 2: Récupération du code d'authentification et échange contre un token d'accès
if (isset($_GET['code'])) {
    if (isset($_GET['selected_provider'])) {
        $selected_provider = $_GET['selected_provider'];
        $code = $_GET['code'];
        $provider_id = '';

        if ($selected_provider == 'discord') {
            $access_token = getAccessToken('https://discord.com/api/oauth2/token', [
                'client_id' => $client_id_discord,
                'client_secret' => $client_secret_discord,
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $redirect_uri_discord,
                'scope' => 'identify email'
            ]);

            $user_info = getUserInfo('https://discord.com/api/users/@me', ["Authorization: Bearer $access_token", 'User-Agent: My-App']);
            $provider_id = $user_info['id'];
            $avatar_url = "https://cdn.discordapp.com/avatars/{$user_info['id']}/{$user_info['avatar']}.png";
            $username = $user_info['username'];
            $primary_email = $user_info['email'];
        } elseif ($selected_provider == 'google') {
            $access_token = getAccessToken('https://accounts.google.com/o/oauth2/token', [
                'code' => $code,
                'client_id' => $client_id_google,
                'client_secret' => $client_secret_google,
                'redirect_uri' => $redirect_uri_google,
                'grant_type' => 'authorization_code',
            ]);

            $user_info = getUserInfo('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $access_token, []);
            $provider_id = $user_info['id'];
            $avatar_url = $user_info['picture'];
            $username = isset($user_info['given_name']) ? $user_info['given_name'] : '';
            $primary_email = isset($user_info['email']) ? $user_info['email'] : '';
        } elseif ($selected_provider == 'twitch') {
            $access_token = getAccessToken('https://id.twitch.tv/oauth2/token', [
                'client_id' => $client_id_twitch,
                'client_secret' => $client_secret_twitch,
                'code' => $code,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirect_uri_twitch,
            ]);

            if ($access_token) {
                $user_info = getUserInfo('https://api.twitch.tv/helix/users', [
                    "Authorization: Bearer $access_token",
                    "Client-ID: $client_id_twitch"
                ]);

                $provider_id = $user_info['data'][0]['id'];
                $avatar_url = $user_info['data'][0]['profile_image_url'];
                if (isset($user_info['data'][0])) {
                    $username = $user_info['data'][0]['display_name'];
                    $primary_email = $user_info['data'][0]['email'] ?? 'Email not provided';
                }
            }
        } elseif ($selected_provider == 'meta') {
            $access_token = getAccessToken('https://graph.facebook.com/v10.0/oauth/access_token', [
                'client_id' => $client_id_meta,
                'client_secret' => $client_secret_meta,
                'redirect_uri' => $redirect_uri_meta,
                'code' => $code,
            ]);

            $user_info = getUserInfo('https://graph.facebook.com/me?fields=id,name,email,picture&access_token=' . $access_token, []);
            $provider_id = $user_info['id'];
            $username = $user_info['name'];
            $primary_email = $user_info['email'];
            $avatar_url = $user_info['picture']['data']['url'];

        }

        // Vérifier si l'utilisateur est déjà inscrit
        $stmt = $con->prepare('SELECT * FROM users WHERE acc_type = ?');
        $stmt->bind_param('s', $selected_provider);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if ($result) {
            $_SESSION['user_id'] = $result['id'];
            $user_id = $_SESSION['user_id'];
        } else {
            $account_type = $selected_provider;

            $stmt = $con->prepare('INSERT INTO users (acc_username, acc_email, acc_type, acc_avatar) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $username, $primary_email, $account_type, $avatar_url);
            $stmt->execute();
            $user_id = $stmt->insert_id;

            // Mettre à jour la session et ajouter une notification
            $_SESSION['user_id'] = $user_id;
            $user_id = $_SESSION['user_id'];
        }


        // Rediriger vers la page d'accueil
        header("Location: /");
        exit();
    }
}

// Fonction pour obtenir un token d'accès
function getAccessToken($url, $params)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    $response_data = json_decode($response, true);
    return $response_data['access_token'] ?? null;
}

// Fonction pour obtenir les informations utilisateur
function getUserInfo($url, $headers)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}

// Fonction pour générer un nom de fichier aléatoire
function generateRandomFileName($extension)
{
    return uniqid() . '.' . $extension;
}

// Fonction pour sauvegarder l'image de profil
function saveProfileImage($url, $destination)
{
    $image = file_get_contents($url);
    file_put_contents($destination, $image);
}
?>