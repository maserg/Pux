<?php
use Pux\Mux;
use Pux\Executor;
use Pux\Controller;

class CRUDProductController extends Controller
{
    public function indexAction() 
    {

    }

    public function addAction() {

    }

    public function delAction() {

    }

}

class ExtControllerTest extends PHPUnit_Framework_TestCase
{
    public function testController() {
        $controller = new CRUDProductController;
        ok($controller);

        $actions = $controller->getActionMethods();
        ok($actions);
        ok( is_array($actions), 'is array' );
        count_ok( 3, $actions);

        $paths = $controller->getActionPaths();
        ok($paths);
        count_ok(3, $paths);
        ok( is_array($paths[0]) );
        ok( is_array($paths[1]) );
        ok( is_array($paths[2]) );

        $mux = $controller->expand();
        ok($mux);

        ok( $routes = $mux->getRoutes() );
        count_ok( 3, $routes );

        ok( $controller->toJson(array('foo' => 1) ) );

        $mainMux = new Mux;
        $mainMux->mount( '/product' , $controller->expand() );
        ok( $mainMux->getRoutes() ); 
        ok( $mainMux->dispatch('/product') );
        ok( $mainMux->dispatch('/product/add') );
        ok( $mainMux->dispatch('/product/del') );

        $mainMux = new Mux;
        $mainMux->expand = false;
        $mainMux->mount( '/product' , $controller->expand() );
        ok( $mainMux->getRoutes() ); 
        ok( $r = $mainMux->dispatch('/product') );
        ok( $r = $mainMux->dispatch('/product/add') );
        ok( $r = $mainMux->dispatch('/product/del') );
    }


}

