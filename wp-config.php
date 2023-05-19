<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp_test_plugin' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'TBbPbrFsK3?l#_n7f*$PXfxJke<E*x&-y+zj!VB.|&C7ju%5F#+o.6Uqa.TV3)6j' );
define( 'SECURE_AUTH_KEY',  '@40U/|VMixZ$Kpq`uY^CHz?/_Nw5OHghJ/mhD91s~u_.Q#(E/Dks7uU!T`}cYhY>' );
define( 'LOGGED_IN_KEY',    '0Efh=RWX#a17BTh3mW!{a1I8}W7!D7[Gk+,kRH[aKz5qbpVT^8L!HFQA4as)jLd3' );
define( 'NONCE_KEY',        '3Owhq^!jSQK]sG_vFNK4]i5F6sNXZi|uQ=gwXz 1%xf4@:,I 3&yC A:#LAr79N~' );
define( 'AUTH_SALT',        '>t5bJ#G^$N<ZOoRs(:aC9ZTVuk_w;(Bh_*T4v7P;DsqUQ<>%:S*;djt?7-45`,f{' );
define( 'SECURE_AUTH_SALT', 'a`n0@D*/bjN^,IcXgY:q2i2C.LG3OQ =Z{!~uZM~GBC@8qDz5sNN3I3qs&kQ:S}w' );
define( 'LOGGED_IN_SALT',   'hQL1@$}-h$|1@U+N!3p`_}gd*wXA:FR_QDrp;3-/)SysEiDO<t9JI)B3C8iXu|9j' );
define( 'NONCE_SALT',       'X#BYygH%s::5& 4oe~ z?kp{tNK]$QIRp[ub2@h[cAiPBl0iKuZusR2fjNeUM%xe' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
