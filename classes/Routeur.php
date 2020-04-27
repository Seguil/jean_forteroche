<?php
class Routeur {
    private $request;
    private $routes = [
        //user - render
        'user-home-page.html'         =>      ['controller' => 'UserRender'      ,    'method' => 'showHomePage'           ],
        'user-billet-page.html'       =>      ['controller' => 'UserRender'      ,    'method' => 'readBilletComments'     ],


        //user - redirect
        'inscription-user.html'       =>      ['controller' => 'UserRedirect'    ,    'method' => 'createUser'             ], 
        'user-report-comment.html'    =>      ['controller' => 'UserRedirect'    ,    'method' => 'reportComment'          ],
        'create-comment.html'         =>      ['controller' => 'UserRedirect'    ,    'method' => 'createComment'          ],
        'select-billet.html'          =>      ['controller' => 'UserRedirect'    ,    'method' => 'selectBillet'           ],


        //admin - render
        'admin-home-page.html'        =>      ['controller' => 'AdminRender'     ,    'method' => 'showAdminHomePage'      ],
        'admin-billet-page.html'      =>      ['controller' => 'AdminRender'     ,    'method' => 'adminReadBilletComments'],
        'read-non-published-billet.html'=>      ['controller' => 'AdminRender'     ,    'method' => 'readNonPublishedBillet'],
        'change-billet.html'          =>      ['controller' => 'AdminRender'     ,    'method' => 'changeBillet'           ],


        //admin - redirect
        'create-billet.html'          =>      ['controller' => 'AdminRedirect'   ,    'method' => 'createBillet'           ],
        'update-billet.html'          =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateBillet'           ],
        'delete-billet.html'          =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deleteBillet'           ],
        'update-change-billet.html'   =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateChangeBillet'     ],
        
        'report-comment.html'         =>      ['controller' => 'AdminRedirect'   ,    'method' => 'reportComment'          ],
        'delete-report-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deleteReportComment'    ],
        'update-report-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateReportComment'    ],
        'update-status-comment.html'  =>      ['controller' => 'AdminRedirect'   ,    'method' => 'updateStatusComment'    ],
        'delete-comment.html'         =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deleteComment'          ],

        'connection-admin.html'       =>      ['controller' => 'AdminRedirect'   ,    'method' => 'readUser'               ],
        'deconnexion.html'            =>      ['controller' => 'AdminRedirect'   ,    'method' => 'deconnexionUser'        ]
    ];

    public function __construct($request) {
        $this->request = $request;
    }


    public function getRoute() {
        $elements = explode('/', $this->request);
        return $elements[0];
    }


    public function getParams() {
        $params = null;

        $elements = explode('/', $this->request);
        unset($elements[0]);

        for($i=1; $i<count($elements); $i++) {
            $params[$elements[$i]] = $elements[$i+1];
            $i++;

            if($_POST) {
                foreach($_POST as $key => $val) {
                    $params[$key] = $val;
                }
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