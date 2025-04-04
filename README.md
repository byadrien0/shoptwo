# Welcome to the GITHUB of **shoptwo.shop**

Shoptwo.shop is an online marketplace dedicated to digital products, aiming to support digital creators in monetizing their work. It provides a platform where creators can sell their digital creations to a wider audience or offer them for free, making it easier to share their talent, generate income, and reach potential customers worldwide.

Original site: [https://shoptwo.shop/](https://shoptwo.shop/)

---

![image](https://github.com/user-attachments/assets/cffeec68-dc87-4f99-9098-aea34cf5e525)

---

## 🌍 Language
The site is primarily built in **French** 🇫🇷, but it can be easily translated thanks to the built-in translation plugin directly integrated into the site's interface 🌐.

---

## ⚠️ Important Notice

It is **strictly forbidden** to:

- Impersonate the **owner**, **creator**, or **distributor** of the site.

However, **modifications** are **allowed and encouraged** to **improve the site's features**. Each accepted and added feature will be **credited to its author**.

---

## 🔧 Initial Setup

### 1️⃣ OAuth2 Authentication 🔐

Set up **OAuth2** to securely integrate the following services:

- **Google** 🌐
- **Meta** 📘
- **Twitch** 🎮
- **Discord** 💬

Modify the configuration file:

📂 **`/auth/auth-form-update.php`**

```php
// OAuth2 Configuration for Discord
$client_id_discord = 'YOUR_CLIENT_ID';
$client_secret_discord = 'YOUR_CLIENT_SECRET';
$redirect_uri_discord = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=discord';

// OAuth2 Configuration for Google
$client_id_google = 'YOUR_CLIENT_ID';
$client_secret_google = 'YOUR_CLIENT_SECRET';
$redirect_uri_google = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=google';

// OAuth2 Configuration for Twitch
$client_id_twitch = 'YOUR_CLIENT_ID';
$client_secret_twitch = 'YOUR_CLIENT_SECRET';
$redirect_uri_twitch = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=twitch';

// OAuth2 Configuration for Meta
$client_id_meta = 'YOUR_CLIENT_ID';
$client_secret_meta = 'YOUR_CLIENT_SECRET';
$redirect_uri_meta = 'https://YOUR_URL/auth/auth-form-update.php?selected_provider=meta';
```

---

⚙️ Configure the sessions by adding your URL:

Modify the configuration file:

📂 **`/includes/session_config`**

```php
$cookieParams['domain'] = 'your_url'; // Assurez-vous que le domaine est correct
```

---

### 3️⃣ Stripe Integration 💳

Set up **Stripe** via a webhook for automated and secure payment management.

📂 **Modify the file `/dashboard/z-stripe.php`**

```php
// Set Stripe secret API key
\Stripe\Stripe::setApiKey('YOUR_KEY_API');

// Stripe Webhook Secret Key
$endpoint_secret = 'YOUR_WEBHOOK_STRIPE'; // Replace with your Stripe webhook secret
```

📂 **Modify the file `/dashboard/stripe-checkout.php`**

```php
\Stripe\Stripe::setApiKey('YOUR_KEY_API');
```

---

## 🗄️ Database Setup

A **blank database** with all necessary tables is available in the root directory of the project.  

📂 **File:** `adnow.sql`  

To set up the database, simply import this SQL file into your MySQL server (or in phpmyadmin)

Modify the configuration file:

📂 **`/includes/database.php`**

```php

define('DB_SERVER', 'YOUR_DB_SERVER');
define('DB_USER', 'YOUR_DB_USER');
define('DB_PASS', 'YOUR_DB_PASS');
define('DB_NAME', 'YOUR_DB_NAME');
$con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (!$con) {
    trigger_error("Failed to connect to MySQL: " . mysqli_connect_error(), E_USER_ERROR);
}
```

---

## 🛡️ Code Security and Robustness

The site may currently have some **security vulnerabilities**. It is therefore highly recommended to:

- **Review** the entire source code to identify and fix potential vulnerabilities 🔍.
- **Enhance** system robustness by applying best security practices 🔒.

---

## ⚠️ Development Notes

At this stage, there may be some pointing or implementation errors. However, these errors **do not compromise** the overall quality of the project. They are generally **easy to fix** and help establish a solid foundation for future developments:

- **Ad management** 📊
- **Creation of creative advertisements** 🎨

---

## 🤝 Contribution

Feel free to **contribute** or **ask questions** about the project via **issues** or by submitting **pull requests**! 🚀

---

## 👋 Project Participants Credits  

- **Original Founder** (**ByAdrien**)

---

## Project Images


---

![image](https://github.com/user-attachments/assets/7a1da34c-ef6a-445e-98d0-a82ca21e35a9)

---

![image](https://github.com/user-attachments/assets/d0ac35e1-1937-42d7-807f-66ece55b885e)

---

![image](https://github.com/user-attachments/assets/87a0b408-c323-4dc8-8ab9-d7a5b52b8114)

---

![image](https://github.com/user-attachments/assets/226c5513-0403-446e-ac32-0995da30fadd)

---

![image](https://github.com/user-attachments/assets/b4a3deaf-a8cb-425e-b9e3-e0b7ee09edcd)

---


