<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/task/getTasks' => [[['_route' => 'admin.task.index', '_controller' => 'App\\Controller\\Admin\\AdminTaskController::getTasks'], null, null, null, false, false, null]],
        '/api/task/create' => [[['_route' => 'admin.task.new', '_controller' => 'App\\Controller\\Admin\\AdminTaskController::new'], null, null, null, false, false, null]],
        '/api/todo/getTodos' => [[['_route' => 'todo.getTodos', '_controller' => 'App\\Controller\\Admin\\AdminTodoController::getTodos'], null, null, null, false, false, null]],
        '/admin/todo/create' => [[['_route' => 'admin.todo.new', '_controller' => 'App\\Controller\\Admin\\AdminTodoController::new'], null, null, null, false, false, null]],
        '/historique' => [[['_route' => 'historique', '_controller' => 'App\\Controller\\HistoriqueController::index'], null, null, null, false, false, null]],
        '/api/home' => [[['_route' => 'app_home_index', '_controller' => 'App\\Controller\\HomeController::index'], null, ['GET' => 0, 'HEAD' => 1], null, false, false, null]],
        '/api/create_task' => [[['_route' => 'app_home_create_task', '_controller' => 'App\\Controller\\HomeController::create_Task'], null, ['GET' => 0, 'HEAD' => 1], null, false, false, null]],
        '/todo1' => [[['_route' => 'todo1', '_controller' => 'App\\Controller\\Todo1Controller::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/api/t(?'
                    .'|ask/(?'
                        .'|getTask/([^/]++)(*:201)'
                        .'|delete/([^/]++)(*:224)'
                        .'|edit/([^/]++)(*:245)'
                    .')'
                    .'|odo/(?'
                        .'|delete/([^/]++)(*:276)'
                        .'|getTodo/([^/]++)(*:300)'
                        .'|update/([^/]++)(*:323)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        201 => [[['_route' => 'admin.task.index.id', '_controller' => 'App\\Controller\\Admin\\AdminTaskController::getTask'], ['Name'], null, null, false, true, null]],
        224 => [[['_route' => 'task.delete', '_controller' => 'App\\Controller\\Admin\\AdminTaskController::deleteTask'], ['Name'], null, null, false, true, null]],
        245 => [[['_route' => 'app_admin_admintask_update', '_controller' => 'App\\Controller\\Admin\\AdminTaskController::update'], ['Name'], null, null, false, true, null]],
        276 => [[['_route' => 'todo.delete', '_controller' => 'App\\Controller\\Admin\\AdminTodoController::deleteTodo'], ['Name'], null, null, false, true, null]],
        300 => [[['_route' => 'admin.todo.getTodos', '_controller' => 'App\\Controller\\Admin\\AdminTodoController::getTodo'], ['Name'], null, null, false, true, null]],
        323 => [
            [['_route' => 'app_admin_admintodo_update', '_controller' => 'App\\Controller\\Admin\\AdminTodoController::update'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
