<?php
class Routeur {
    private $request;
    private $routes = [
        'user-home-page.html'         =>      ['controller' => 'UserHome'    ,    'method' => 'showHomePage'           ],
        'admin-home-page.html'        =>      ['controller' => 'AdminHome'   ,    'method' => 'showAdminHomePage'      ],
        'inscription-user.html'       =>      ['controller' => 'UserHome'    ,    'method' => 'createUser'             ], //pas de view pour inscriptionUser car redirect sur userHomePage
        'user-billet-page.html'       =>      ['controller' => 'UserHome'    ,    'method' => 'readBilletComments'     ],
        'admin-billet-page.html'      =>      ['controller' => 'AdminHome'   ,    'method' => 'adminReadBilletComments'],
        'create-comment.html'         =>      ['controller' => 'UserHome'    ,    'method' => 'createComment'          ],
        'create-billet.html'          =>      ['controller' => 'AdminHome'   ,    'method' => 'createBillet'           ],
        'report-comment.html'         =>      ['controller' => 'AdminHome'   ,    'method' => 'reportComment'          ],
        'connection-admin.html'       =>      ['controller' => 'AdminHome'   ,    'method' => 'readUser'               ],
        'deconnexion.html'            =>      ['controller' => 'AdminHome'   ,    'method' => 'deconnexionUser'        ]
        // 'user_billet_page.html'           => ['controller' => 'AjaxHome',     'method' => 'getBillets']
        // 'updateBillet.html'     => ['controller' => 'Home', 'method' => 'updateBillet'],
        // 'deleteBillet.html'     => ['controller' => 'Home', 'method' => 'deleteBillet'],
        // 'readBillet.html'       => ['controller' => 'Home', 'method' => 'readBillet'],
        // 'updateComment.html'    => ['controller' => 'Home', 'method' => 'updateComment'],
    ];

    public function __construct($request) {
        $this->request = $request;
    }


    public function getRoute() {
        //explode prend la string et crée un tableau comprenant chaque caractère séparé par le séparateur défini
        $elements = explode('/', $this->request); //requete = delete/id/..
        return $elements[0]; //0 correspond à delete
    }


    public function getParams() {
        $params = null;

        $elements = explode('/', $this->request);
        unset($elements[0]);

        for($i=1; $i<count($elements); $i++) {//on parcourt l'url. 1 = id, 2 = n° de l'id...
            $params[$elements[$i]] = $elements[$i+1]; //delete/id/4 => $elements[$i] = id => $elements[$i+1] = n° de l'id
            $i++; //je continue à lire s'il y a d'autres éléments
        }

        if($_POST) {
            foreach($_POST as $key => $val) {
                $params[$key] = $val;
            }
        }
        return $params;
    }


    public function renderController() {
        $route = $this->getRoute();
        $params = $this->getParams();
        if(key_exists($route, $this->routes)) {
            $controller = $this->routes[$route]['controller'];
            $method = $this->routes[$route]['method'];

            $currentController = new $controller();
            $currentController->$method($params);
        } else {
            echo '404';
        }        
    }
}