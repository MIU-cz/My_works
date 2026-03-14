<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;

final class RouterFactory {

    use Nette\StaticClass;

    public static function createRouter(): RouteList {
        $router = new RouteList;
        $router->addRoute('o-nas', [
            'presenter' => 'Homepage',
            'action' => 'aboutUs',
            'language' => 'cs'
        ]);
        $router->addRoute('about-us', [
            'presenter' => 'Homepage',
            'action' => 'aboutUs',
            'language' => 'en'
        ]);
        $router->addRoute('aktuality', [
            'presenter' => 'Homepage',
            'action' => 'news',
            'language' => 'cs'
        ]);
        $router->addRoute('news', [
            'presenter' => 'Homepage',
            'action' => 'news',
            'language' => 'en'
        ]);
        $router->addRoute('aktualita/<id>', [
            'presenter' => 'Homepage',
            'action' => 'newsArticle',
            'language' => 'cs'
        ]);
        $router->addRoute('news-article/<id>', [
            'presenter' => 'Homepage',
            'action' => 'newsArticle',
            'language' => 'en'
        ]);
        $router->addRoute('sluzby', [
            'presenter' => 'Homepage',
            'action' => 'services',
            'language' => 'cs'
        ]);
        $router->addRoute('services', [
            'presenter' => 'Homepage',
            'action' => 'services',
            'language' => 'en'
        ]);
        $router->addRoute('cisticka/<id>', [
            'presenter' => 'Homepage',
            'action' => 'cleaningPlant',
            'language' => 'cs'
        ]);
        $router->addRoute('cleaning-plant/<id>', [
            'presenter' => 'Homepage',
            'action' => 'cleaningPlant',
            'language' => 'en'
        ]);
        $router->addRoute('technika', [
            'presenter' => 'Homepage',
            'action' => 'equipment',
            'language' => 'cs'
        ]);
        $router->addRoute('technology', [
            'presenter' => 'Homepage',
            'action' => 'equipment',
            'language' => 'en'
        ]);
        $router->addRoute('ke-stazeni', [
            'presenter' => 'Homepage',
            'action' => 'files',
            'language' => 'cs'
        ]);
        $router->addRoute('for-download', [
            'presenter' => 'Homepage',
            'action' => 'files',
            'language' => 'en'
        ]);
        $router->addRoute('stahnout-soubor/<id>', [
            'presenter' => 'Homepage',
            'action' => 'downloadFile',
            'language' => 'sk'
        ]);
        $router->addRoute('download-file/<id>', [
            'presenter' => 'Homepage',
            'action' => 'downloadFile',
            'language' => 'en'
        ]);
        $router->addRoute('kariera', [
            'presenter' => 'Homepage',
            'action' => 'career',
            'language' => 'cs'
        ]);
        $router->addRoute('career', [
            'presenter' => 'Homepage',
            'action' => 'career',
            'language' => 'en'
        ]);
        $router->addRoute('pracovni-pozice/<id>', [
            'presenter' => 'Homepage',
            'action' => 'job',
            'language' => 'cs'
        ]);
        $router->addRoute('job/<id>', [
            'presenter' => 'Homepage',
            'action' => 'job',
            'language' => 'en'
        ]);
        $router->addRoute('kontakt', [
            'presenter' => 'Homepage',
            'action' => 'contact',
            'language' => 'cs'
        ]);
        $router->addRoute('contact', [
            'presenter' => 'Homepage',
            'action' => 'contact',
            'language' => 'en'
        ]);
        $router->addRoute('zprava-odeslana', [
            'presenter' => 'Homepage',
            'action' => 'messageSent',
            'language' => 'cs'
        ]);
        $router->addRoute('message-sent', [
            'presenter' => 'Homepage',
            'action' => 'messageSent',
            'language' => 'en'
        ]);
        $router->addRoute('ochrana-osobnich-udaju', [
            'presenter' => 'Homepage',
            'action' => 'protectionOfPersonalData',
            'language' => 'cs'
        ]);
        $router->addRoute('protection-of-personal-data', [
            'presenter' => 'Homepage',
            'action' => 'protectionOfPersonalData',
            'language' => 'en'
        ]);
        $router->addRoute('zasady-pouzivani-souboru-cookies', [
            'presenter' => 'Homepage',
            'action' => 'cookiePolicy',
            'language' => 'cs'
        ]);
        $router->addRoute('cookie-policy', [
            'presenter' => 'Homepage',
            'action' => 'cookiePolicy',
            'language' => 'en'
        ]);
        $router->addRoute('sitemap.xml', [
            'presenter' => 'Homepage',
            'action' => 'sitemap',
            'language' => 'cs'
        ]);
        $router->addRoute('sitemap-en.xml', [
            'presenter' => 'Homepage',
            'action' => 'sitemap',
            'language' => 'en'
        ]);
        $router->addRoute('<language cs|en>[/<action>]', [
            'presenter' => 'Homepage',
            'action' => 'default',
            'language' => 'cs'
        ]);
        return $router;
    }

}
