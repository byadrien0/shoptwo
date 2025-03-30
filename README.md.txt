configurer la 0auth2 dans /auth/auth-form-update.php

configurer la database dans database : /includes/database.php

configurer les sessions en ajoutant votre url : /includes/session_config :
$cookieParams['domain'] = 'your_url'; // Assurez-vous que le domaine est correct

mettre vos clefs publiques et privées dans la configuration stripe : /purchases/stripe
create-checkout-session.php et webhook