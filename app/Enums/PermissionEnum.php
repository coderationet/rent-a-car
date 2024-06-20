<?php

namespace App\Enums;

enum PermissionEnum : string
{
    // Dashboard
    case DASHBOARD_READ = 'dashboard_read';
    case DASHBOARD_UPDATE = 'dashboard_update';
    case DASHBOARD_DELETE = 'dashboard_delete';
    case DASHBOARD_CREATE = 'dashboard_create';

    // Items
    case ITEMS_READ = 'items_read';
    case ITEMS_UPDATE = 'items_update';
    case ITEMS_DELETE = 'items_delete';
    case ITEMS_CREATE = 'items_create';

    // Item Attribute
    case ITEM_ATTRIBUTES_READ = 'item_attributes_read';
    case ITEM_ATTRIBUTES_UPDATE = 'item_attributes_update';
    case ITEM_ATTRIBUTES_DELETE = 'item_attributes_delete';
    case ITEM_ATTRIBUTES_CREATE = 'item_attributes_create';

    // Reservations
    case RESERVATIONS_READ = 'reservations_read';
    case RESERVATIONS_UPDATE = 'reservations_update';
    case RESERVATIONS_DELETE = 'reservations_delete';
    case RESERVATIONS_CREATE = 'reservations_create';

    // Pages
    case PAGES_READ = 'pages_read';
    case PAGES_UPDATE = 'pages_update';
    case PAGES_DELETE = 'pages_delete';
    case PAGES_CREATE = 'pages_create';

    // Media Library
    case MEDIA_READ = 'media_read';
    case MEDIA_UPDATE = 'media_update';
    case MEDIA_DELETE = 'media_delete';
    case MEDIA_CREATE = 'media_create';


    // Slider
    case SLIDERS_READ = 'sliders_read';
    case SLIDERS_UPDATE = 'sliders_update';
    case SLIDER_DELETE = 'sliders_delete';
    case SLIDERS_CREATE = 'sliders_create';

    // Contacts
    case CONTACTS_READ = 'contacts_read';
    case CONTACTS_UPDATE = 'contacts_update';
    case CONTACTS_DELETE = 'contacts_delete';
    case CONTACTS_CREATE = 'contacts_create';

    // Blogs
    case BLOGS_READ = 'blogs_read';
    case BLOGS_UPDATE = 'blogs_update';
    case BLOGS_DELETE = 'blogs_delete';
    case BLOGS_CREATE = 'blogs_create';


    // Users
    case USERS_READ = 'users_read';
    case USERS_UPDATE = 'users_update';
    case USERS_DELETE = 'users_delete';
    case USERS_CREATE = 'users_create';


    // Settings
    case SETTINGS_READ = 'settings_read';
    case SETTINGS_UPDATE = 'settings_update';
    case SETTINGS_DELETE = 'settings_delete';
    case SETTINGS_CREATE = 'settings_create';

    // Roles
    case ROLES_READ = 'roles_read';
    case ROLES_UPDATE = 'roles_update';
    case ROLES_DELETE = 'roles_delete';
    case ROLES_CREATE = 'roles_create';

}
