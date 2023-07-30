<?php

namespace App\Core;

class KTBootstrap
{
    // Init theme mode option from settings
    public static function init()
    {
        KTBootstrap::initThemeMode();
        KTBootstrap::initThemeDirection();
        KTBootstrap::initLayout();
    }

    // Init theme direction option (RTL or LTR) from settings
    // Init RTL html attributes by checking if RTL is enabled.
    // This function is being called for the html tag

    public static function initThemeMode()
    {
        setModeSwitch(config('settings.KT_THEME_MODE_SWITCH_ENABLED'));
        setModeDefault(config('settings.KT_THEME_MODE_DEFAULT'));
    }

    // Init layout html attributes and classes

    public static function initThemeDirection()
    {
        setDirection(config('settings.KT_THEME_DIRECTION'));

        if (isRtlDirection()) {
            addHtmlAttribute('html', 'direction', 'rtl');
            addHtmlAttribute('html', 'dir', 'rtl');
            addHtmlAttribute('html', 'style', 'direction: rtl');
        }
    }

    // Main initialization

    public static function initLayout()
    {
        addHtmlAttribute('body', 'id', 'kt_app_body');
        addHtmlAttribute('body', 'data-kt-name', getName());
    }
}
