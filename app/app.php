<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Brand.php";
    require_once __DIR__."/../src/Store.php";

    $app = new Silex\Application();

    $app['debug'] = true;

    $DB = new PDO('pgsql:host=localhost;dbname=shoes');

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();



    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.twig');
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render('shoes.twig' ,array("stores"=>Store::getAll()));
    });


    $app->post("/stores", function() use ($app) {
        $new_store= new Store($_POST['name']);
        $new_store->save();

        return $app['twig']->render('shoes.twig' ,array("stores"=>Store::getAll()));
    });

    $app->delete("/delete_stores", function() use ($app) {
        Store::deleteAll();

        return $app['twig']->render('shoes.twig' ,array("stores"=>Store::getAll()));
    });
    $app->get("/store/{id}", function($id) use ($app) {
        $store= Store::find($id);
        return $app['twig']->render('shoe_current.twig' ,array("store"=>$store, "brands"=>Brand::getAll(), "all_brand"=>$store->getBrands()));
    });
    $app->post("add_brand", function() use ($app) {
        $store= Store::find($_POST['store_id']);
        $brand= Brand::find($_POST['brand_id']);
        $store->addBrand($brand);

        return $app['twig']->render('shoe_current.twig' ,array("store"=>$store, "brands"=>Brand::getAll(), "all_brand"=>$store->getBrands()));
    });
    $app->get("/store/{id}/edit", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render('edit_store.twig', array('store' => $store));
    });

    $app->patch("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->update($_POST['name']);
        return $app['twig']->render('shoe_current.twig', array('store' => $store,"brands"=>Brand::getAll(), "all_brand"=>$store->getBrands()));
    });

    $app->delete("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render('shoes.twig' ,array("stores"=>Store::getAll()));
    });

    //////////////////Brand Routes
    $app->get("/brands", function() use ($app) {
        return $app['twig']->render('brands.twig' ,array("stores"=>Store::getAll()));
    });




    return $app;


?>
