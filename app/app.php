<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Client.php";
    require_once __DIR__."/../src/Stylist.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig',
        array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist(preg_quote($_POST['name'], "'"));
        $stylist->save();
        return $app['twig']->render('index.html.twig',
            array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('clients.html.twig',
            array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->get("/clients/{id}", function($id) use ($app) {
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig',
            array('client' => $client));
    });

    //-----------------------------------------------------------------------



    $app->post("/clients", function() use ($app){
        $stylist_id = $_POST['stylist_id'];
        $client_name = preg_quote($_POST['client_name'], "'");
        $client = new Client($client_name, $stylist_id, $id = null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig',
            array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        // return $app['twig']->render('category.html.twig',
        // array('category' => $category, 'tasks' => $category->getTasks()));

    });


    $app->post("/stylists/{id}", function($id) use ($app){
        $stylist_id = $_POST['stylist_id'];
        $client_name = preg_quote($_POST['client_name'], "'");
        $client = new Client($client_name, $stylist_id, $id = null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients.html.twig',
            array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        // return $app['twig']->render('category.html.twig',
        // array('category' => $category, 'tasks' => $category->getTasks()));

    });

    $app->post("/clients/{id}", function($id) use ($app){
        $stylist_id = $_POST['stylist_id'];
        $client_name = preg_quote($_POST['client_name'], "'");
        $client = new Client($client_name, $stylist_id, $id = null);
        $client->save();
        $stylist = Stylist::find($stylist_id);
        return $app['twig']->render('clients_edit.html.twig',
            array('stylist' => $stylist, 'clients' => $stylist->getClients()));
        // return $app['twig']->render('category.html.twig',
        // array('category' => $category, 'tasks' => $category->getTasks()));

    });

    $app->patch("/stylists/{id}/edit", function($id) use ($app) {
        $name = preg_quote($_POST['name'], "'");
        $stylist = Stylist::find($id);
        $stylist->update($name);
        return $app['twig']->render('stylist_edit.html.twig',
        array('stylist' => $stylist, 'clients' => $stylist->getClients()));
    });

    $app->patch("/clients/{id}/edit", function($id) use ($app) {
        $name = preg_quote($_POST['client_name'], "'");
        $client = Client::find($id);
        // echo "Name: " . $name . "   Id: " . $id . "   ";
        // var_dump($client);
        $client->update($name);
        return $app['twig']->render('client_edit.html.twig',
        array('client' => Client::find($id)));
    });

    $app->delete("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig',
        array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}/edit", function($id) use ($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig',
        array('stylist' => $stylist));
    });


    $app->post("/delete_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('delete_stylists.html.twig');
    });

    $app->post("/delete_clients", function() use ($app) {
        Client::deleteAll();
        return $app['twig']->render('delete_clients.html.twig');
    });


    return $app;

?>
