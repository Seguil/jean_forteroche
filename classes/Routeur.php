<?php
class Routeur {
    private $request;
    private $routes = [
        //user - render
        'user-home-page.html'         =>      ['controller' => 'UserRender'      ,    'method' => 'showHomePage'           ],
        'user-billet-page.html'       =>      ['controller' => 'UserRender'      ,    'method' => 'readBilletComments'     ],


        //user - redirect
        'inscription-user.html'       =>      ['controller' => 'UserRedirect'    ,    'method' => 'createUser'             ], //pas de view pour inscriptionUser car redirect sur userHomePage
        'user-report-comment.html'    =>      ['controller' => 'UserRedirect'    ,    'method' => 'reportComment'          ],
        'create-comment.html'         =>      ['controller' => 'UserRedirect'    ,    'method' => 'createComment'          ],


        //admin - render
        'admin-home-page.html'        =>      ['controller' => 'AdminRender'     ,    'method' => 'showAdminHomePage'      ],
        'admin-billet-page.html'      =>      ['controller' => 'AdminRender'     ,    'method' => 'adminReadBilletComments'],
        'read-non-published-billet.html'=>      ['controller' => 'AdminRender'     ,    'method' => 'readNonPublishedBillet'],
        'change-billet.html'          =>      ['controller' => 'AdminRender'     ,    'method' => 'changeBillet'],


        //admin - redirect
        'create-billet.html'          =>      ['controller' => 'AdminRedirect'   ,    'method' => 'createBillet'           ],
        
        'report-comment.html'         =>      ['controller' => 'AdminRedirect'   ,    'method' => 'reportComment'          ],
        'delete-report-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deleteReportComment'    ],
        'answer-comment.html'         =>      ['controller' => 'AdminRedirect'   ,    'method' => 'answerComment'          ],
        'update-report-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateReportComment'    ],
        'update-status-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateStatusComment'    ],
        'delete-comment.html'         =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deleteComment'          ],

        'connection-admin.html'       =>      ['controller' => 'AdminRedirect'   ,    'method' => 'readUser'               ],
        'deconnexion.html'            =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deconnexionUser'        ]
 
 
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