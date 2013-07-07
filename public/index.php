<?php

try {

    $di = new \Phalcon\DI\FactoryDefault();

    $config = new \Phalcon\Config\Adapter\Ini('../app/config/application.ini');
    $di->set('config', $config);

    //Register an autoloader
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/'
        )
    )->register();

    //Error log
    $logger = new Phalcon\Logger\Adapter\File("../app/logs/dir23.log");
    /*$logger->log("This is a message");
    $logger->log("This is an error", \Phalcon\Logger::ERROR);
    $logger->error("This is another error");*/

    //Set the database service
    $di->set(
        'db', function () {
            return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
                "host" => $config->database->host,
                "username" => $config->database->username,
                "password" => $config->database->password,
                "dbname" => $config->database->dbname
            ));
        }
    );

    //Setting up the view component
    $di->set(
        'view', function () {
            $view = new \Phalcon\Mvc\View();
            $view->setViewsDir('../app/views/');
            $view->setPartialsDir('../app/view/partials/');
            $view->setLayoutsDir('../app/view/layouts/');
            $view->registerEngines(array(
                ".phtml" => function($view, $di) {
                    $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);
                    $volt->setOptions(array(
                        "compileAlways" => true,
                        "compiledPath" => "../app/compiled-templates/"
                    ));
                    return $volt;
                }
            ));
            return $view;
        }
    );

    //Handle the request
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}